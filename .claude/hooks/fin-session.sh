#!/usr/bin/env bash
# Clôture automatique de session (hook SessionEnd) : si le dépôt a bougé,
# lance /fin-session en mode non interactif (STATUS.md, commit, push).

# Le `claude -p` lancé ici déclenche lui-même SessionEnd en finissant :
# sans ce garde, un push raté relancerait le hook en boucle.
[ -n "${FIN_SESSION_EN_COURS:-}" ] && exit 0
export FIN_SESSION_EN_COURS=1

cd "${CLAUDE_PROJECT_DIR:-.}" || exit 0
git rev-parse --is-inside-work-tree >/dev/null 2>&1 || exit 0

journal=".claude/fin-session.log"

# Commits en attente : ceux que l'amont n'a pas ; sans amont, tout commit local compte.
if git rev-parse --abbrev-ref '@{u}' >/dev/null 2>&1; then
  en_attente=$(git rev-list --count '@{u}..HEAD')
else
  en_attente=$(git rev-list --count HEAD --not --remotes)
fi

# Une ligne même quand il n'y a rien à faire : sans elle, on ne distingue pas
# « hook non déclenché » de « dépôt propre ».
if [ -z "$(git status --porcelain)" ] && [ "$en_attente" -eq 0 ]; then
  echo "--- $(date '+%Y-%m-%d %H:%M:%S') — rien à clôturer" >>"$journal"
  exit 0
fi

{
  echo "=== $(date '+%Y-%m-%d %H:%M:%S') — branche $(git rev-parse --abbrev-ref HEAD), $en_attente commit(s) en attente"
  claude -p "/fin-session" --allowedTools "Read,Write,Edit,Bash(git *)"
  echo "=== fin (code $?)"
} >>"$journal" 2>&1

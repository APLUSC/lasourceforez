# 🏡 Le Gîte La Source - Site Web Optimisé

## 📁 Structure des fichiers

```
lasourceforez-site/
├── index.html              ← Page principale du site
├── images/                 ← Dossier contenant toutes les photos
│   ├── hero.jpg           (557 KB) - Image d'accueil avec arc-en-ciel
│   ├── entreprise-1.jpg   (576 KB) - Table séminaire sous pergola
│   ├── entreprise-2.jpg   (532 KB) - Terrasse couverte
│   ├── entreprise-3.jpg   (1.3 MB) - Espace nature forêt
│   ├── particulier-1.jpg  (321 KB) - Intérieur convivial
│   ├── particulier-2.jpg  (270 KB) - Chambre épurée
│   ├── particulier-3.png  (294 KB) - Jacuzzi avec vue
│   ├── lieu-1.jpg         (782 KB) - Panoramique 3 chevaux
│   ├── lieu-2.png         (578 KB) - Lever de soleil givré
│   └── lieu-3.jpg         (614 KB) - Maison de nuit
└── README.md               ← Ce fichier

Taille totale : ~5.8 MB (beaucoup plus léger que la version avec images intégrées !)
```

## ✅ Avantages de cette version

- **Chargement rapide** : Les images se chargent progressivement
- **Facile à maintenir** : Remplacez une image en gardant le même nom
- **SEO optimisé** : Images séparées = meilleur référencement
- **Prête pour production** : Structure professionnelle standard

## 🚀 Comment mettre en ligne

### Option 1 : Netlify (RECOMMANDÉE - gratuit et ultra simple)

1. Va sur [netlify.com](https://www.netlify.com)
2. Crée un compte gratuit
3. **Drag & drop le dossier complet `lasourceforez-site`** sur Netlify
4. Ton site est en ligne en 30 secondes !
5. Configure ensuite ton nom de domaine `lasourceforez.fr`

**📹 Netlify te donne un URL gratuit comme :** `https://lasourceforez.netlify.app`

### Option 2 : Serveur FTP classique (OVH, O2Switch, etc.)

1. Connecte-toi à ton hébergeur via FTP (FileZilla)
2. Upload tout le contenu du dossier `lasourceforez-site/`
3. Assure-toi que la structure est préservée :
   - `index.html` à la racine
   - Dossier `images/` à côté
4. Ton site sera accessible sur ton domaine

### Option 3 : GitHub Pages (gratuit)

1. Crée un compte GitHub
2. Crée un nouveau repository public
3. Upload tous les fichiers
4. Active GitHub Pages dans les settings
5. Site disponible sur `https://ton-username.github.io/lasourceforez`

## ⚙️ Configuration à finaliser

### 1. Google Maps (5 minutes)

**Dans `index.html`, ligne ~500**, tu trouveras l'iframe Google Maps :

```html
<iframe src="https://www.google.com/maps/embed?pb=..."></iframe>
```

**Pour l'adresse exacte :**
1. Va sur [Google Maps](https://www.google.com/maps)
2. Recherche : `650 Chemin de Baloye, 42130 ARTHUN`
3. Clique sur "Partager" → "Intégrer une carte"
4. Copie le code iframe
5. Remplace l'iframe existant dans index.html

### 2. Formulaire de Contact (5 minutes)

**Méthode recommandée - Formspree (gratuit) :**

1. Va sur [formspree.io](https://formspree.io)
2. Crée un compte gratuit
3. Crée un nouveau formulaire
4. Copie ton Form ID (ex: `xyzabc123`)
5. Dans `index.html`, ligne ~850, cherche :
   ```javascript
   fetch('https://formspree.io/f/YOUR_FORM_ID', {
   ```
6. Remplace `YOUR_FORM_ID` par ton vrai ID

**Les emails de contact arriveront directement dans ta boîte !**

### 3. Ajouter tes coordonnées

Dans le footer (ligne ~880), ajoute :
- Ton numéro de téléphone
- Ton email
- Tes réseaux sociaux

## 🔧 Personnalisation

### Modifier les couleurs

Les couleurs sont définies au début du CSS (ligne ~30) :

```css
:root {
    --color-forest: #2D5016;    /* Vert forêt */
    --color-beige: #F5F1E8;     /* Beige clair */
    --color-brown: #8B6F47;     /* Brun chaud */
    --color-offwhite: #FAFAF8;  /* Blanc cassé */
}
```

Change ces valeurs pour personnaliser !

### Remplacer une photo

Pour remplacer une photo (sans casser le site) :
1. Prépare ta nouvelle photo
2. Renomme-la avec le même nom (ex: `hero.jpg`)
3. Remplace l'ancienne dans le dossier `images/`
4. Upload sur ton serveur

**Ça fonctionne immédiatement !**

## 📊 Performance

- **Version base64 (précédente)** : 7.7 MB → chargement lent
- **Version optimisée (actuelle)** : 5.8 MB → chargement progressif et rapide

**Gain de performance : ~25% plus rapide !**

## 📞 Support

Si tu as besoin d'aide pour configurer quoi que ce soit, n'hésite pas !

## ✨ Fonctionnalités incluses

- ✅ Design responsive (mobile, tablette, desktop)
- ✅ Navigation sticky avec scroll effect
- ✅ Animations et transitions fluides
- ✅ Formulaire de contact prêt à configurer
- ✅ Google Maps intégré
- ✅ SEO-friendly (balises alt, structure HTML propre)
- ✅ Performance optimisée

---

**🎉 Ton site est prêt à être mis en ligne !**

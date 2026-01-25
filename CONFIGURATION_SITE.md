# 🚀 Guide de Configuration - Le Gîte La Source

## 📍 Google Maps - Configuration

### Option actuelle : Carte générique intégrée
La carte fonctionne déjà et pointe vers ARTHUN (42130).

### Pour une carte précise avec marqueur exact :

**Étape 1 : Obtenir l'URL d'intégration Google Maps**

1. Va sur [Google Maps](https://www.google.com/maps)
2. Recherche : `650 Chemin de Baloye, 42130 ARTHUN`
3. Clique sur le bouton **"Partager"**
4. Clique sur **"Intégrer une carte"**
5. Copie le code iframe qui commence par `<iframe src="https://www.google.com/maps/embed...`

**Étape 2 : Remplacer dans le code**

Dans le fichier HTML, trouve cette section (ligne ~500) :
```html
<iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!..."
```

Et remplace l'URL `src="..."` par celle que tu as copiée de Google Maps.

---

## 📧 Formulaire de Contact - 3 Solutions

### ✅ SOLUTION 1 : Formspree (RECOMMANDÉE - Gratuite et Simple)

**Avantages :** Aucun code backend, gratuit jusqu'à 50 emails/mois, super simple

**Configuration :**

1. Va sur [formspree.io](https://formspree.io)
2. Crée un compte gratuit
3. Crée un nouveau formulaire
4. Copie ton Form ID (format : `xyzabc123`)
5. Dans le fichier HTML, ligne ~850, remplace :
   ```javascript
   fetch('https://formspree.io/f/YOUR_FORM_ID', {
   ```
   par :
   ```javascript
   fetch('https://formspree.io/f/TON_VRAI_FORM_ID', {
   ```

**C'est tout !** Les emails arriveront directement dans ta boîte email.

---

### SOLUTION 2 : EmailJS (Gratuite)

**Avantages :** Emails directs sans backend, 200 emails/mois gratuits

**Configuration :**

1. Va sur [emailjs.com](https://www.emailjs.com)
2. Crée un compte et configure ton service email (Gmail, Outlook, etc.)
3. Crée un template d'email
4. Note ton Service ID, Template ID, et User ID
5. Ajoute ce script dans le `<head>` du HTML :
   ```html
   <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
   ```
6. Remplace le code du formulaire par celui-ci (dans la balise `<script>` à la fin) :

```javascript
emailjs.init("TON_USER_ID");

document.querySelector('.contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.querySelector('.submit-btn');
    const formStatus = document.getElementById('formStatus');
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Envoi en cours...';
    
    emailjs.sendForm('TON_SERVICE_ID', 'TON_TEMPLATE_ID', this)
        .then(() => {
            formStatus.style.color = 'green';
            formStatus.textContent = '✓ Message envoyé avec succès !';
            this.reset();
        })
        .catch(() => {
            formStatus.style.color = 'red';
            formStatus.textContent = '✗ Erreur lors de l\'envoi. Réessayez.';
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Envoyer la demande';
        });
});
```

---

### SOLUTION 3 : PHP avec hébergeur

**Si tu as un hébergeur avec PHP (OVH, O2Switch, etc.)**

Crée un fichier `send_email.php` :

```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $type = htmlspecialchars($_POST['type']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = "ton-email@example.com"; // TON EMAIL ICI
    $subject = "Nouveau contact - Le Gîte La Source - $type";
    
    $body = "Nouvelle demande de contact\n\n";
    $body .= "Nom: $nom\n";
    $body .= "Email: $email\n";
    $body .= "Téléphone: $telephone\n";
    $body .= "Type: $type\n\n";
    $body .= "Message:\n$message";
    
    $headers = "From: noreply@lasourceforez.fr\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false]);
    }
}
?>
```

Et dans le HTML, change l'URL fetch :
```javascript
fetch('send_email.php', {
    method: 'POST',
    body: new FormData(form)
})
```

---

## 🎯 Quelle solution choisir ?

| Solution | Difficulté | Coût | Fiabilité |
|----------|------------|------|-----------|
| **Formspree** | ⭐ Très facile | Gratuit | ⭐⭐⭐⭐⭐ |
| **EmailJS** | ⭐⭐ Facile | Gratuit | ⭐⭐⭐⭐ |
| **PHP** | ⭐⭐⭐ Moyen | Variable | ⭐⭐⭐ |

**Recommandation : Commence avec Formspree** (5 minutes de configuration)

---

## 📱 Coordonnées à ajouter

N'oublie pas d'ajouter :
- Ton numéro de téléphone
- Ton email de contact
- Tes réseaux sociaux si tu en as (Facebook, Instagram)

Tu peux les ajouter dans le footer ou dans la section contact !

---

## 🆘 Besoin d'aide ?

Si tu es bloqué sur une étape, dis-moi et je t'aide à configurer !

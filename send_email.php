<?php
/**
 * Script d'envoi d'email pour Le Gîte La Source
 * À utiliser si tu as un hébergeur avec PHP (OVH, O2Switch, etc.)
 */

// Configuration - REMPLACE PAR TON EMAIL
$destinataire = "ton-email@example.com"; // ⚠️ CHANGE CETTE LIGNE !

// Protection contre les spams
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

// Récupération et nettoyage des données
$nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
$telephone = isset($_POST['telephone']) ? htmlspecialchars(trim($_POST['telephone'])) : '';
$type = isset($_POST['type']) ? htmlspecialchars(trim($_POST['type'])) : '';
$message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

// Validation des champs requis
if (empty($nom) || empty($email) || empty($type) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Tous les champs obligatoires doivent être remplis']);
    exit;
}

if (!$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email invalide']);
    exit;
}

// Déterminer le type de demande
$typeLabel = '';
switch($type) {
    case 'entreprise':
        $typeLabel = 'Séminaire Entreprise';
        break;
    case 'particulier':
        $typeLabel = 'Séjour Particulier';
        break;
    default:
        $typeLabel = 'Autre demande';
}

// Création du sujet
$sujet = "Nouvelle demande - Le Gîte La Source - $typeLabel";

// Corps de l'email
$corps = "Vous avez reçu une nouvelle demande de contact depuis lasourceforez.fr\n\n";
$corps .= "----------------------------------------\n";
$corps .= "INFORMATIONS DU DEMANDEUR\n";
$corps .= "----------------------------------------\n\n";
$corps .= "Nom : $nom\n";
$corps .= "Email : $email\n";
$corps .= "Téléphone : " . ($telephone ?: 'Non renseigné') . "\n";
$corps .= "Type de demande : $typeLabel\n\n";
$corps .= "----------------------------------------\n";
$corps .= "MESSAGE\n";
$corps .= "----------------------------------------\n\n";
$corps .= "$message\n\n";
$corps .= "----------------------------------------\n";
$corps .= "Envoyé le : " . date('d/m/Y à H:i') . "\n";
$corps .= "Depuis : " . $_SERVER['REMOTE_ADDR'] . "\n";

// Headers pour l'email
$headers = "From: noreply@lasourceforez.fr\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Envoi de l'email
if (mail($destinataire, $sujet, $corps, $headers)) {
    echo json_encode([
        'success' => true, 
        'message' => 'Votre message a été envoyé avec succès ! Nous vous répondrons rapidement.'
    ]);
    
    // Log (optionnel - décommenter si besoin)
    // $log = date('Y-m-d H:i:s') . " - Email envoyé de $nom ($email) - Type: $typeLabel\n";
    // file_put_contents('contact_logs.txt', $log, FILE_APPEND);
    
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Erreur lors de l\'envoi. Veuillez réessayer ou nous contacter directement.'
    ]);
}
?>

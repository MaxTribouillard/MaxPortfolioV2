<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        echo "Veuillez remplir tous les champs requis.";
        exit;
    }

    // Envoi du message (exemple d'envoi par email)
    $to = "tribouillard.max@gmail.com";
    $subject = "Nouveau message de $name";
    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Merci pour votre message, $name. Je vous répondrai bientôt !";
    } else {
        echo "Une erreur est survenue lors de l'envoi du message.";
    }
}
?>
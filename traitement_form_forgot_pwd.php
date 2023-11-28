<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $_SESSION["Mail_Uti"]=$email;
    // Génération d'un code aléatoire à 6 chiffres
    $code = rand(100000, 999999);
    $_SESSION["code"]=$code;
    // Envoi du code par e-mail
    $subject = "Réinitialisation de mot de passe";
    $message = "Votre code de réinitialisation de mot de passe est : $code";
    $headers = "From: no-reply@letalenligne.com"; // Remplacez par votre adresse e-mail

    // Envoi de l'e-mail
    $mailSent = mail($email, $subject, $message, $headers);

    // Redirection avec le résultat de l'envoi
    $redirectUrl = 'form_code.php';
    if ($mailSent) {
        $redirectUrl .= '?result=success';
    } else {
        $redirectUrl .= '?result=failure';
    }

    header("Location: $redirectUrl");
    exit();
}
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCode = $_POST["code"];
    $expectedCode = isset($_SESSION["code"]);

    // Comparer le code saisi avec le code attendu
    if ($enteredCode === $expectedCode) {
        // Code correct, rediriger vers form_update.php
        header("Location: form_update.php");
        exit();
    } else {
        // Code incorrect, rediriger vers form_code.php
        header("Location: form_code.php?result=failure1");
        exit();
    }
}
?>
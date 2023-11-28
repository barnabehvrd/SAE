<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCode = $_POST["code"];
    $expectedCode = $_SESSION["code"];
    var_dump($_SESSION["code"]);

    // Comparer le code saisi avec le code attendu
    if ($enteredCode == $expectedCode) {
        // Code correct, rediriger vers form_update.php
        echo("code correct");
        //header("Location: form_update_pwd.php");
        exit();
    } else {
        // Code incorrect, rediriger vers form_code.php
        echo("code incoreect");
        //header("Location: form_code.php?result=failure1");
        exit();
    }
}
?>
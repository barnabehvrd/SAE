<?php
session_start();

$languageFiles = [
    'en' => "language_en.php",
    'es' => "language_es.php",
    'al' => "language_al.php",
    'ru' => "language_ru.php",
    'ch' => "language_ch.php"
];

if (isset($_POST['language'])) {
    $_SESSION["language"] = $_POST['language'];
    header("Location: index.php");
    exit;
}

$selectedLanguage = $_SESSION["language"] ?? 'fr'; // version php 5.6 $selectedLanguage = isset($_SESSION["language"]) ? $_SESSION["language"] : 'fr';
$languageFile = $languageFiles[$selectedLanguage] ?? "language_fr.php"; // version php 5.6 $languageFile = isset($languageFiles[$selectedLanguage]) ? $languageFiles[$selectedLanguage] : "language_fr.php";


require $languageFile;
?>
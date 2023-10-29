<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["categorie"])) {
        $categorie = $_POST["categorie"];
        echo "Catégorie sélectionnée : " . $categorie;
    } else {
        echo "Aucune catégorie sélectionnée.";
    }
}
?>
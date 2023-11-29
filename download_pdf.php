<?php
require_once('fpdf186/fpdf.php');
function dbConnect(){
    $host = 'localhost';
    $dbname = 'inf2pj_02';
    $user = 'inf2pj02';
    $password = 'ahV4saerae';
    return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
}

$bdd=dbConnect();
session_start();

// Récupération des données de la commande
$Id_Commande = $_POST["idCommande"];
$queryGetCommande = $bdd->query(('SELECT Desc_Statut, Id_Commande, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut FROM COMMANDE INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti WHERE COMMANDE.Id_Commande=' . $Id_Commande . ';'));
$returnQueryGetCommande = $queryGetCommande->fetchAll(PDO::FETCH_ASSOC);
$Id_Commande = $returnQueryGetCommande[0]["Id_Commande"];
$Desc_Statut = $returnQueryGetCommande[0]["Desc_Statut"];

require('fpdf/fpdf.php');

// Créer une instance de la classe FPDF
$pdf = new FPDF();

// Ajouter une page au PDF
$pdf->AddPage();

// Définir la police
$pdf->SetFont('Arial', 'B', 16);

// Ajouter du texte au PDF
$pdf->Cell(40, 10, 'Bonjour, voici votre PDF!');

// Nom du fichier PDF à télécharger
$nom_fichier = 'votre_fichier.pdf';

// Envoi des en-têtes HTTP pour forcer le téléchargement du fichier
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $nom_fichier . '"');

// Générer le PDF et le transmettre au navigateur
$pdf->Output('F', $nom_fichier);
?>
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

// Génération du contenu PDF avec TCPDF
$pdf = new TCPDF();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Ajoutez le contenu du PDF ici
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Bon de Commande', 0, 1, 'C');
$pdf->Cell(0, 10, 'Commande ID: ' . $Id_Commande, 0, 1, 'C');
$pdf->Cell(0, 10, 'Statut: ' . $Desc_Statut, 0, 1, 'C');
$pdf->Cell(0, 10, 'Producteur: ' . $Nom_Producteur, 0, 1, 'C');
$pdf->Cell(0, 10, 'Nombre de produits: 3', 0, 1, 'C');
$pdf->Cell(0, 10, 'Produit 1: T-shirt, Quantité: 5, Prix unitaire: $10', 0, 1, 'C');
$pdf->Cell(0, 10, 'Produit 2: Tomates, Quantité: 3, Prix unitaire: $5', 0, 1, 'C');
$pdf->Cell(0, 10, 'Produit 3: Chaussures, Quantité: 2, Prix unitaire: $50', 0, 1, 'C');

// Nom du fichier de sortie
$filename = 'bill.pdf';

// Envoie les entêtes pour indiquer que le contenu est un PDF à télécharger
$pdf->Output($filename, 'D');
?>
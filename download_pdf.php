<?php

function dbConnect(){
    $host = 'localhost';
    $dbname = 'inf2pj_02';
    $user = 'inf2pj02';
    $password = 'ahV4saerae';
    return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
}

$bdd=dbConnect();
$Id_Commande=$_POST["idCommande"];

$queryGetCommande = $bdd->query(('SELECT Desc_Statut, COMMANDE.Id_Prod, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut, UTILISATEUR.Adr_Uti, UTILISATEUR.Mail_Uti  FROM COMMANDE INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti WHERE COMMANDE.Id_Commande='.$Id_Commande.';'));
$returnQueryGetCommande = $queryGetCommande->fetchAll(PDO::FETCH_ASSOC);
$Id_Prod = $returnQueryGetCommande[0]["Id_Prod"];
$Desc_Statut = $returnQueryGetCommande[0]["Desc_Statut"];
$Nom_Uti = $returnQueryGetCommande[0]["Nom_Uti"];
$Nom_Uti = mb_strtoupper($Nom_Uti);
$Prenom_Uti = $returnQueryGetCommande[0]["Prenom_Uti"];
$Id_Statut = $returnQueryGetCommande[0]["Id_Statut"];
$Mail_Uti = $returnQueryGetCommande[0]["Mail_Uti"];
$Adr_Uti = $returnQueryGetCommande[0]["Adr_Uti"];

$bdd=dbConnect();
$queryGetProducteur = $bdd->query(('SELECT Prenom_Uti, Nom_Uti, Mail_Uti, Adr_Uti, Prof_Prod WHERE Id_Prod='.$Id_Prod.';'));
$returnQueryGetProducteur = $queryGetProducteur->fetchAll(PDO::FETCH_ASSOC);
$Nom_Prod = $returnQueryGetCommande[0]["Nom_Uti"];
$Nom_Prod = mb_strtoupper($Nom_Prod);
$Prenom_Prod = $returnQueryGetCommande[0]["Prenom_Uti"];
$Adr_Prod = $returnQueryGetCommande[0]["Adr_Uti"];
$Prof_Prod = $returnQueryGetCommande[0]["Prof_Prod"];

require('fpdf/fpdf.php'); // Assurez-vous d'ajuster le chemin vers le fichier FPDF

class MonPDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Titre
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'Bon de commande', 0, 1, 'C');

        // Ligne de séparation
        $this->Cell(0, 0, '', 'T');
        $this->Ln(5); // Saut de ligne réduit
    }

    // Pied de page
    function Footer()
    {
        // Numéro de page
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Créer une instance de MonPDF
$pdf = new MonPDF();
$pdf->AddPage();

// Ajouter les valeurs
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 5, $Nom_Prod.$Prenom_Prod, 0, 1);
$pdf->Cell(0, 5, $Prof_Prod, 0, 1);
$pdf->Cell(0, 5, $Adr_Prod, 0, 1);

// Informations sur le client
$pdf->Cell(0, 5, $Nom_Uti.$Prenom_Uti, 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(0, 5, $Adr_Uti, 0, 0, 'R');
$pdf->Ln(10); // Sauts de ligne réduits

// Informations sur la commande
$pdf->Cell(0, 5, 'COMMANDE XXX :', 0, 1);

// Tableau avec des produits générés aléatoirement
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 8, 'Produit', 1);
$pdf->Cell(40, 8, 'Prix Unitaire', 1);
$pdf->Cell(30, 8, 'Quantité', 1);
$pdf->Cell(40, 8, 'Prix', 1);
$pdf->Ln();

// Génération de produits aléatoires (exemple avec 3 produits)
$produits = [
    ['Produit 1', 10, 2],
    ['Produit 2', 15, 3],
    ['Produit 3', 20, 1],
];

$pdf->SetFont('Arial', '', 12);
foreach ($produits as $produit) {
    $pdf->Cell(40, 8, $produit[0], 1);
    $pdf->Cell(40, 8, '$' . number_format($produit[1], 2), 1);
    $pdf->Cell(30, 8, $produit[2], 1);
    $pdf->Cell(40, 8, '$' . number_format($produit[1] * $produit[2], 2), 1);
    $pdf->Ln();
}

$pdf->Ln(5); // Saut de ligne réduit

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(110, 8, 'TOTAL', 1);
$pdf->Cell(40, 8, '$' . number_format(array_sum(array_column($produits, 1)), 2), 1);
$pdf->Ln(); // Saut de ligne

// Impression
$pdf->Ln(5); // Saut de ligne réduit
$pdf->Cell(0, 5, 'IMPRESSION', 0, 1);

// Enregistrer le PDF dans un fichier temporaire
$nom_fichier = tempnam(sys_get_temp_dir(), 'pdf');
$pdf->Output($nom_fichier, 'F');

// Envoi des en-têtes pour le téléchargement
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="exemple.pdf"');
header('Content-Length: ' . filesize($nom_fichier));

// Envoyer le contenu du fichier
readfile($nom_fichier);

// Supprimer le fichier temporaire
unlink($nom_fichier);
?>
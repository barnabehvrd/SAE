<?php
// Inclure la bibliothèque FPDF
require('fpdf/fpdf.php');

class MonPDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Titre
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Mon Document', 0, 1, 'C');

        // Ligne de séparation
        $this->Cell(0, 0, '', 'T');
        $this->Ln(10); // Saut de ligne
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

$pdf->Cell(0, 10, 'Producteur', 0, 1);
$pdf->Cell(0, 10, 'PROFESSION', 0, 1);
$pdf->Cell(0, 10, 'ADRESSE', 0, 1);

// Informations sur le client
$pdf->Cell(0, 10, 'Client CLIENT', 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(0, 10, 'ADRESSE CLIENT', 0, 0, 'R');
$pdf->Ln(20); // Sauts de ligne

// Informations sur la commande
$pdf->Cell(0, 10, 'COMMANDE XXX :', 0, 1);
$pdf->Ln(); // Saut de ligne

// Tableau avec des produits générés aléatoirement
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Produit', 1);
$pdf->Cell(40, 10, 'Prix Unitaire', 1);
$pdf->Cell(30, 10, 'Quantité', 1);
$pdf->Cell(40, 10, 'Prix', 1);
$pdf->Ln();

// Génération de produits aléatoires (exemple avec 3 produits)
$produits = [
    ['Produit 1', 10, 2],
    ['Produit 2', 15, 3],
    ['Produit 3', 20, 1],
];

$pdf->SetFont('Arial', '', 12);
foreach ($produits as $produit) {
    $pdf->Cell(40, 10, $produit[0], 1);
    $pdf->Cell(40, 10, '$' . number_format($produit[1], 2), 1);
    $pdf->Cell(30, 10, $produit[2], 1);
    $pdf->Cell(40, 10, '$' . number_format($produit[1] * $produit[2], 2), 1);
    $pdf->Ln();
}

$pdf->Ln(); // Saut de ligne

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(110, 10, 'TOTAL', 1);
$pdf->Cell(40, 10, '$' . number_format(array_sum(array_column($produits, 1)), 2), 1);
$pdf->Ln(); // Saut de ligne

// Impression
$pdf->Ln(10); // Saut de ligne
$pdf->Cell(0, 10, 'IMPRESSION', 0, 1);

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
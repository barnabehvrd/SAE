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
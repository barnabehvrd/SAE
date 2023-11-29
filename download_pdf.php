<?php
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

// Nettoyer le tampon de sortie
ob_clean();

// Envoi des en-têtes HTTP pour forcer le téléchargement du fichier
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $nom_fichier . '"');

// Générer le PDF et le transmettre au navigateur
$pdf->Output('F', $nom_fichier);
?>
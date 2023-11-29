<?php
header('Content-Type: text/html; charset=utf-8');

function dbConnect(){
    $host = 'localhost';
    $dbname = 'inf2pj_02';
    $user = 'inf2pj02';
    $password = 'ahV4saerae';
    return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$bdd = dbConnect();
$Id_Commande = $_POST["idCommande"];

$queryGetCommande = $bdd->query('SELECT Desc_Statut, COMMANDE.Id_Prod, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut, UTILISATEUR.Adr_Uti, UTILISATEUR.Mail_Uti FROM COMMANDE INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti WHERE COMMANDE.Id_Commande='.$Id_Commande);
$returnQueryGetCommande = $queryGetCommande->fetchAll(PDO::FETCH_ASSOC);

$Id_Prod = $returnQueryGetCommande[0]["Id_Prod"];
$Desc_Statut = utf8_encode($returnQueryGetCommande[0]["Desc_Statut"]);
$Nom_Uti = utf8_encode($returnQueryGetCommande[0]["Nom_Uti"]);
$Nom_Uti = mb_strtoupper($Nom_Uti);
$Prenom_Uti = utf8_encode($returnQueryGetCommande[0]["Prenom_Uti"]);
$Id_Statut = $returnQueryGetCommande[0]["Id_Statut"];
$Mail_Uti = $returnQueryGetCommande[0]["Mail_Uti"];
$Adr_Uti = utf8_encode($returnQueryGetCommande[0]["Adr_Uti"]);

$bdd = dbConnect();
$queryGetProducteur = $bdd->query('SELECT Prenom_Uti, Nom_Uti, Mail_Uti, Adr_Uti, Prof_Prod FROM info_producteur WHERE Id_Prod='.$Id_Prod);
$returnQueryGetProducteur = $queryGetProducteur->fetchAll(PDO::FETCH_ASSOC);

$Nom_Prod = utf8_encode($returnQueryGetProducteur[0]["Nom_Uti"]);
$Nom_Prod = mb_strtoupper($Nom_Prod);
$Prenom_Prod = utf8_encode($returnQueryGetProducteur[0]["Prenom_Uti"]);
$Adr_Prod = utf8_encode($returnQueryGetProducteur[0]["Adr_Uti"]);
$Prof_Prod = utf8_encode($returnQueryGetProducteur[0]["Prof_Prod"]);

require('tfpdf/tfpdf.php');

class MonPDF extends tFPDF
{
    private $pdf;

    public function setPDF($pdf)
    {
        $this->pdf = $pdf;
    }

    function Header()
    {
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(0, 5, utf8_encode('Bon de commande'), 0, 1, 'C');
        $this->pdf->Cell(0, 0, '', 'T');
        $this->pdf->Ln(5);
    }

    function Footer()
    {
        $this->pdf->SetY(-15);
        $this->pdf->SetFont('Arial', 'I', 12);
        $this->pdf->Cell(0, 10, utf8_encode('Page ' . $this->pdf->PageNo()), 0, 0, 'C');
    }
}

$pdf = new MonPDF();
$pdf->setPDF($pdf);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 5, utf8_encode($Nom_Prod.' '.$Prenom_Prod), 0, 1);
$pdf->Cell(0, 5, utf8_encode($Prof_Prod), 0, 1);
$pdf->Cell(0, 5, utf8_encode($Adr_Prod), 0, 1);

$pdf->Cell(0, 5, utf8_encode($Nom_Uti.' '.$Prenom_Uti), 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(0, 5, utf8_encode($Adr_Uti), 0, 0, 'R');
$pdf->Ln(5);

$pdf->Cell(0, 5, utf8_encode('COMMANDE n°'.$Id_Commande.' :'), 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 8, utf8_encode('Produit'), 1);
$pdf->Cell(40, 8, utf8_encode('Prix Unitaire'), 1);
$pdf->Cell(30, 8, utf8_encode('Quantité'), 1);
$pdf->Cell(40, 8, utf8_encode('Prix'), 1);
$pdf->Ln();

$total=0;
$queryGetProduitCommande = $bdd->query('SELECT Nom_Produit, Qte_Produit_Commande, Prix_Produit_Unitaire, Nom_Unite_Prix FROM produits_commandes  WHERE Id_Commande ='.$Id_Commande);
$returnQueryGetProduitCommande = $queryGetProduitCommande->fetchAll(PDO::FETCH_ASSOC);
$iterateurProduit=0;
$nbProduit=count($returnQueryGetProduitCommande);

$produits = [];

while ($iterateurProduit<$nbProduit){
    $Nom_Produit=utf8_encode($returnQueryGetProduitCommande[$iterateurProduit]["Nom_Produit"]);
    $Qte_Produit_Commande=$returnQueryGetProduitCommande[$iterateurProduit]["Qte_Produit_Commande"];
    $Nom_Unite_Prix=utf8_encode($returnQueryGetProduitCommande[$iterateurProduit]["Nom_Unite_Prix"]);
    $Prix_Produit_Unitaire=$returnQueryGetProduitCommande[$iterateurProduit]["Prix_Produit_Unitaire"];
    array_push($produits, [$Nom_Produit, $Prix_Produit_Unitaire, $Qte_Produit_Commande.' '.$Nom_Unite_Prix]);
    $total=$total+intval($Prix_Produit_Unitaire)*intval($Qte_Produit_Commande);
    $iterateurProduit++;
}

$pdf->SetFont('Arial', '', 12);
foreach ($produits as $produit) {
    $pdf->Cell(40, 8, utf8_encode($produit[0]), 1);
    $pdf->Cell(40, 8, '$' . $produit[1], 1); 
    $pdf->Cell(30, 8, utf8_encode($produit[2]), 1);
    $pdf->Cell(40, 8, '$' . intval($produit[1]) * intval($produit[2]), 1); 
    $pdf->Ln();
}

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(110, 8, utf8_encode('TOTAL'), 1);
$pdf->Cell(40, 8, '$' . $total, 1);
$pdf->Ln();

$pdf->Ln(5);

date_default_timezone_set('Europe/Paris');
$date = new DateTime('now');

$pdf->Cell(0, 5, utf8_encode("Imprimé le " . $date->format('Y-m-d H:i:s')), 0, 1);

$nom_fichier = tempnam(sys_get_temp_dir(), 'pdf');
$pdf->Output($nom_fichier, 'F');

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Commande_'.$Id_Commande.'.pdf"');
header('Content-Length: ' . filesize($nom_fichier));

readfile($nom_fichier);
unlink($nom_fichier);
?>

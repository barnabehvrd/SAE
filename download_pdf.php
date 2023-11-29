<?php
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
$Nom_Producteur = $returnQueryGetCommande[0]["Nom_Prod"];

// Génération du contenu PDF en binaire
$pdfContent = pack("C*", 37, 80, 68, 70, 45, 49, 46, 51, 10, 49, 32, 48, 32, 111, 98, 106, 10, 60, 60, 10, 47, 84, 121, 112, 101, 32, 47, 67, 97, 116, 97, 108, 111, 103, 10, 47, 80, 97, 103, 101, 115, 32, 50, 32, 48, 32, 82, 10, 47, 67, 111, 117, 110, 116, 32, 49, 10, 47, 75, 105, 100, 115, 32, 91, 51, 32, 48, 32, 82, 93, 10, 47, 75, 105, 100, 115, 32, 91, 51, 32, 48, 32, 82, 93, 10, 47, 67, 111, 117, 110, 116, 32, 49, 10, 62, 62, 10, 101, 110, 100, 111, 98, 106, 10, 50, 32, 48, 32, 111, 98, 106, 10, 60, 60, 10, 47, 84, 121, 112, 101, 32, 47, 80, 97, 103, 101, 115, 10, 47, 75, 105, 100, 115, 32, 91, 52, 32, 48, 32, 82, 93, 10, 47, 67, 111, 117, 110, 116, 32, 49, 10, 62, 62, 10, 101, 110, 100, 111, 98, 106, 10, 120, 114, 101, 102, 10, 37, 37, 69, 79, 70, 10);

// Envoie les entêtes pour indiquer que le contenu est un PDF à télécharger
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename=bill.pdf');

// Sortie du contenu PDF généré
echo $pdfContent;
?>
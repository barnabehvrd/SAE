<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<?php
    	function dbConnect(){
    $utilisateur = "inf2pj02";
    $serveur = "localhost";
    $motdepasse = "ahV4saerae";
    $basededonnees = "inf2pj_02";

    // Connect to database
    return new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
      }
	  $bdd=dbConnect();
	  session_start();
	  $utilisateur=$_SESSION["Id_Uti"];
    ?>
    <div class="container">
        <div class="left-column">
			<img class="logo" src="img/logo.png">
        </div>
        <div class="right-column">
            <div class="fixed-banner">
                <!-- Partie gauche du bandeau -->
                <div class="banner-left">
                    <div class="button-container">
                        <button class="button"><a href="index.php">accueil</a></button>
                        <button class="button"><a href="message.php">messagerie</a></button>           
						<button class="button"><a href="commandes.php">commandes</a></button>
						<button class="button"><a href="commandes.php">commandes</a></button>
						<?php 
							//$isProducteur = $bdd->query('CALL isProducteur('.$utilisateur.');');
							//$returnIsProducteur = $isProducteur->fetchAll(PDO::FETCH_ASSOC);
							//var_dump($returnIsProducteur[0]["result"]);
						?>
                    </div>
                </div>
                <!-- Partie droite du bandeau -->
                <div class="banner-right">
					<a class="fixed-size-button" href="form_sign_in.php" >
					<?php if (!isset($_SESSION)) {
					echo "connection";
					}
					else {
					echo $_SESSION['Mail_Uti']; 
					}
						
					?>
					
					
					</a>
                </div>
            </div>
			<div class="contenu">
            <!-- Contenu de la partie droite (sous le bandeau) -->
            <h1>Partie droite (1/5)</h1>
			<?php
                $queryGetCommande = $bdd->query(('SELECT Desc_Statut, Id_Commande, Nom_Uti, Prenom_Uti, Adr_Uti FROM COMMANDE INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut WHERE COMMANDE.Id_Uti='.$utilisateur.';'));
                $returnQueryGetCommande = $queryGetCommande->fetchAll(PDO::FETCH_ASSOC);
                $iterateurCommande=0;
                if(count($returnQueryGetCommande)==0){
                    echo "Aucune commande pour le moment";
                }
                else{
                    while ($iterateurCommande<count($returnQueryGetCommande)){
						$Id_Commande = $returnQueryGetCommande[$iterateurCommande]["Id_Commande"];
						$Nom_Prod = $returnQueryGetCommande[$iterateurCommande]["Nom_Uti"];
						$Nom_Prod = strtoupper($Nom_Prod);
						$Prenom_Prod = $returnQueryGetCommande[$iterateurCommande]["Prenom_Uti"];
						$Adr_Uti = $returnQueryGetCommande[$iterateurCommande]["Adr_Uti"];
						$Desc_Statut = $returnQueryGetCommande[$iterateurCommande]["Desc_Statut"];
						$Desc_Statut = strtoupper($Desc_Statut);

						$total=0;
						$queryGetProduitCommande = $bdd->query(('SELECT Nom_Produit, Qte_Produit_Commande, Prix_Produit_Unitaire, Nom_Unite_Prix FROM produits_commandes  WHERE Id_Commande ='.$Id_Commande.';'));
						$returnQueryGetProduitCommande = $queryGetProduitCommande->fetchAll(PDO::FETCH_ASSOC);
						$iterateurProduit=0;
						$nbProduit=count($returnQueryGetProduitCommande);

						if ($nbProduit>0){
							echo '<div class="commande" >';
							echo "Commande n°" . $iterateurCommande+1 ." : Chez ".$Prenom_Prod.' '.$Nom_Prod.' - '.$Adr_Uti;
							echo '</br>';
							echo $Desc_Statut;
							echo '</br>';
							echo '<form action="delete_commande.php" method="post">';
							echo '<input type="hidden" name="deleteValeur" value="'.$Id_Commande.'">';

							echo '<button type="submit">Annuler commande</button>';
							echo '</form>';
						}

						while ($iterateurProduit<$nbProduit){
							$Nom_Produit=$returnQueryGetProduitCommande[$iterateurProduit]["Nom_Produit"];
							$Qte_Produit_Commande=$returnQueryGetProduitCommande[$iterateurProduit]["Qte_Produit_Commande"];
							$Nom_Unite_Prix=$returnQueryGetProduitCommande[$iterateurProduit]["Nom_Unite_Prix"];
							$Prix_Produit_Unitaire=$returnQueryGetProduitCommande[$iterateurProduit]["Prix_Produit_Unitaire"];
							echo "- " . $Nom_Produit ." - ".$Qte_Produit_Commande.' '.$Nom_Unite_Prix.' * '.$Prix_Produit_Unitaire.'€ = '.intval($Prix_Produit_Unitaire)*intval($Qte_Produit_Commande).'€';
							echo "</br>";
							$total=$total+intval($Prix_Produit_Unitaire)*intval($Qte_Produit_Commande);
							$iterateurProduit++;
						}
                        $iterateurCommande++;
						if ($nbProduit>0){
							echo '<div class="aDroite">Total : '.$total.'€</div>';
							echo '</div> '; 
						}
                    }
                }
            ?>
			</div>
			<form class="formulaire" action="bug_report.php" method="post">
					<p class= "centered">report a bug</p>
					<label for="mail">mail :</label>
					<input type="text" name="mail" id="mail" required><br><br>
					<label for="pwd">message : </label>
					<input type="text" name="message" id="message" required><br><br>
					<input type="submit" value="Envoyer">
			</form>
			
		</div>
    </div>
</body>
</html>

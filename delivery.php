<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
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
					<button class="button"><a href="index.php">Accueil</a></button>
                        <button class="button"><a href="message.php">Messagerie</a></button>                 
						<button class="button"><a href="commandes.php">Achats</a></button>
                        <?php
                            if (isset($_SESSION["isProd"]) and ($_SESSION["isProd"]==true)){
                                echo '<button class="button"><a href="mes_produits.php">Mes produits</a></button>';
                                echo '<button class="button"><a href="delivery.php">Préparation des commandes</a></button>';
                            }
                        ?>
                    </div>
                </div>
                <!-- Partie droite du bandeau -->
                <div class="banner-right">
					<?php 
                    if (isset($_SESSION['Mail_Uti'])) {  
                    echo '<a class="fixed-size-button" href="user_informations.php" >';
					echo $_SESSION['Mail_Uti']; 
					}
					else {
                    echo '<a class="fixed-size-button" href="form_sign_in.php" >';
					echo "connection";
					}
					?>
					</a>
                </div>
            </div>
			<div class="contenu">
            <!-- Contenu de la partie droite (sous le bandeau) -->
            <h1>Partie droite (1/5)</h1>
			<?php
                $queryGetCommande = $bdd->query(('SELECT Desc_Statut, Id_Commande, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut FROM COMMANDE INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti WHERE info_producteur.Id_Uti='.$utilisateur.';'));
                $returnQueryGetCommande = $queryGetCommande->fetchAll(PDO::FETCH_ASSOC);
                $iterateurCommande=0;
                if(count($returnQueryGetCommande)==0){
                    echo "Aucune commande pour le moment";
                }
                else{
                    while ($iterateurCommande<count($returnQueryGetCommande)){
						$Id_Commande = $returnQueryGetCommande[$iterateurCommande]["Id_Commande"];
						$Desc_Statut = $returnQueryGetCommande[$iterateurCommande]["Desc_Statut"];
						$Desc_Statut = mb_strtoupper($Desc_Statut);
                        $Nom_Client = $returnQueryGetCommande[$iterateurCommande]["Nom_Uti"];
						$Nom_Client = mb_strtoupper($Nom_Client);
                        $Prenom_Client = $returnQueryGetCommande[$iterateurCommande]["Prenom_Uti"];
                        $Id_Statut = $returnQueryGetCommande[$iterateurCommande]["Id_Statut"];
                        //echo $Id_Statut;
                        
						$total=0;
						$queryGetProduitCommande = $bdd->query(('SELECT Nom_Produit, Qte_Produit_Commande, Prix_Produit_Unitaire, Nom_Unite_Prix FROM produits_commandes  WHERE Id_Commande ='.$Id_Commande.';'));
						$returnQueryGetProduitCommande = $queryGetProduitCommande->fetchAll(PDO::FETCH_ASSOC);
						$iterateurProduit=0;
						$nbProduit=count($returnQueryGetProduitCommande);

						if (($nbProduit>0)){
							echo '<div class="commande" >';
							echo "Client ".$Prenom_Client." ".$Nom_Client;
							echo '</br>';
							echo "COMMANDE ".$Desc_Statut." ";
                            ?>
                            <form action="change_status_commande.php" method="post">
                                <select name="categorie">
                                    <option value="">--MODIFIER LE STATUT--</option>
                                    <option value="1">EN COURS</option>
                                    <option value="2">PRÊTE</option>
                                    <option value="3">ANNULÉE</option>
                                    <option value="4">LIVRÉE</option>
                                </select>
                                <input type="hidden" name="idCommande" value="<?php echo $Id_Commande?>">
                                <button type="submit">Confirmer</button>
                            </form>
                            <br>
                        <?php
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

						if ($nbProduit>0){
							echo '<div class="aDroite">Total : '.$total.'€</div>';
							echo '</div> '; 
						}
                        $iterateurCommande++;
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

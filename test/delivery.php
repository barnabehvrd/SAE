<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'étal en ligne</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
</head>
<body>

    <?php
        if(!isset($_SESSION)){
            session_start();
        }
    	function dbConnect(){
            $host = 'localhost';
            $dbname = 'inf2pj_02';
            $user = 'inf2pj02';
            $password = 'ahV4saerae';
            return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
      }

	  $bdd=dbConnect();
	  $utilisateur=htmlspecialchars($_SESSION["Id_Uti"]);
      if (isset($_POST["typeCategorie"])==true){
        $filtreCategorie=htmlspecialchars($_POST["typeCategorie"]);
      }
      else{
        $filtreCategorie=0;
      }
    ?>


    <div class="container">
        <div class="leftColumn">
			<img class="logo" href="index.php" src="img/logo.png">
            <div class="contenuBarre">
                
            

            <center>
                <p><strong>Filtrer par :</strong></p>
                <br>
            </center>
            Statut 
            <br>
            
            <form action="delivery.php" method="post">
                <label>
                    <input type="radio" name="typeCategorie" value="0" <?php if($filtreCategorie==0) echo 'checked="true"';?>> TOUT
                </label>
                <br>
                <label>
                    <input type="radio" name="typeCategorie" value="1" <?php if($filtreCategorie==1) echo 'checked="true"';?>> EN COURS
                </label>
                <br>
                <label>
                    <input type="radio" name="typeCategorie" value="2"<?php if($filtreCategorie==2) echo 'checked="true"';?>> PRÊTE
                </label>
                <br>
                <label>
                    <input type="radio" name="typeCategorie" value="4" <?php if($filtreCategorie==4) echo 'checked="true"';?>> LIVRÉE
                </label>
                <br>
                <label>
                    <input type="radio" name="typeCategorie" value="3" <?php if($filtreCategorie==3) echo 'checked="true"';?>> ANNULÉE
                </label>

                <br>
                <br>
                <center>
                    <input type="submit" value="Filtrer">
                </center>
            </form>


            </div>
        </div>
        <div class="rightColumn">
            <div class="topBanner">
                <div class="divNavigation">
                    <a class="bontonDeNavigation" href="index.php">Accueil</a>
                    <?php
                        if (isset($_SESSION["Id_Uti"])){
                            echo'<a class="bontonDeNavigation" href="messagerie.php">Messagerie</a>';
                            echo'<a class="bontonDeNavigation" href="achats.php">Achats</a>';
                        }
                        if (isset($_SESSION["isProd"]) and ($_SESSION["isProd"]==true)){
                            echo'<a class="bontonDeNavigation" href="produits.php">Produits</a>';
                            echo'<a class="bontonDeNavigation" href="delivery.php">Commandes</a>';
                        }
                    ?>
                </div>
                <form method="post">
                    <?php
                    if(!isset($_SESSION)){
                    session_start();
                    }
                    if(isset($_SESSION, $_SESSION['tempPopup'])){
                        $_POST['popup'] = $_SESSION['tempPopup'];
                        unset($_SESSION['tempPopup']);
                    }
                    ?>
					<input type="submit" value=<?php if (!isset($_SESSION['Mail_Uti'])){/*$_SESSION = array()*/; echo '"Se Connecter"';}else {echo '"'.$_SESSION['Mail_Uti'].'"';}?> class="boutonDeConnection">
                    <input type="hidden" name="popup" value=<?php if(isset($_SESSION['Mail_Uti'])){echo '"info_perso"';}else{echo '"sign_in"';}?>>
				</form>
            </div>
            <div class="contenuPage">



            
            <?php
                if ($filtreCategorie!=0){
                    $query = 'SELECT Desc_Statut, Id_Commande, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut 
                    FROM COMMANDE 
                    INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod 
                    INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut 
                    INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti 
                    WHERE info_producteur.Id_Uti = :utilisateur AND COMMANDE.Id_Statut = :filtreCategorie';
                    $queryGetCommande = $bdd->prepare($query);
                    $queryGetCommande->bindParam(':utilisateur', $utilisateur, PDO::PARAM_INT);
                    $queryGetCommande->bindParam(':filtreCategorie', $filtreCategorie, PDO::PARAM_INT);            
                }
                else{
                    $query = 'SELECT Desc_Statut, Id_Commande, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut 
                    FROM COMMANDE 
                    INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod 
                    INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut 
                    INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti 
                    WHERE info_producteur.Id_Uti = :utilisateur';
          
                    $queryGetCommande = $bdd->prepare($query);
                    $queryGetCommande->bindParam(':utilisateur', $utilisateur, PDO::PARAM_INT);
                    
                }
                $queryGetCommande->execute();
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
                        $Id_Uti = $returnQueryGetCommande[$iterateurCommande]["Id_Uti"];
                        //echo $Id_Statut;
                        
						$total=0;
                        $query = 'SELECT Nom_Produit, Qte_Produit_Commande, Prix_Produit_Unitaire, Nom_Unite_Prix 
                        FROM produits_commandes 
                        WHERE Id_Commande = :idCommande';
                        $queryGetProduitCommande = $bdd->prepare($query);
                        $queryGetProduitCommande->bindParam(':idCommande', $Id_Commande, PDO::PARAM_INT);
                        $queryGetProduitCommande->execute();
                        $returnQueryGetProduitCommande = $queryGetProduitCommande->fetchAll(PDO::FETCH_ASSOC);
						$iterateurProduit=0;
						$nbProduit=count($returnQueryGetProduitCommande);

						if (($nbProduit>0)){
							echo '<div class="commande" >';
							echo "Client ".$Prenom_Client." ".$Nom_Client;
							echo '</br>';
							echo "COMMANDE ".$Desc_Statut." <br>";
                            if (($Id_Statut!=4) and ($Id_Statut!=3)){
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
                        <?php
						    }
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
                            echo '<input type="button" onclick="window.location.href=\'message.php?Id_Interlocuteur='.$Id_Uti.'\'" value="Envoyer un message"><br>';
                            ?>
                            <form action="download_pdf.php" method="post">
                                <input type="hidden" name="idCommande" value="<?php echo $Id_Commande?>">
                                <button type="submit">Générer en PDF</button>
                            </form>
                            <?php
                            echo '<div class="aDroite">Total : '.$total.'€</div>';
							echo '</div> '; 
						}
                        $iterateurCommande++;
                    }
                }
            ?>





            </div>
            <div class="basDePage">
                <form method="post">
						<input type="submit" value="Signaler un dysfonctionnement" class="lienPopup">
                        <input type="hidden" name="popup" value="contact_admin">
				</form>
                <form method="post">
						<input type="submit" value="CGU" class="lienPopup">
                        <input type="hidden" name="popup" value="cgu">
				</form>
            </div>
        </div>
    </div>
    <?php require "popups/gestion_popups.php";?>
</body>
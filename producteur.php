<!DOCTYPE html>
<html lang="fr">
<head>
<?php
    require_once 'database/database.php';
    use database\database;

    $db = new database();

    require "language.php" ; 
?>
    <title><?php echo $htmlMarque; ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
</head>
<body>
    <?php
      if(!isset($_SESSION)){
        session_start();
        }
      // variable utilisée plusieurs fois par la suite
      $Id_Prod = $_GET["Id_Prod"];
      // id_prod to int

      $filtreType = "";
      if (isset($_GET["filtreType"])==true){

          $filtreType==$_GET["filtreType"];
      }
      else{
        $filtreType="TOUT";
      }

      $tri = "";
      if (isset($_GET["tri"])==true){
        $tri=$_GET["tri"];
      }
      else{
        $tri="No";
      }
      if (isset($_GET["rechercheNom"])==true){
        $rechercheNom=$_GET["rechercheNom"];
      }
      else{
        $rechercheNom="";
      }
    ?>
    <div class="container">
        <div class="leftColumn">
			<img class="logo" href="index.php" src="img/logo.png">
            <div class="contenuBarre">
                <!-- some code -->

                <center>
                <p><strong><?php echo $htmlRechercherPar; ?></strong></p>
            </center>
            <br>
            <form action="producteur.php" method="get">
            <?php echo $htmlTiretNom; ?>
                <input type="text" name="rechercheNom" value="<?php echo $rechercheNom?>" placeholder="<?php echo $htmlNom; ?>">
                <br>
                <br>
                - Type de produit :
                <br>
                <input type="hidden" name="Id_Prod" value="<?php echo $Id_Prod?>">
                <label>
                    <input type="radio" name="filtreType" value="TOUT" <?php if($filtreType=="TOUT") echo 'checked="true"';?>> <?php echo $htmlTout; ?>
                </label>
                <br>
                <label>
                    <input type="radio" name="filtreType" value="ANIMAUX" <?php if($filtreType=="ANIMAUX") echo 'checked="true"';?>> <?php echo $htmlAnimaux; ?>
                </label>
                <br>
                <label>
                    <input type="radio" name="filtreType" value="FRUITS" <?php if($filtreType=="FRUITS") echo 'checked="true"';?>> <?php echo $htmlFruits; ?>
                </label>
                <br>
                <label>
                    <input type="radio" name="filtreType" value="GRAINS"<?php if($filtreType=="GRAINS") echo 'checked="true"';?>> <?php echo $htmlGraines; ?>
                </label>
                <br>
                <label>
                    <input type="radio" name="filtreType" value="LÉGUMES" <?php if($filtreType=="LÉGUMES") echo 'checked="true"';?>> <?php echo $htmlLégumes; ?>
                </label>
                <br>
                <label>
                    <input type="radio" name="filtreType" value="PLANCHES" <?php if($filtreType=="PLANCHES") echo 'checked="true"';?>> <?php echo $htmlPlanches; ?>
                </label>
                <br>
                <label>
                    <input type="radio" name="filtreType" value="VIANDE" <?php if($filtreType=="VIANDE") echo 'checked="true"';?>> <?php echo $htmlViande; ?>
                </label>
                <br>
                <label>
                    <input type="radio" name="filtreType" value="VIN" <?php if($filtreType=="VIN") echo 'checked="true"';?>> <?php echo $htmlVin; ?>
                </label>
                <br>
                <br>
                <br>
                <?php echo $htmlTri; ?>
                <select name="tri">
                    <option value="No" <?php if($tri=="No") echo 'selected="selected"';?>><?php echo $htmlAucunTri; ?></option>
                    <option value="PrixAsc" <?php if($tri=="PrixAsc") echo 'selected="selected"';?>><?php echo $htmlPrixCroissant; ?></option>
                    <option value="PrixDesc" <?php if($tri=="PrixDesc") echo 'selected="selected"';?>><?php echo $htmlPrixDecroissant; ?></option>
                    <option value="Alpha" <?php if($tri=="Alpha") echo 'selected="selected"';?>><?php echo $htmlOrdreAlpha; ?></option>
                    <option value="AntiAlpha" <?php if($tri=="AntiAlpha") echo 'selected="selected"';?>><?php echo $htmlOrdreAntiAlpha; ?></option>
			    </select>
                <br>
                <br>
                <center>
                    <input type="submit" value="<?php echo $htmlRechercher; ?>">
                </center>
            </form>
            <br>
            <br>  


            </div>
        </div>
        <div class="rightColumn">
            <div class="topBanner">
                <div class="divNavigation">
                <a class="bontonDeNavigation" href="index.php"><?php echo $htmlAccueil?></a>
                    <?php
                        if (isset($_SESSION["Id_Uti"])){
                            echo'<a class="bontonDeNavigation" href="messagerie.php">'.$htmlMessagerie.'</a>';
                            echo'<a class="bontonDeNavigation" href="achats.php">'.$htmlAchats.'</a>';
                        }
                        if (isset($_SESSION["isProd"]) and ($_SESSION["isProd"]==true)){
                            echo'<a class="bontonDeNavigation" href="produits.php">'.$htmlProduits.'</a>';
                            echo'<a class="bontonDeNavigation" href="delivery.php">'.$htmlCommandes.'</a>';
                        }
                        if (isset($_SESSION["isAdmin"]) and ($_SESSION["isAdmin"]==true)){
                            echo'<a class="bontonDeNavigation" href="panel_admin.php">'.$htmlPanelAdmin.'</a>';
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

                    <input type="submit" value="<?php if (!isset($_SESSION['Mail_Uti'])){/*$_SESSION = array()*/; echo($htmlSeConnecter);} else {echo ''.$_SESSION['Mail_Uti'].'';}?>" class="boutonDeConnection">
                    <input type="hidden" name="popup" value=<?php if(isset($_SESSION['Mail_Uti'])){echo '"info_perso"';}else{echo '"sign_in"';}?>>
                
                </form>
            </div>



            <form method="get" action="insert_commande.php">
                <input type="hidden" name="Id_Prod" value="<?php echo $Id_Prod?>">
            
            <div class="content-container">
                <div class="product">
                    <!-- partie de gauche avec les produits -->
                    <p><center><U><?php echo $htmlProduitsProposesDeuxPoints; ?></U></center></p>
                    <div class="gallery-container">
                        <?php
                        $db->select("SELECT 1");
                            $query = 'SELECT Id_Produit, Id_Prod, Nom_Produit, Desc_Type_Produit, Prix_Produit_Unitaire, Nom_Unite_Prix, Qte_Produit FROM Produits_d_un_producteur 
                                    WHERE Id_Prod= :Id_Prod AND Desc_Type_Produit LIKE :filtreType AND Nom_Produit LIKE :rechercheNom';

                            //tri
                            if ($tri=="No"){
                                $query=$query.';';
                            }
                            else if ($tri=="PrixAsc"){
                                $query=$query.' ORDER BY Prix_Produit_Unitaire ASC;';
                            }
                            else if ($tri=="PrixDesc"){
                                $query=$query.' ORDER BY Prix_Produit_Unitaire DESC;';
                            }
                            else if ($tri=="Alpha"){
                                $query=$query.' ORDER BY Nom_Produit ASC;';
                            }
                            else if ($tri=="AntiAlpha"){
                                $query=$query.' ORDER BY Nom_Produit DESC;';
                            }

                            //preparation paramètres

                            echo "===================";
                            echo $Id_Prod;
                            echo "===================";

                                if ($filtreType=="TOUT"){
                                $returnQueryGetProducts=$db->select($query, [
                                        ':Id_Prod' => 4,
                                        ':filtreType' => '%',
                                        ':rechercheNom' => '%'.$rechercheNom.'%']);

                            }
                            else {
                                $returnQueryGetProducts=$db->select($query, [':Id_Prod' => 4, ':filtreType' => $filtreType, ':rechercheNom' => '%'.$rechercheNom.'%']);
                            }

                            $db->select("SELECT 2");

                            $i=0;
                            if(count($returnQueryGetProducts)==0){
                                echo $htmlAucunProduitEnStock;
                            }
                            else{
                                while ($i<count($returnQueryGetProducts)){
                                    $Id_Produit = $returnQueryGetProducts[$i]["Id_Produit"];
                                    $nomProduit = $returnQueryGetProducts[$i]["Nom_Produit"];
                                    $typeProduit = $returnQueryGetProducts[$i]["Desc_Type_Produit"];
                                    $prixProduit = $returnQueryGetProducts[$i]["Prix_Produit_Unitaire"];
                                    $QteProduit = $returnQueryGetProducts[$i]["Qte_Produit"];
                                    $unitePrixProduit = $returnQueryGetProducts[$i]["Nom_Unite_Prix"];

                                    if ($QteProduit>0){
                                        echo '<div class="squareProduct" >';
                                        echo $htmlProduitDeuxPoints, $nomProduit . "<br>";
                                        echo $htmlTypeDeuxPoints, $typeProduit . "<br>";
                                        echo $htmlPrix, $prixProduit .' €/'.$unitePrixProduit. "<br>";
                                        echo '<img class="img-produit" src="img_produit/' . $Id_Produit  . '.png" alt="'.$htmlImageNonFournie.'" style="width: 100%; height: 85%;" ><br>';
                                        echo '<input type="number" name="'.$Id_Produit.'" placeholder="max '.$QteProduit.'" max="'.$QteProduit.'" min="0" value="0"> '.$unitePrixProduit;
                                        echo '</div> '; 
                                    }
                                    $i++;
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="producteur">
                    <!-- partie de droite avec les infos producteur -->
                    <?php
                        $returnQueryInfoProd = $db->select('SELECT UTILISATEUR.Id_Uti, UTILISATEUR.Adr_Uti, Prenom_Uti, Nom_Uti, Prof_Prod FROM UTILISATEUR INNER JOIN PRODUCTEUR ON UTILISATEUR.Id_Uti = PRODUCTEUR.Id_Uti WHERE PRODUCTEUR.Id_Prod= :Id_Prod ;', [':Id_Prod' => $Id_Prod]);

                        // recupération des paramètres de la requête qui contient 1 élément
                        $idUti = $returnQueryInfoProd[0]["Id_Uti"];
                        $address = $returnQueryInfoProd[0]["Adr_Uti"];
                        $nom = $returnQueryInfoProd[0]["Nom_Uti"];
                        $prenom = $returnQueryInfoProd[0]["Prenom_Uti"];
                        $profession = $returnQueryInfoProd[0]["Prof_Prod"];
                    ?>
                    <div class="info-container">
						<div class="img-prod">
                        	<img class="img-test" src="img_producteur/<?php echo $Id_Prod; ?>.png" alt="<?php echo $htmlImgProducteur; ?>" style="width: 99%; height: 99%;">
						</div>
						<div class="text-info">
                            <?php
                                echo '</br>'.$prenom . ' ' . strtoupper($nom) . '</br></br><strong>' . $profession.'</strong></br></br>'.$address.'</br></br>';
                            ?>
                        </div>
                    </div>
                    
                    
                    <?php
                    //bloquer les 2 boutons pour les visiteurs non connectés
                    if (isset($_SESSION["Id_Uti"])  and $idUti!=$_SESSION["Id_Uti"]){
                    ?>
                    <input type="button" onclick="window.location.href='messagerie.php?Id_Interlocuteur=<?php echo $idUti; ?>'" value="<?php echo $htmlEnvoyerMessage; ?>">
                    <br>
                    <?php 
                    }?>


                    <?php
                        if (isset($address)) {
                            $address = str_replace(" ", "+", $address);
                    ?>
                    <iframe class="map-frame" src="https://maps.google.com/maps?&q=<?php echo $address; ?>&output=embed " 
                        width="100%" height="100%" 
                    ></iframe>
                    <?php } 

                    if (sizeof($returnQueryGetProducts)>0 and isset($_SESSION["Id_Uti"]) and $idUti!=$_SESSION["Id_Uti"]){
                    ?>
                <br>
                <button type="submit"><?php echo $htmlPasserCommande; ?></button>
                <?php }?>
            </form>
                </div>
            </div>



            <div class="basDePage">
                <form method="post">
                    <input type="submit" value="<?php echo $htmlSignalerDys?>" class="lienPopup">
                    <input type="hidden" name="popup" value="contact_admin">
				</form>
                <form method="post">
                        <input type="submit" value="<?php echo $htmlCGU?>" class="lienPopup">
                        <input type="hidden" name="popup" value="cgu">
				</form>
            </div>
        </div>
    </div>
    <?php require "popups/gestion_popups.php";?>
</body>
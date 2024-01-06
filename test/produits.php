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
     function dbConnect(){
        $host = 'localhost';
        $dbname = 'inf2pj_02';
        $user = 'inf2pj02';
        $password = 'ahV4saerae';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
      }
      if(!isset($_SESSION)){
        session_start();
    }
      $utilisateur=$_SESSION["Id_Uti"];
      htmlspecialchars($utilisateur);

      $bdd=dbConnect();
      $queryIdProd = $bdd->prepare(('SELECT Id_Prod FROM PRODUCTEUR WHERE Id_Uti= :Id_Uti ;'));
      $queryIdProd->bindParam(":Id_Uti", $utilisateur, PDO::PARAM_STR);
      $queryIdProd->execute();
      $returnQueryIdProd = $queryIdProd->fetchAll(PDO::FETCH_ASSOC);
      $Id_Prod=$returnQueryIdProd[0]["Id_Prod"];
  
    ?>

    <div class="container">
        <div class="leftColumn">
			<img class="logo" href="index.php" src="img/logo.png">
            <div class="contenuBarre">
                <!-- some code -->



                <center><p><strong>Ajouter un produit</strong></p>
            <form action="insert_products.php" method="post" enctype="multipart/form-data">
                <label for="pwd">Produit : </label>
                <input type="text" pattern="[A-Za-z0-9 ]{0,100}" name="nomProduit" placeholder="nom du produit" required><br><br>

                <select name="categorie">
                    <option value="6">Animaux</option>
                    <option value="1">Fruit</option>
                    <option value="3">Graine</option>
                    <option value="2">Légume</option>
                    <option value="7">Planche</option>
                    <option value="4">Viande</option>
                    <option value="5">Vin</option>
			    </select>
                <br>
                <br>Prix : 
                <input style="width: 50px;" type="number" min="0" name="prix" required>€
                <label>
                    <input type="radio" name="unitPrix" value="1" checked="true"> le kilo
                </label>
                <label>
                    <input type="radio" name="unitPrix" value="4"> la pièce
                </label>
                <br>
                <br>Stock : 
                <input type="number" style="width: 50px;" min="0" name="quantite" required>
                <label>
                    <input type="radio" name="unitQuantite" value="1" checked="true"> Kg
                </label>
                <label>
                    <input type="radio" name="unitQuantite" value="2"> L
                </label>
                <label>
                    <input type="radio" name="unitQuantite" value="3"> m²
                </label>
                <label>
                    <input type="radio" name="unitQuantite" value="4"> Pièce
                </label>
                <br>
                <br>
                <strong>Image :</strong>
                <input type="file" name="image" accept=".png">
                <br>
                <br>
                <br>
                <input type="submit" value="Ajouter le produit">
            </form>
            </center>



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

            


                    <!-- partie de gauche avec les produits -->
                    <p><center><U>Produits proposés :</U></center></p>
                    <div class="gallery-container">
                        <?php
                            $bdd=dbConnect();
                            $queryGetProducts = $bdd->prepare(('SELECT Id_Produit, Nom_Produit, Desc_Type_Produit, Prix_Produit_Unitaire, Nom_Unite_Prix, Qte_Produit, Nom_Unite_Stock FROM Produits_d_un_producteur WHERE Id_Prod= :Id_Prod ;'));
                            $queryGetProducts->bindParam(":Id_Prod", $Id_Prod, PDO::PARAM_STR);
                            $queryGetProducts->execute();
                            $returnQueryGetProducts = $queryGetProducts->fetchAll(PDO::FETCH_ASSOC);

                            $i=0;
                            if(count($returnQueryGetProducts)==0){
                                echo "Aucun produit en stock";
                            }
                            else{
                                while ($i<count($returnQueryGetProducts)){
                                    $Id_Produit = $returnQueryGetProducts[$i]["Id_Produit"];
                                    $nomProduit = $returnQueryGetProducts[$i]["Nom_Produit"];
                                    $typeProduit = $returnQueryGetProducts[$i]["Desc_Type_Produit"];
                                    $prixProduit = $returnQueryGetProducts[$i]["Prix_Produit_Unitaire"];
                                    $QteProduit = $returnQueryGetProducts[$i]["Qte_Produit"];
                                    $unitePrixProduit = $returnQueryGetProducts[$i]["Nom_Unite_Prix"];
                                    $Nom_Unite_Stock = $returnQueryGetProducts[$i]["Nom_Unite_Stock"];
                                if ($QteProduit>0){
                                        echo '<style>';
                                        echo 'form { display: inline-block; margin-right: 1px; }'; // Ajustez la marge selon vos besoins
                                        echo 'button { display: inline-block; }';
                                        echo '</style>';
                                        echo '<div class="squareProduct" >';
                                        echo "Produit : " . $nomProduit . "<br>";
                                        echo "Type : " . $typeProduit . "<br>";
                                        echo '<img class="img-produit" src="/~inf2pj02/img_produit/' . $Id_Produit  . '.png" alt="Image non fournie" style="width: 100%; height: 85%;" ><br>';
                                        echo "Prix : " . $prixProduit .' €/'.$unitePrixProduit. "<br>";
                                        echo "Stock : " . $QteProduit .' '.$Nom_Unite_Stock. "<br>";
                                        echo '<form action="product_modification.php" method="post">';
                                        echo '<input type="hidden" name="modifyIdProduct" value="'.$Id_Produit.'">';
                                        echo '<button type="submit" name="action">Modifier</button>';
                                        echo '</form>';
                                        echo '<form action="delete_product.php" method="post">';
                                        echo '<input type="hidden" name="deleteIdProduct" value="'.$Id_Produit.'">';
                                        echo '<button type="submit" name="action">Supprimer</button>';
                                        echo '</form>';
                                        echo '</div> '; 
                                    }
                                    $i++;
                                }
                            }
                        ?>
                    </div>
                    <br>
                    <br>
                    <br>



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
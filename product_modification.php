<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
     function dbConnect(){
        $host = 'localhost';
        $dbname = 'sae3';
        $user = 'root';
        $password = '';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
      }
      session_start();
      $utilisateur=$_SESSION["Id_Uti"];
      $Id_Produit_Update=$_POST["modifyIdProduct"];
      $bdd=dbConnect();
      $queryGetProducts = $bdd->query(('SELECT * FROM PRODUIT WHERE Id_Produit=\''.$Id_Produit_Update.'\';'));
      $returnQueryGetProducts = $queryGetProducts->fetchAll(PDO::FETCH_ASSOC);
      //var_dump($returnQueryGetProducts);
      $IdProd = $returnQueryGetProducts[0]["Id_Prod"];
      $Nom_Produit = $returnQueryGetProducts[0]["Nom_Produit"];
      $Id_Type_Produit = $returnQueryGetProducts[0]["Id_Type_Produit"];
      $Qte_Produit = $returnQueryGetProducts[0]["Qte_Produit"];
      $Id_Unite_Stock = $returnQueryGetProducts[0]["Id_Unite_Stock"];
      $Prix_Produit_Unitaire = $returnQueryGetProducts[0]["Prix_Produit_Unitaire"];
      $Id_Unite_Prix = $returnQueryGetProducts[0]["Id_Unite_Prix"];
      //var_dump($Id_Type_Produit);
    ?>
    <div class="container">
        <div class="left-column">
            <img class="logo" src="img/logo.png">
            <!-- Contenu de la partie gauche -->
            <center><p><strong>Ajouter un produit</strong></p>
            <form action="modify_products.php" method="post">
                <label for="pwd">Produit : </label>
                <input type="text" name="nomProduit" value="<?php echo $Nom_Produit?>" required><br><br>


                <select name="categorie">
                    <?php 
                    
                        switch ($Id_Type_Produit) {
                            case 1:
                                echo "";
                                echo "<option value=\"1\">Fruit</option>";
                                echo "<option value=\"6\">Animaux</option>";
                                echo "<option value=\"3\">Graine</option>";
                                echo "<option value=\"2\">Légume</option>";
                                echo "<option value=\"7\">Planche</option>";
                                echo "<option value=\"4\">Viande</option>";
                                echo "<option value=\"5\">Vin</option>";
                                break;
                            case 2:
                                echo "<option value=\"2\">Légume</option>";
                                echo "<option value=\"6\">Animaux</option>";
                                echo "<option value=\"1\">Fruit</option>";
                                echo "<option value=\"3\">Graine</option>";
                                echo "<option value=\"7\">Planche</option>";
                                echo "<option value=\"4\">Viande</option>";
                                echo "<option value=\"5\">Vin</option>";
                                break;
                            case 3:
                                echo "<option value=\"3\">Graine</option>";
                                echo "<option value=\"6\">Animaux</option>";
                                echo "<option value=\"1\">Fruit</option>";
                                echo "<option value=\"2\">Légume</option>";
                                echo "<option value=\"7\">Planche</option>";
                                echo "<option value=\"4\">Viande</option>";
                                echo "<option value=\"5\">Vin</option>";
                                break;
                            case 4:
                                echo "<option value=\"4\">Viande</option>";
                                echo "<option value=\"6\">Animaux</option>";
                                echo "<option value=\"1\">Fruit</option>";
                                echo "<option value=\"3\">Graine</option>";
                                echo "<option value=\"2\">Légume</option>";
                                echo "<option value=\"7\">Planche</option>";
                                echo "<option value=\"5\">Vin</option>";
                                break;
                            case 5:
                                echo "<option value=\"5\">Vin</option>";
                                echo "<option value=\"6\">Animaux</option>";
                                echo "<option value=\"1\">Fruit</option>";
                                echo "<option value=\"3\">Graine</option>";
                                echo "<option value=\"2\">Légume</option>";
                                echo "<option value=\"7\">Planche</option>";
                                echo "<option value=\"4\">Viande</option>";
                                break;
                            case 6:
                                echo "<option value=\"6\">Animaux</option>";
                                echo "<option value=\"1\">Fruit</option>";
                                echo "<option value=\"3\">Graine</option>";
                                echo "<option value=\"2\">Légume</option>";
                                echo "<option value=\"7\">Planche</option>";
                                echo "<option value=\"4\">Viande</option>";
                                echo "<option value=\"5\">Vin</option>";
                                break;
                            case 7:
                                echo "<option value=\"7\">Planche</option>";
                                echo "<option value=\"6\">Animaux</option>";
                                echo "<option value=\"1\">Fruit</option>";
                                echo "<option value=\"3\">Graine</option>";
                                echo "<option value=\"2\">Légume</option>";
                                echo "<option value=\"4\">Viande</option>";
                                echo "<option value=\"5\">Vin</option>";
                               break;
                        }
                    ?>

			    </select>
                <br>
                <br>Prix : 
                <input style="width: 50px;" value="<?php echo $Prix_Produit_Unitaire?>" type="number" min="0" name="prix" required>€
                <?php
                    switch ($Id_Unite_Prix) {
                        case 1:
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitPrix\" value=\"1\" checked=\"checked\"> le kilo";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitPrix\" value=\"4\"> la pièce";
                            echo "</label>";
                        break;
                        case 4:
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitPrix\" value=\"1\"> le kilo";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitPrix\" value=\"4\" checked=\"checked\"> la pièce";
                            echo "</label>";
                        break;
                    }
                ?>
                <br>
                <br>Stock : 
                <input type="number" value="<?php echo $Qte_Produit?>" style="width: 50px;" min="0" name="quantite" required>
                <?php
                    switch ($Id_Unite_Stock) {
                        case 1:
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"1\" checked=\"checked\"> Kg";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"2\"> L";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"3\"> m²";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"4\"> Pièce";
                            echo "</label>";
                            break;
                        case 2:
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"1\"> Kg";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"2\" checked=\"checked\"> L";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"3\"> m²";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"4\"> Pièce";
                            echo "</label>";
                            break;
                        case 3:
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"1\"> Kg";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"2\"> L";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"3\" checked=\"checked\"> m²";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"4\"> Pièce";
                            echo "</label>";
                            break;
                        case 4:
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"1\"> Kg";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"2\"> L";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"3\"> m²";
                            echo "</label>";
                            echo "<label>";
                            echo "<input type=\"radio\" name=\"unitQuantite\" value=\"4\" checked=\"checked\"> Pièce";
                            echo "</label>";
                            break;
                    }
                ?>
                <br>
                <br>
                <input type="submit" value="Confirmer la modification">
            </form>
            <form action="mes_produits.php" method="post">
                <input type="submit" value="Annuler la modification">
            </form>
            </center>
        </div>
        <div class="right-column">
        <div class="fixed-banner">
                <!-- Partie gauche du bandeau -->
                <div class="banner-left">
                    <div class="button-container">
                        <button class="button"><a href="index.php">Accueil</a></button>
                        <button class="button"><a href="message.php">Messagerie</a></button>                 
						<button class="button"><a href="commandes.php">Commandes</a></button>
                        <?php
                            if (isset($_SESSION["isProd"]) and ($_SESSION["isProd"]==true)){
                                echo '<button class="button"><a href="mes_produits.php">Mes produits</a></button>';
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
            <div class="content-container">
                <div class="product">
                    <!-- partie de gauche avec les produits -->
                    <p><center><U>Produits proposés :</U></center></p>
                    <div class="gallery-container">
                        <?php
                            $bdd=dbConnect();
                            $queryGetProducts = $bdd->query(('SELECT Id_Produit, Nom_Produit, Desc_Type_Produit, Prix_Produit_Unitaire, Nom_Unite_Prix, Qte_Produit, Nom_Unite_Stock FROM Produits_d_un_producteur INNER JOIN PRODUCTEUR ON produits_d_un_producteur.Id_Prod=PRODUCTEUR.Id_Prod INNER JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti=UTILISATEUR.Id_Uti WHERE PRODUCTEUR.Id_Uti=\''.$utilisateur.'\';'));
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
                                        echo '<img class="img-produit" src="/img_produit/' . $Id_Produit  . '.png" alt="Image '.$nomProduit.'" style="width: 100%; height: 85%;" ><br>';
                                        echo "Prix : " . $prixProduit .' €/'.$unitePrixProduit. "<br>";
                                        echo "Stock : " . $QteProduit .' '.$Nom_Unite_Stock. "<br>";
                                        if ($Id_Produit==$Id_Produit_Update){
                                            echo '<input type="submit" disabled="disabled" value="En cours"/></button>';
                                        }
                                        else{
                                            echo '<form action="product_modification.php" method="post">';
                                            echo '<input type="hidden" name="modifyIdProduct" value="'.$Id_Produit.'">';
                                            echo '<button type="submit" name="action">Modifier</button>';
                                            echo '</form>';
                                        }
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
                </div>
            </div>

            <form class="formulaire" action="bug_report.php" method="post">
                <p class="centered">report a bug</p>
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



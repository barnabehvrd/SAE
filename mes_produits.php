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
      $utilisateur=$_SESSION["Id_Uti"][0];
    ?>
    <div class="container">
        <div class="left-column">
            <img class="logo" src="img/logo.png">
            <!-- Contenu de la partie gauche -->
            <h1>Partie gauche (4/5)</h1>
            <p>Ceci est la partie gauche de la page web.</p>
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
                            $queryGetProducts = $bdd->query(('SELECT Id_Produit, Nom_Produit, Desc_Type_Produit, Prix_Produit_Unitaire, Nom_Unite_Prix, Qte_Produit FROM Produits_d_un_producteur INNER JOIN PRODUCTEUR ON produits_d_un_producteur.Id_Prod=PRODUCTEUR.Id_Prod INNER JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti=UTILISATEUR.Id_Uti WHERE PRODUCTEUR.Id_Uti=\''.$utilisateur.'\';'));
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

                                    if ($QteProduit>0){
                                        echo '<div class="squareProduct" >';
                                        echo "Produit : " . $nomProduit . "<br>";
                                        echo "Type : " . $typeProduit . "<br>";
                                        echo "Prix : " . $prixProduit .' €/'.$unitePrixProduit. "<br>";
                                        echo '<img class="img-produit" src="/img_produit/' . $Id_Produit  . '.png" alt="Image '.$nomProduit.'" style="width: 100%; height: 85%;" ><br>';
                                        echo '<input type="number" name="'.$Id_Produit.'" placeholder="max '.$QteProduit.'" max="'.$QteProduit.'" min="0" value="0"> '.$unitePrixProduit;
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



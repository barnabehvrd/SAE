<!DOCTYPE html>
<html lang="fr">
<head>
<?php
if(!isset($_SESSION)){
    session_start();
}
    require "language.php" ;
    require_once 'database/database.php';
    use database\database;

    $db = new database();

?>
    <title><?php echo $htmlMarque; ?></title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">

</head>
<body>

    <?php
    if(!isset($_SESSION)){
        session_start();
        }


        $utilisateur=htmlspecialchars($_SESSION["Id_Uti"]);
        
        $filtreCategorie=0;
        if (isset($_POST["typeCategorie"])==true){
            $filtreCategorie=htmlspecialchars($_POST["typeCategorie"]);
        }
    
    ?>

    <div class="container">
        <div class="leftColumn">
			<img class="logo" href="index.php" src="img/logo.png">
            <div class="contenuBarre">

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
            <div class="gallery-container">
                        <?php
                            $result = $db->select('SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti');

                            if ((count($result)> 0) AND ($_SESSION["isAdmin"]==true)) {
                                echo"<label>- producteurs :</label><br>";

                                foreach ($result as $row) {
                                    echo '<form method="post" action="traitements/del_acc.php" class="squarePanelAdmin">
                                        <input type="submit" name="submit" id="submit" value="'.$htmlSupprimerCompte.'"><br>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                          Supprimer le compte
                                        </button>
                                        <input type="hidden" name="Id_Uti" value="'.$row["Id_Uti"].'">';
                                    echo $htmlNomDeuxPoints, $row["Nom_Uti"] . "<br>";
                                    echo $htmlPrénomDeuxPoints, $row["Prenom_Uti"] . "<br>";
                                    echo $htmlMailDeuxPoints, $row["Mail_Uti"] . "<br>";
                                    echo $htmlAdresseDeuxPoints, $row["Adr_Uti"] . "<br>";
                                    echo $htmlProfessionDeuxPoints, $row["Prof_Prod"] . "<br></form>";
                                }
                                echo '</div>'; 
                            } else {
                                echo $htmlErrorDevTeam;
                            }
                        ?>
                <div class="gallery-container">
                <?php
                    $result = $db->select('SELECT UTILISATEUR.Id_Uti, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM UTILISATEUR WHERE UTILISATEUR.Id_Uti  NOT IN (SELECT PRODUCTEUR.Id_Uti FROM PRODUCTEUR) AND UTILISATEUR.Id_Uti NOT IN (SELECT ADMINISTRATEUR.Id_Uti FROM ADMINISTRATEUR) AND UTILISATEUR.Id_Uti<>0;');

                    if ((count($result) > 0) AND ($_SESSION["isAdmin"]==true)) {
                        echo"<label>".$htmlUtilisateurs."</label><br>";

                        foreach ($result as $row) {
            
                            echo '<form method="post" action="traitements/del_acc.php" class="squarePanelAdmin">
                                <input type="submit" name="submit" id="submit" value="Supprimer le compte"><br>
                                <input type="hidden" name="Id_Uti" value="'.$row["Id_Uti"].'">';

                            echo $htmlNomDeuxPoints, $row["Nom_Uti"] . "<br>";
                            echo $htmlPrénomDeuxPoints, $row["Prenom_Uti"] . "<br>";
                            echo $htmlMailDeuxPoints, $row["Mail_Uti"] . "<br>";
                            echo $htmlAdresseDeuxPoints, $row["Adr_Uti"] . "<br></form>";
                        }
                        echo '</div>'; 
                    } else {
                        echo $htmlErrorDevTeam;
                    }
               ?>
            <br>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

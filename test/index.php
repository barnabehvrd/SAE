<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'étal en ligne</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
</head>
<body>
    <div class="container">
        <div class="leftColumn">
			<img class="logo" href="index.php" src="img/logo.png">
            <div class="contenuBarre">
                <!-- some code -->
            </div>
        </div>
        <div class="rightColumn">
            <div class="topBanner">
                <div class="divNavigation">
                    <a class="bontonDeNavigation" href="index.php">Accueil</a>
                    <a class="bontonDeNavigation" href="messagerie.php">Messagerie</a>
                    <a class="bontonDeNavigation" href="commandes.php">Commandes</a>
                </div>
                <form method="post">
                    <?php
                    if(!isset($_SESSION)){
                    session_start();
                    }
                    if(isset($_SESSION, $_SESSION["tempPost"])){
                        $_POST = $_SESSION["tempPost"];
                        unset($_SESSION["tempPost"]);
                    }
                    ?>
					<input type="submit" value=<?php if (!isset($_SESSION['Mail_Uti'])){/*$_SESSION = array()*/; echo '"Se Connecter"';}else {echo '"'.$_SESSION['Mail_Uti'].'"';}?> class="boutonDeConnection">
                    <input type="hidden" name="popup" value=<?php if(isset($_SESSION['Mail_Uti'])){echo '"info_perso"';}else{echo '"sign_in"';}?>>
				</form>
            </div>
            <div class="contenuPage">

               <?php var_dump($_SESSION);
               var_dump($_POST); ?>

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
    <?php require "popups/gestion_popups.php";
    if (isset($_POST['formClicked'])){
        $_SESSION['tempPopup'] = $_POST['popup'];
        header('refresh:0');
    }?>
</body>
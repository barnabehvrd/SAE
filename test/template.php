<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'étal en ligne</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/styleGeneral.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <link rel="stylesheet" type="text/css" href="css/#################.css"> <!-- name of the page -->
</head>
<body>
    <div class="container">
        <div class="leftColumn">
			<img class="logo" src="img/logo.png">
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
					<input type="submit" value=<?php if (!isset($_SESSION)){session_start(); echo '"Se Connecter"';}else {echo $_SESSION['Mail_Uti'];}?> class="boutonDeConnection">
                    <input type="hidden" name="popup" value="sign_in">
				</form>
            </div>
            <div class="contenuPage">

                <!-- some code -->

            </div>
            <div class="basDePage">
                <form method="post">
						<input type="submit" value="Signaler un dysfonctionnement" class="boutonBasDePage">
                        <input type="hidden" name="popup" value="contact_admin">
				</form>
                <form method="post">
						<input type="submit" value="CGU" class="boutonBasDePage">
                        <input type="hidden" name="popup" value="cgu">
				</form>
            </div>
        </div>
    </div>
    <?php require "popups/gestionPopups.php" ?>
</body>

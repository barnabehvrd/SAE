<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'étal en ligne</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <link rel="stylesheet" type="text/css" href="css/messagerie.css"> 
    <!-- name of the page -->
</head>
<body>
    <?php
    if(!isset($_SESSION)){
        session_start();
    }
    ?>
    <div class="container">
    <div class="LeftColumn">
			<img class="logo" src="img/logo.png">
            <p>Contacts récents :</p>
			<?php
			require 'traitements/afficheContacts.php';
			?>
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
                        if (isset($_SESSION["isAdmin"]) and ($_SESSION["isAdmin"]==true)){
                            echo'<a class="bontonDeNavigation" href="panel_admin.php">Panel Admin</a>';
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
					<input type="submit" value=<?php if (!isset($_SESSION)){session_start(); echo '"Se Connecter"';}else {echo $_SESSION['Mail_Uti'];}?> class="boutonDeConnection">
                    <input type="hidden" name="popup" value="sign_in">
				</form>
            </div>
            <div class="contenuPage">
				<div class="interlocuteur" 
				<?php if (!isset($_GET['Id_Interlocuteur'])) { echo 'disabled';} ?>
				>
				<?php 
				require "traitements/afficherInterlocuteur.php";
				?>
				</div>
				<div class="contenuMessagerie">
            	
            		<?php
					require 'traitements/afficheMessages.php';
					?>
					<form method="post" id="zoneDEnvoi">
						<input type="text" name="content" id="zoneDeTexte" <?php if ($formDisabled) { echo 'disabled';} ?>>
						<input type="submit" value="" id="boutonEnvoyerMessage" <?php if ($formDisabled) { echo 'disabled';} ?>>
					</form>
					<?php
					require 'traitements/envoyerMessage.php';
					?>
				</div>
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
    <?php require "popups/gestion_popups.php" ?>
</body>

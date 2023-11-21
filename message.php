<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/messagerie.css">

</head>
<body>
    <div class="container">
        <div class="left-column">
            <!-- Contenu de la partie gauche -->
            
            <p>Contacts récents :</p>
			<?php
			require 'fonction thomas/Messagerie/afficheContacts.php';
			?>
        </div>
        <div class="right-column">
            <div class="fixed-banner">
                <!-- Partie gauche du bandeau -->
                <div class="banner-left">
                    <div class="button-container">
                        <button class="button"><a href="index.php">accueil</a></button>
                        <button class="button"><a href="message.php">messagerie</a></button>
                        <button class="button"><a href="commandes.php">commandes</a></button>
                    </div>
                </div>
                <!-- Partie droite du bandeau -->
                <div class="banner-right">
					<a class="fixed-size-button" href="form_sign_in.php" >
					<?php if (!isset($_SESSION)) {
						
					session_start();
					echo "connection";
					}
					else {
					echo $_SESSION['Mail_Uti']; 
					}
						
					?>

					
					</a>
                </div>
            </div>
			<div class="contenu">
            <!-- Contenu de la partie droite (sous le bandeau) -->
            <?php
			require 'fonction thomas/Messagerie/afficheMessages.php';
			?>
			<form method="post">
				<input type="text" name="content">
				<input type="submit" img="img/paper plane.svg">
				<?php
				require 'fonction thomas/Messagerie/envoyerMessage.php';
				?>
			</div>
			</form>
			
			</div>
			
			
		</div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<head>
    <title>Fenêtre Pop-up</title>
</head>
<body>
    <div class="container">
        <div class="left-column">
            <!-- Contenu de la partie gauche -->
            <h1>Partie gauche (4/5)</h1>
            <p>Ceci est la partie gauche de la page web.</p>
        </div>
        <div class="right-column">
            <div class="fixed-banner">
            </div>
			<div class="contenu">
            <!-- Contenu de la partie droite (sous le bandeau) -->
			<form class="formulaire" action="traitement_formulaire_sign_up.php" method="post">
					<h1>Formulaire d'Inscription</h1>
					<label for="nom">Nom :</label>
					<input type="text" name="nom" id="nom" required><br><br>
					<label for="prenom">Prénom :</label>
					<input type="text" name="prenom" id="prenom" required><br><br>
					<label for="adresse">Rue:</label>
					<input type="text" name="rue" id="rue" required><br><br>
					<label for="adresse">Code postale:</label>
					<input type="text" name="code" id="code" required><br><br>
					<label for="adresse">Ville:</label>
					<input type="text" name="ville" id="ville" required><br><br>
					<label for="pwd">Mot de passe :</label>
					<input type="text" name="pwd" id="pwd" required><br><br>
					<?php
					if (isset($_GET['mail'])) {
 					  	 $mail = $_GET['mail'];
   						 echo " $mail <br>";
						}
					?>
					<label for="mail">mail :</label>
					<input  type="mail"  name="mail" id="mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" size="30" required /><br><br>
					<label for="profession">profession :</label>
					<input type="profession" id="profession" name="profession"  required><br><br>
					<input type="submit" value="Inscription">
			</form>


				
				
				
				
				<form class="formulaire" action="bug_report.php" method="post">
					<p>report a bug</p>
					<label for="mail">mail :</label>
					<input type="text" name="mail" id="mail" required><br><br>
					<label for="pwd">message : </label>
					<input type="text" name="message" id="message" required><br><br>
					<input type="submit" value="Envoyer">
				</form>
			<a class="fixed-size-button" href="form_sign_in.php" >  vous avez déjà de compte? </a>
		</div>
    </div>
</body>
</html>

</html>
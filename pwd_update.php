<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">

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
                <!-- Partie gauche du bandeau -->
                <div class="banner-left">
                    <div class="button-container">
                        <button class="button">Bouton 1</button>
                        <button class="button">Bouton 2</button>
                        <button class="button">Bouton 3</button>
                    </div>
                </div>
                <!-- Partie droite du bandeau -->
               
            </div>
				<div class="contenu">
						

						  <form class="formulaire" action="reset_pwd.php" method="post">
							<h1>Modifier le mot de passe</h1>
							<p>Veuillez saisir  votre nouveau mot de passe deux fois.</p>
							<input type="password" name="pwd_new" placeholder="Nouveau mot de passe">
							<input type="password" name="pwd_confirm" placeholder="Confirmer le nouveau mot de passe">
							<input type="submit" value="Modifier">
						  </form>

				</div>
				<form class="formulaire" action="bug_report.php" method="post">
						<p>report a bug</p>
						<label for="mail">mail :</label>
						<input type="text" name="mail" id="mail" required><br><br>
						<label for="pwd">message : </label>
						<input type="text" name="message" id="message" required><br><br>
						<input type="submit" value="Envoyer">
				</form>
			</div>
		</div>
    </div>
</body>
</html>

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
			<img class="logo" src="img/logo.png">
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
					<label for="adresse">Adresse postale:</label>
					<input type="text" name="adresse" id="adresse" required><br><br>
					<label for="pwd">password :</label>
					<input type="text" name="pwd" id="pwd" required><br><br>
					<label for="mail">mail :</label>
					<input type="mail" id="mail" name="mail"  required><br><br>
					<label for="producteur_box">Je suis producteur<input type="checkbox" name="producteur_box" id="producteur_box"></label><br><br>
					<div id="professionDiv" style="display:none;">
					<label for="profession">Profession :</label>
					<input type="text" name="profession" id="profession">
					<br><br>
					</div>
				<input type="submit" value="Envoyer">
				</form>
				<script>
				function toggleProfessionField() {
					var professionDiv = document.getElementById("professionDiv");
					var producteurCheckbox = document.getElementById("producteur_box");
					professionDiv.style.display = producteurCheckbox.checked ? "block" : "none";
				}
				var producteurCheckbox = document.getElementById("producteur_box");
				producteurCheckbox.addEventListener("change", toggleProfessionField);
				</script>
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
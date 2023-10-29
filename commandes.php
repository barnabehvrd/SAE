<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    <div class="container">
        <div class="left-column">
            <!-- Contenu de la partie gauche -->
            <h1>Partie gauche (4/5)</h1>
            <p>Ceci est la partie gauche de la page web.</p>
            <p>recherche par catégorie</p>
			<form method="post" action="search_by_categories.php"> <!-- Vous pouvez spécifier le fichier de traitement PHP ici -->

			<label for="categories">Sélectionnez une catégorie :</label>
			<select name="categorie" id="categories">
				<option value="categorie1">Catégorie 1</option>
				<option value="categorie2">Catégorie 2</option>
				<option value="categorie3">Catégorie 3</option>
				<option value="categorie4">Catégorie 4</option>
				<option value="categorie5">Catégorie 5</option>
				<option value="categorie6">Catégorie 6</option>
			</select>

    <input type="submit" value="Aller à la catégorie">
</form>
        </div>
        <div class="right-column">
            <div class="fixed-banner">
                <!-- Partie gauche du bandeau -->
                <div class="banner-left">
                    <div class="button-container">
                        <button class="button"><a href="index.php">acceuil</a></button>
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
            <h1>Partie droite (1/5)</h1>
				<div class="gallery-container">
					<div class="square"></div>
					<div class="square"></div>
					<div class="square"></div>
					<div class="square"></div>
					<div class="square"></div>
					<div class="square"></div>
					<div class="square"></div>
					<div class="square"></div>
				</div>
			</div>
			<form class="formulaire" action="bug_report.php" method="post">
					<p class= "centered">report a bug</p>
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

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    <div class="container">
        <div class="left-column">
            <!-- Contenu de la partie gauche --> 
			 <p>recherche par catégorie</p>
			<form method="post" action="index.php"> 

			<label for="categories">Sélectionnez une catégorie :</label>
			<select name="categorie" id="categories">
				<option value="Agriculteur">Agriculteur</option>
				<option value="Vigneron">Vigneron</option>
				<option value="Maraîcher">Maraîcher</option>
				<option value="Apiculteur">Apiculteur</option>
				<option value="Éleveur de volaille">Éleveur de volaille</option>
				<option value="Viticulteur">Viticulteur</option>
				<option value="Pépiniériste">Pépiniériste</option>
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
            <h1> PRODUCTEURS : </h1>
				<div class="gallery-container">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST["categorie"])) {
                                $categorie = $_POST["categorie"];

                                // Connexion à la base de données
                                $utilisateur = "root";
                                $serveur = "localhost";
                                $basededonnees = "sae3";
                                $connexion = new mysqli($serveur, $utilisateur, "", $basededonnees);

                                // Vérifiez la connexion
                                if ($connexion->connect_error) {
                                    die("Erreur de connexion : " . $connexion->connect_error);
                                }

                                // Préparez la requête SQL en utilisant des requêtes préparées pour des raisons de sécurité
                                $requete = 'SELECT producteur.Prof_Prod, utilisateur.Prenom_Uti, utilisateur.Nom_Uti, utilisateur.Adr_Uti FROM producteur JOIN utilisateur ON producteur.Id_Uti = utilisateur.Id_Uti WHERE producteur.Prof_Prod = ?';
                                $stmt = $connexion->prepare($requete);
                                $stmt->bind_param("s", $categorie); // "s" indique que la valeur est une chaîne de caractères

                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="square"> ';
                                        echo "Nom : " . $row["Nom_Uti"] . "<br>";
                                        echo "Prénom : " . $row["Prenom_Uti"] . "<br>";
                                        echo "Adresse : " . $row["Adr_Uti"] . "<br>";
                                        echo '</div> ';
                                    }
                                } else {
                                    echo "Aucun résultat trouvé pour la catégorie : $categorie";
                                }

                                $stmt->close();
                                $connexion->close();
                            }
                        }
                        ?>
                    
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

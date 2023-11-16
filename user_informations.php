<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    <div class="container">
        <div class="left-column">
            <!-- Contenu de la partie gauche --> 
             
			
			
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
					
					<?php 
                    
                    session_start();
                    if (isset($_SESSION['Mail_Uti'])) {  
                    echo '<a class="fixed-size-button" href="user_informations.php" >';
					echo $_SESSION['Mail_Uti']; 
					}
					else {
                    echo '<a class="fixed-size-button" href="form_sign_in.php" >';
					echo "connection";
					}
					
					?>
					
					
					</a>
                </div>
            </div>
			<div class="contenu">
            <!-- Contenu de la partie droite (sous le bandeau) -->
				<div class="gallery-container">
                        <?php
                                // Connexion à la base de données
                                //attention a utiliser la vu approprié
                                $utilisateur = "root";
                                $serveur = "localhost";
                                $basededonnees = "sae3";
                                $connexion = new mysqli($serveur, $utilisateur, "", $basededonnees);

                                // Vérifiez la connexion
                                if ($connexion->connect_error) {
                                    die("Erreur de connexion : " . $connexion->connect_error);  
                                }

                                // Préparez la requête SQL en utilisant des requêtes préparées pour des raisons de sécurité
                                $requete = 'SELECT * FROM utilisateur WHERE utilisateur.Mail_Uti=?';
                                echo ($requete);
                                $stmt = $connexion->prepare($requete);
                                
                                $_SESSION['Mail_Uti'] = 'johndoe1@gmail.com';
                                
                                $stmt->bind_param("s", $_SESSION['Mail_Uti']); // "s" indique que la valeur est une chaîne de caractères
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="square"> ';
                                        echo "Nom : " . $row["Nom_Uti"] . "<br>";
                                        echo "Prénom : " . $row["Prenom_Uti"] . "<br>";
                                        echo '</div> ';
                                    }
                                } else {
                                    echo "Aucun résultat trouvé pour votre compte contacter le support ";
                                }

                                $stmt->close();
                                $connexion->close();
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

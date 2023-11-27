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
            <img class="logo" src="img/logo.png">
             
			
			
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
                <button class="button"><a href="log_out.php">déconexion</a></button>
                </div>
            </div>
			<div class="contenu">
            <!-- Contenu de la partie droite (sous le bandeau) -->
				<div class="gallery-container">
                    <div class="square">
                        <?php
                                // Connexion à la base de données
                                //attention a utiliser la vu approprié
                                session_start();
                                $utilisateur = "inf2pj02";
                                $serveur = "localhost";
                                $motdepasse = "ahV4saerae";
                                $basededonnees = "inf2pj_02";
                                $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

                                // Vérifiez la connexion
                                if ($connexion->connect_error) {
                                    die("Erreur de connexion : " . $connexion->connect_error);  
                                }
                                // Préparez la requête SQL en utilisant des requêtes préparées pour des raisons de sécurité
                                $requete = 'SELECT * FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=?';
                                $stmt = $connexion->prepare($requete);
                                $stmt->bind_param("s", $_SESSION['Mail_Uti']); // "s" indique que la valeur est une chaîne de caractères
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <form action="update_user_info.php" method="post">
                                         
                                        <!--  Set default values to current user information -->
                                        <label for="new_nom">Nom :</label><br>
                                         <input type="text" name="new_nom" value=<?php echo ($row["Nom_Uti"]) ?>><br>

                                         <label for="new_prenom">Prénom :</label><br>
                                         <input type="text" name="new_prenom" value=<?php echo ($row["Prenom_Uti"]) ?>><br>
                                        
                                        <label for="new_adr">Adresse postale :</label><br>
                                         <input type="text" name="new_adr" value="<?php echo ($row["Adr_Uti"])?>"><br>
                                        
                                        <!-- Add the submit button -->
                                          <input type="submit" value="Modifier">
                                        </form>
                                        <?php
                                        //var_dump($row["Adr_Uti"]);
                                    }
                                } else {
                                    ?>
                                        <p>Aucun résultat trouvé pour votre compte, veuillez contacter le support.</p>
                                    <?php
                                }
                                $stmt->close();
                                $connexion->close();
                        ?>
                        </div>
                </div>
                <div class="square">
                                   <form action="update_pwd_info.php" method="post">
                                        <label for="new_mdp1">nouveau mot de passe :</label><br>
                                        <input type="text" name="pwd1"> <br>
                                        <label for="new_mdp2">ressaisissez le nouveau mot de passe :</label><br>
                                        <input type="text" name="pwd2"> <br>
                                        <input type="submit" value="Modifier">
                                   </form>
                                        
                </div>
                <div class="square">
                                     <label for="btn-producteur">Je souhaite supprimer mon compte</label>
				                        <input type="button" onclick="window.location.href='del_acc.php'" id="del_acc_button" value="supprimer">
				
                </div>
                <div class="square">
                    <h2>modifier votre photo de profil</h2>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="image" accept=".png" required>
                    <button type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
                <form class="formulaire" action="bug_report.php" method="post">
					<p class= "centered">report a bug</p>
					<label for="pwd">message : </label>
					<input type="text" name="message" id="message" required><br><br>
					<input type="submit" value="Envoyer">
			    </form>
			</div>

			
		</div>
    </div>
</body>
</html>

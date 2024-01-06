<!DOCTYPE html>
<html lang="fr">
<head>
    <title>pnael_admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
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
                    <a class="bontonDeNavigation" href="index.php">Utilisateurs</a>
                    <a class="bontonDeNavigation" href="messagerie.php">Messagerie</a>
                </div>
            </div>
            <div class="gallery-container">
                        <?php
                                // Connexion à la base de données 
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
                                $requete = 'SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti';
                                $stmt = $connexion->prepare($requete);
                                 // "s" indique que la valeur est une chaîne de caractères
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    echo '<div>'; 
                                    while ($row = $result->fetch_assoc()) {
                                        
                                        echo '<form method="post" action="del_acc.php" class="squarePanelAdmin">
                                            <input type="submit" name="submit" id="submit"><br><br>
                                            <input type="hidden" name="Id_Uti" value="'.$row["Id_Uti"].'">';
                                        echo "Nom : " . $row["Nom_Uti"] . "<br>";
                                        echo "Prénom : " . $row["Prenom_Uti"] . "<br>";
                                        echo "Mail : " . $row["Mail_Uti"] . "<br>";
                                        echo "Adresse : " . $row["Adr_Uti"] . "<br>";
                                        echo "Profession : " . $row["Prof_Prod"] . "<br></form>";
                                                                              
                                    }
                                    echo '</div>'; 
                                } else {
                                    echo "erreur contacté l'équipe de déveloper ";
                                }
                                $stmt->close();
                                $connexion->close();
                        ?>
                    
                </div>
                <!-- some code -->

            </div>
            <div class="basDePage">
                <form method="post">
						<input type="submit" value="Contactez nous !" class="boutonBasDePage">
                        <input type="hidden" name="popup" value="contact">
				</form>
                <form method="post">
						<input type="submit" value="CGU" class="boutonBasDePage">
                        <input type="hidden" name="popup" value="CGU">
				</form>
            </div>
        </div>
    </div>
    <?php require "popups/gestion_popups.php" ?>
</body>

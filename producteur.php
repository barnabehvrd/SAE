<!DOCTYPE html>
<html lang="fr">
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
                        <button class="button"><a href="index.php">accueil</a></button>
                        <button class="button"><a href="message.php">messagerie</a></button>                 
                        <button class="button"><a href="commandes.php">commandes</a></button>
                    </div>
                </div>
                <!-- Partie droite du bandeau -->
                <div class="banner-right">
                    <a class="fixed-size-button" href="form_sign_in.php" >
                    <?php 
                    if (!isset($_SESSION)) {
                        session_start();
                        echo "connection";
                    } else {
                        echo $_SESSION['Mail_Uti']; 
                    }
                    ?>
                    </a>
                </div>
            </div>
            <div class="content-container">
                <div class="product">
                    <!-- partie de gauche avec les produits -->
                    <p><center>Produits proposés</center></p>
                    <div class="gallery-container">
                        <div class="squareProduct"></div>
					    <div class="squareProduct"></div>
					    <div class="squareProduct"></div>
                        <div class="squareProduct"></div>
                    </div>
                </div>
                <div class="producteur">
                    <!-- partie de droite avec les infos producteur -->
                    <?php
                        $host = 'localhost';
                        $dbname = 'sae3';
                        $user = 'root';
                        $password = '';
                        $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
                        $Id_Prod = $_GET["Id_Prod"];
                        $query = $bdd->query(('SELECT utilisateur.Adr_Uti, Prenom_Uti, Nom_Uti, Prof_Prod FROM utilisateur INNER JOIN producteur ON utilisateur.Id_Uti = producteur.Id_Uti WHERE producteur.Id_Prod=\''.$Id_Prod.'\';'));
                        $returnQuery = $query->fetchAll(PDO::FETCH_ASSOC);
                        // recupération des paramètres de la requête qui contient 1 élément
                        $address = $returnQuery[0]["Adr_Uti"];
                        $nom = $returnQuery[0]["Nom_Uti"];
                        $prenom = $returnQuery[0]["Prenom_Uti"];
                        $profession = $returnQuery[0]["Prof_Prod"];
                    ?>
                    <div class="info-container">
						<div class="img-prod">
                        	<img class="img-test" src="/img_producteur/<?php echo $Id_Prod; ?>.png" alt="Image utilisateur" style="width: 99%; height: 99%;">
						</div>
						<div class="text-info">
                            <?php
                                echo '</br>'.$prenom . ' ' . strtoupper($nom) . '</br></br><strong>' . $profession.'</strong></br></br>'.$address;
                            ?>
                        </div>
                    </div>
					<button class="button"><a href="message.php?Id_Interlocuteur=<?php echo $Id_Prod; ?>">Envoyer un message</a></button>
                    <?php
                        if (isset($address)) {
                            $address = str_replace(" ", "+", $address);
                    ?>
                    <iframe class="map-frame" src="https://maps.google.com/maps?&q=<?php echo $address; ?>&output=embed " 
                        width="100%" height="100%" 
                    ></iframe>
                    <?php } 
                    ?>
                </div>
            </div>
            <form class="formulaire" action="bug_report.php" method="post">
                <p class="centered">report a bug</p>
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

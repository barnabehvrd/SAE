<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'étal en ligne</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
</head>
<body>
    <div class="container">
        <div class="leftColumn">
			<img class="logo" href="index.php" src="img/logo.png">
            <div class="contenuBarre">
                <!-- some code -->
            </div>
        </div>
        <div class="rightColumn">
            <div class="topBanner">
                <div class="divNavigation">
                    <a class="bontonDeNavigation" href="index.php">Accueil</a>
                    <a class="bontonDeNavigation" href="messagerie.php">Messagerie</a>
                    <a class="bontonDeNavigation" href="commandes.php">Commandes</a>
                </div>
                <form method="post">
                    <?php
                    if(!isset($_SESSION)){
                    session_start();
                    }
                    if(isset($_SESSION, $_SESSION['tempPopup'])){
                        $_POST['popup'] = $_SESSION['tempPopup'];
                        unset($_SESSION['tempPopup']);
                    }
                    ?>
					<input type="submit" value=<?php if (!isset($_SESSION['Mail_Uti'])){/*$_SESSION = array()*/; echo '"Se Connecter"';}else {echo '"'.$_SESSION['Mail_Uti'].'"';}?> class="boutonDeConnection">
                    <input type="hidden" name="popup" value=<?php if(isset($_SESSION['Mail_Uti'])){echo '"info_perso"';}else{echo '"sign_in"';}?>>
				</form>
            </div>
            <div class="contenuPage">

               <?php 
               
               
               
               
               
               if (isset($_GET["rechercheVille"])==true){
                $rechercheVille=htmlspecialchars($_GET["rechercheVille"]);
              }
              else{
                $rechercheVille="";
            }
            if (isset($_GET["categorie"])==false){
                $_GET["categorie"]="Tout";
            }
            if (isset($_SESSION["Id_Uti"])==false){
                $utilisateur=-1;
            }
            else{
                $utilisateur=htmlspecialchars($_SESSION["Id_Uti"]);
            }
            if (isset($_GET["rayon"])==false){
                $rayon=100;
            }
            else{
                $rayon=htmlspecialchars($_GET["rayon"]);
            }
    
            // récupération adresse du client
            function dbConnect(){
                $utilisateur = "inf2pj02";
                $serveur = "localhost";
                $motdepasse = "ahV4saerae";
                $basededonnees = "inf2pj_02";
                // Connect to database
                return new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
              }
    
              function latLongGps($url){
                // Configuration de la requête cURL
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Permet de suivre les redirections
                // Ajout du User Agent
                $customUserAgent = "LEtalEnLigne/1.0"; // Remplacez par le nom et la version de votre application
                curl_setopt($ch, CURLOPT_USERAGENT, $customUserAgent);
                // Ajout du Referrer
                $customReferrer = "https://la-projets.univ-lemans.fr/~inf2pj02/index.php"; // Remplacez par l'URL de votre application
                curl_setopt($ch, CURLOPT_REFERER, $customReferrer);
                // Exécution de la requête
                $response = curl_exec($ch);
                // Vérifier s'il y a eu une erreur cURL
                if (curl_errno($ch)) {
                    echo 'Erreur cURL : ' . curl_error($ch);
                } else {
                    // Analyser la réponse JSON
                    $data = json_decode($response);
                
                    // Vérifier si la réponse a été correctement analysée
                    if (!empty($data) && is_array($data) && isset($data[0])) {
                        // Récupérer la latitude et la longitude
                        $latitude = $data[0]->lat;
                        $longitude = $data[0]->lon;
                        return [$latitude, $longitude];
                    }
                    return [0,0];
                }
                // Fermeture de la session cURL
                curl_close($ch);
              }
    
    
            /*---------------------------------------------------------------*/
            /*
                Titre : Calcul la distance entre 2 points en km                                                                       
                                                                                                                                    
                URL   : https://phpsources.net/code_s.php?id=1091
                Auteur           : sheppy1                                                                                            
                Website auteur   : https://lejournalabrasif.fr/qwanturank-concours-seo-qwant/                                         
                Date édition     : 05 Aout 2019                                                                                       
                Date mise à jour : 16 Aout 2019                                                                                      
                Rapport de la maj:                                                                                                    
                - fonctionnement du code vérifié                                                                                    
            */
            /*---------------------------------------------------------------*/
            
                function distance($lat1, $lng1, $lat2, $lng2, $miles = false)
                {
                    $pi80 = M_PI / 180;
                    $lat1 *= $pi80;
                    $lng1 *= $pi80;
                    $lat2 *= $pi80;
                    $lng2 *= $pi80;
            
                    $r = 6372.797; // rayon moyen de la Terre en km
                    $dlat = $lat2 - $lat1;
                    $dlng = $lng2 - $lng1;
                    $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin(
            $dlng / 2) * sin($dlng / 2);
                    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                    $km = $r * $c;
                
                    return ($miles ? ($km * 0.621371192) : $km);
            }
               
               
               
               
               
               
               
               
               ?>

            </div>
            <div class="basDePage">
                <form method="post">
						<input type="submit" value="Signaler un dysfonctionnement" class="lienPopup">
                        <input type="hidden" name="popup" value="contact_admin">
				</form>
                <form method="post">
						<input type="submit" value="CGU" class="lienPopup">
                        <input type="hidden" name="popup" value="cgu">
				</form>
            </div>
        </div>
    </div>
    <?php require "popups/gestion_popups.php";
    var_dump($_SESSION);
    var_dump($_POST);?>
</body>
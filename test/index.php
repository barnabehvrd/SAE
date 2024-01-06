<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'étal en ligne</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
</head>
<body>
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
    <div class="container">
        <div class="leftColumn">
			<img class="logo" href="index.php" src="img/logo.png">
            <div class="contenuBarre">
                
            <center><strong><p>Rechercher par</p></strong></center>
			<form method="get" action="index.php"> 
			<label>- Profession :</label>
            <br>
			<select name="categorie" id="categories">
                <option value="Tout" <?php if($_GET["categorie"]=="Tout") echo 'selected="selected"';?>>Tout</option>
				<option value="Agriculteur" <?php if($_GET["categorie"]=="Agriculteur") echo 'selected="selected"';?>>Agriculteur</option>
				<option value="Vigneron" <?php if($_GET["categorie"]=="Vigneron") echo 'selected="selected"';?>>Vigneron</option>
				<option value="Maraîcher" <?php if($_GET["categorie"]=="Maraîcher") echo 'selected="selected"';?>>Maraîcher</option>
				<option value="Apiculteur" <?php if($_GET["categorie"]=="Apiculteur") echo 'selected="selected"';?>>Apiculteur</option>
				<option value="Éleveur de volaille" <?php if($_GET["categorie"]=="Éleveur de volaille") echo 'selected="selected"';?>>Éleveur de volaille</option>
				<option value="Viticulteur" <?php if($_GET["categorie"]=="Viticulteur") echo 'selected="selected"';?>>Viticulteur</option>
				<option value="Pépiniériste" <?php if($_GET["categorie"]=="Pépiniériste") echo 'selected="selected"';?>>Pépiniériste</option>
			</select>
            <br>
            <br>- Par ville :
            <br>
            <input type="text" name="rechercheVille" pattern="[A-Za-z0-9 ]{0,100}"  value="<?php echo $rechercheVille?>" placeholder="Ville">
            <br>
            <?php
                $mabdd=dbConnect();           
                $queryAdrUti = $mabdd->prepare(('SELECT Adr_Uti FROM UTILISATEUR WHERE Id_Uti= :utilisateur;'));
                $queryAdrUti->bindParam(":utilisateur", $utilisateur, PDO::PARAM_STR);
                $queryAdrUti->execute();
                $returnQueryAdrUti = $queryAdrUti->fetchAll(PDO::FETCH_ASSOC);
                var_dump($utilisateur);
                var_dump($queryAdrUti);

                if (count($returnQueryAdrUti)>0){
                    $Adr_Uti_En_Cours=$returnQueryAdrUti[0]["Adr_Uti"];
            ?>
                <br>
                <br>- Autour de chez moi : <?php echo '('.$Adr_Uti_En_Cours.')';?>
                <br>
                <br>
                <input name="rayon" type="range" value="<?php echo $rayon;?>" min="1" max="100" step="1" onchange="AfficheRange2(this.value)" onkeyup="AfficheRange2(this.value)">
                <span id="monCurseurKm">Rayon de <?php echo $rayon; if($rayon>=100) echo '+';?></span>
                <script>
                    function AfficheRange2(newVal) {
                        var monCurseurKm = document.getElementById("monCurseurKm");
                        if ((newVal >= 100)) {
                            monCurseurKm.innerHTML = "Rayon de " + newVal + "+ ";
                        } else {
                            monCurseurKm.innerHTML = "Rayon de " + newVal + " ";
                        }
                    }
                </script>
                Km
                <br>
                <br>
            <?php
                }
                else{
                    $Adr_Uti_En_Cours='France';
                }
            ?>
            <br>
			<center><input type="submit" value="Rechercher"></center>
			</form>


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
    <?php require "popups/gestion_popups.php";?>
</body>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    <?php
        session_start();
        if (isset($_GET["rechercheVille"])==true){
            $rechercheVille=$_GET["rechercheVille"];
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
            $utilisateur=$_SESSION["Id_Uti"];
        }
        if (isset($_GET["rayon"])==false){
            $rayon=10;
        }
        else{
            $rayon=$_GET["rayon"];
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
                } else {
                    // En cas d'erreur ou si aucune correspondance n'est trouvée, afficher un message
                    echo "Erreur lors de l'extraction des données de géocodage.";
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
        


        
        $mabdd=dbConnect();           
        $queryAdrUti = $mabdd->query(('SELECT Adr_Uti FROM UTILISATEUR WHERE Id_Uti=\''.$utilisateur.'\';'));
        $returnQueryAdrUti = $queryAdrUti->fetchAll(PDO::FETCH_ASSOC);
        if (count($returnQueryAdrUti)>0){
            $Adr_Uti_En_Cours=$returnQueryAdrUti[0]["Adr_Uti"];
        }
        else{
            $Adr_Uti_En_Cours='PARIS';
        }
    ?>
    <div class="container">
        <div class="left-column">
            <img class="logo" src="img/logo.png">
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
            <br>
            <br>- Autour de chez moi :
            <br>
            <input type="text" name="autourDeChezMoi" value="<?php echo $Adr_Uti_En_Cours;?>" placeholder="Adresse physique" size="auto">
            <br>
            <br>
            <input name="rayon" type="range" value="<?php echo $rayon;?>" min="1" max="100" step="1" onchange="AfficheRange2(this.value)" onkeyup="AfficheRange2(this.value)">
            <span id="monCurseurKm">Rayon de <?php echo $rayon;?></span>
            <script>
                function AfficheRange2(newVal) {
                    var monCurseurKm = document.getElementById("monCurseurKm");
                    if (newVal >= 100) {
                        monCurseurKm.innerHTML = "Rayon de " + newVal + "+ ";
                    } else {
                        monCurseurKm.innerHTML = "Rayon de " + newVal + " ";
                    }
                }
            </script>
            Km
            <br>
            <br>
            <br>
			<center><input type="submit" value="Rechercher"></center>
			</form>
        </div>
        <div class="right-column">
            <div class="fixed-banner">
                <!-- Partie gauche du bandeau -->
                <div class="banner-left">
                    <div class="button-container">
                        <button class="button"><a href="index.php">Accueil</a></button>
                        <button class="button"><a href="message.php">Messagerie</a></button>                 
						<button class="button"><a href="commandes.php">Achats</a></button>
                        <?php
                            if (isset($_SESSION["isProd"]) and ($_SESSION["isProd"]==true)){
                                echo '<button class="button"><a href="mes_produits.php">Mes produits</a></button>';
                                echo '<button class="button"><a href="delivery.php">Préparation des commandes</a></button>';
                            }
                        ?>
                    </div>
                </div>
                <!-- Partie droite du bandeau -->
                <div class="banner-right">
					<?php 
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
            <h1> PRODUCTEURS : </h1>
            <?php
             ?> 
				<div class="gallery-container">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            if (isset($_GET["categorie"])) {
                                $categorie = $_GET["categorie"];
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
                                if ($_GET["categorie"]=="Tout"){
                                    $requete = 'SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Adr_Uti FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti WHERE PRODUCTEUR.Prof_Prod LIKE \'%\'';
                                }else{
                                    $requete = 'SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Adr_Uti FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti WHERE PRODUCTEUR.Prof_Prod ="'.$categorie.'"';
                                    //$stmt->bind_param("s", $categorie);
                                }
                                if ($rechercheVille!=""){
                                    $requete=$requete.' AND Adr_Uti LIKE \'%, _____ %'.$rechercheVille.'%\'';
                                }
                                $stmt = $connexion->prepare($requete);
                                 // "s" indique que la valeur est une chaîne de caractères
                                $stmt->execute();
                                $result = $stmt->get_result();

                                
                                
                                
                                // récupère les coordonnées de l'utiliasteur
                                // URL vers l'API Nominatim
                                $urlUti = 'https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($Adr_Uti_En_Cours);
                                $coordonneesUti=latLongGps($urlUti);
                                $latitudeUti=$coordonneesUti[0];
                                $longitudeUti=$coordonneesUti[1];
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $urlProd = 'https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($row["Adr_Uti"]);
                                        $coordonneesProd=latLongGps($urlProd);
                                        $latitudeProd=$coordonneesProd[0];
                                        $longitudeProd=$coordonneesProd[1];
                                        $distance=distance(47.45376854, 0.71693349, 47.44431175, 0.70717026);
                                        echo $distance.'<br>';
                                        /*echo '<a href="producteur.php?Id_Prod='. $row["Id_Uti"] . '" class="square"  >';
                                        echo "Nom : " . $row["Nom_Uti"] . "<br>";
                                        echo "Prénom : " . $row["Prenom_Uti"]. "<br>";
                                        echo "Adresse : " . $row["Adr_Uti"] . "<br>";
                                        echo '<img src="/~inf2pj02/img_producteur/' . $row["Id_Prod"]  . '.png" alt="Image utilisateur" style="width: 100%; height: 85%;" ><br>';
                                        echo '</a> ';         */                               
                                    }
                                } else {
                                    echo "Aucun résultat ne correspond à ces critères";
                                }
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        
                                    }
                                }
                                $stmt->close();
                                $connexion->close();
                            }
                        }
                        ?>
                    
                </div>
					
				
			</div>
			
		</div>
    </div>
</body>
</html>

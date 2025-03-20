<!DOCTYPE html>
<html lang="fr">
<head>
<?php

if(!isset($_SESSION)){
    session_start();
}
    require_once 'database/database.php';
    use database\database;

    $db = new database();

    require "language.php" ;
    $htmlFrançais="Français";
    $htmlAnglais="English";
    $htmlEspagnol="Español";
    $htmlAllemand="Deutch";
    $htmlRusse="русский";
    $htmlChinois="中國人";
?>
    <title> <?php echo $htmlMarque; ?> </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
    //var_dump($_SESSION);
        if(!isset($_SESSION)){
            session_start();
        }

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
        if (isset($_GET["tri"])==true){
            $tri=htmlspecialchars($_GET["tri"]);
        }
        else{
            $tri="nombreDeProduits";
        }
        if (isset($_SESSION["language"])==false){
            $_SESSION["language"]="fr";
        }

        function latLongGps($url){
            // Configuration de la requête cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_PROXY, 'proxy.univ-lemans.fr');
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Permet de suivre les redirections
            // Ajout du User Agent
            $customUserAgent = "LEtalEnLigne/1.0"; // Remplacez par le nom et la version de votre application
            curl_setopt($ch, CURLOPT_USERAGENT, $customUserAgent);
            // Ajout du Referrer
            $customReferrer = "https://proxy.univ-lemans.fr:3128"; // Remplacez par l'URL de votre application
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
    
    <main>
        <div class="row g-0">
        
        <div class="col-12 col-md-3 col-lg-2">
            <nav id="sidebar" class="h-100 flex-column align-items-stretch bg-success">
                <img class="logo d-none d-md-block" href="index.php" src="img/logo.png">
                    <!-- code -->
                    <div class="container-fluid">
                        <div class="d-flex flex-column g-3 py-2">
                            <p class="text-light"><?php echo $htmlRechercherPar?></p>
                            <form method="get" action="index.php" class="d-flex flex-column gap-3">
                                <div class="input-group">
                                    <label class="input-group-text" for="categories"><i class="bi bi-person-fill text-success"></i></label>
                                    <select class="form-select" name="categorie" id="categories">
                                        <option value="Tout" <?php if($_GET["categorie"]=="Tout") echo 'selected="selected"';?>><?php echo $htmlTout?></option>
                                        <option value="Agriculteur" <?php if($_GET["categorie"]=="Agriculteur") echo 'selected="selected"';?>><?php echo $htmlAgriculteur?></option>
                                        <option value="Vigneron" <?php if($_GET["categorie"]=="Vigneron") echo 'selected="selected"';?>><?php echo $htmlVigneron?></option>
                                        <option value="Maraîcher" <?php if($_GET["categorie"]=="Maraîcher") echo 'selected="selected"';?>><?php echo $htmlMaraîcher?></option>
                                        <option value="Apiculteur" <?php if($_GET["categorie"]=="Apiculteur") echo 'selected="selected"';?>><?php echo $htmlApiculteur?></option>
                                        <option value="Éleveur de volaille" <?php if($_GET["categorie"]=="Éleveur de volaille") echo 'selected="selected"';?>><?php echo $htmlÉleveurdevolailles?></option>
                                        <option value="Viticulteur" <?php if($_GET["categorie"]=="Viticulteur") echo 'selected="selected"';?>><?php echo $htmlViticulteur?></option>
                                        <option value="Pépiniériste" <?php if($_GET["categorie"]=="Pépiniériste") echo 'selected="selected"';?>><?php echo $htmlPépiniériste?></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt-fill text-success"></i></span>
                                    <input type="text" class="form-control" name="rechercheVille" pattern="[A-Za-z0-9 ]{0,100}"  value="<?php echo $rechercheVille?>" placeholder="<?php echo $htmlVille; ?>">
                                </div>
                            
                                <?php
                                    $returnQueryAdrUti = $db->select('SELECT Adr_Uti FROM UTILISATEUR WHERE Id_Uti= :utilisateur;', [':utilisateur' => $utilisateur]);

                                    if (count($returnQueryAdrUti)>0){
                                        $Adr_Uti_En_Cours=$returnQueryAdrUti[0]["Adr_Uti"];
                                ?>

                                <?php echo $htmlAutourDeChezMoi.' ('.$Adr_Uti_En_Cours.')';?>

                                <input name="rayon" type="range" value="<?php echo $rayon;?>" min="1" max="100" step="1" onchange="AfficheRange2(this.value)" onkeyup="AfficheRange2(this.value)">
                                <span id="monCurseurKm"><?php echo $htmlRayonDe?> <?php echo $rayon; if($rayon>=100) echo '+';?></span>
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
                                <?php echo $htmlKm?>
                                <?php

                                    }
                                    else{
                                        $Adr_Uti_En_Cours='France';
                                    }
                                ?>                                

                                <div class="input-group">
                                    <label class="input-group-text"><i class="bi bi-funnel-fill text-success"></i></label>
                                    <select name="tri" class="form-select" required>
                                        <option value="nombreDeProduits" <?php if($tri=="nombreDeProduits") echo 'selected="selected"';?>><?php echo $htmlNombreDeProduits?></option>
                                        <option value="ordreNomAlphabétique" <?php if($tri=="ordreNomAlphabétique") echo 'selected="selected"';?>><?php echo $htmlParNomAl?></option>
                                        <option value="ordreNomAntiAlphabétique" <?php if($tri=="ordreNomAntiAlphabétique") echo 'selected="selected"';?>><?php echo $htmlParNomAntiAl?></option>
                                        <option value="ordrePrenomAlphabétique" <?php if($tri=="ordrePrenomAlphabétique") echo 'selected="selected"';?>><?php echo $htmlParPrenomAl?></option>
                                        <option value="ordrePrenomAntiAlphabétique" <?php if($tri=="ordrePrenomAntiAlphabétique") echo 'selected="selected"';?>><?php echo $htmlParPrenomAntiAl?></option>
                                    </select>
                                </div>

                                <input class="btn btn-light" type="submit" value="<?php echo $htmlRechercher?>">
                            </form>
                        </div>
                    </div>
                    

            </nav>
        </div>
        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php";?>
            <div class="container-fluid my-3">

                <?php


               if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET["categorie"])) {
                    $categorie = $_GET["categorie"];


                    $req = "SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Adr_Uti, COUNT(PRODUIT.Id_Produit) 
                        FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti 
                        LEFT JOIN PRODUIT ON PRODUCTEUR.Id_Prod=PRODUIT.Id_Prod
                        GROUP BY UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Adr_Uti
                        HAVING PRODUCTEUR.Prof_Prod LIKE :categorie AND Adr_Uti LIKE :adr ORDER BY ";

                    if ($_GET["categorie"]=="Tout"){
                        $categorie = '%';
                    }else{
                        $categorie = $_GET["categorie"];
                    }

                    if ($rechercheVille!=""){
                        $adr = '%, _____ %'.$rechercheVille.'%';
                    } else {
                        $adr = '%';
                    }

                    if ($tri==="nombreDeProduits"){
                        $req=$req.' COUNT(PRODUIT.Id_Produit) DESC ;';
                    }
                    else if ($tri==="ordreNomAlphabétique"){
                        $req=$req.' Nom_Uti ASC ;';
                    }
                    else if ($tri==="ordreNomAntiAlphabétique"){
                        $req=$req.' Nom_Uti DESC ;';
                    }
                    else if ($tri==="ordrePrenomAlphabétique"){
                        $req=$req.' Prenom_Uti ASC ;';
                    }
                    else if ($tri==="ordrePrenomAntiAlphabétique"){
                        $req=$req.' Prenom_Uti DESC ;';
                    }
                    else{
                        $req=$req.' COUNT(PRODUIT.Id_Produit) ASC ;';
                    }


                    $result = $db->select($req, [':categorie' => $categorie, ':adr' => $adr]);
                        // récupère les coordonnées de l'utiliasteur
                        // URL vers l'API Nominatim
                        if (isset($Adr_Uti_En_Cours)){
                            $urlUti = 'https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($Adr_Uti_En_Cours);
                            $coordonneesUti=latLongGps($urlUti);
                            $latitudeUti=$coordonneesUti[0];
                            $longitudeUti=$coordonneesUti[1];
                        }
                    }
                } 
                ?>

                


                <!-- exemple de page liste producteurs -->
                
                <div class="d-flex flex-column">
                    <h1><?php echo $htmlProducteursEnMaj?></h1>
                    <?php if (isset($result) && count($result) > 0) : ?>
                        <div class="row g-3">
                            <?php foreach ($result as $producteur) : ?>
                                <?php if ($rayon >= 100) {
                                     $distance = 0;
                                    } 
                                    else {
                                        $urlProd = 'https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($row["Adr_Uti"]);
                                        $coordonneesProd = latLongGps($urlProd);
                                        $latitudeProd = $coordonneesProd[0];
                                        $longitudeProd = $coordonneesProd[1];
                                        $distance = distance($latitudeUti, $longitudeUti, $latitudeProd, $longitudeProd);
                                    }
                                    if ($distance <= $rayon) :
                                ?>
                                    <div class="col-12 col-lg-6">
                                        <div class="card">
                                            <div class="row g-0">
                                                <div class="col-5">
                                                    <img src="/img_producteur/<?php echo $producteur["Id_Prod"] ?>.png" class="w-100 h-100 object-fit-cover rounded-start" alt="<?php echo $htmlImageUtilisateur ?>">
                                                </div>
                                                <div class="col-7">
                                                    <div class="card-body">
                                                        <h2 class="card-title"><?php echo $producteur["Prenom_Uti"] ." ".mb_strtoupper($producteur["Nom_Uti"]) ?></h2>
                                                        <span class="badge rounded-pill text-bg-success mb-3"><?php echo $producteur["Prof_Prod"] ?></span>
                                                        <p class="card-text"><i class="bi bi-geo-alt-fill text-success me-2"></i><?php echo $producteur["Adr_Uti"] ?></p>
                                                        <a <?php echo 'href="producteur.php?Id_Prod='. $producteur["Id_Prod"] . '"' ?> class="btn btn-success"><?php echo $htmlConsulter ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p><?php echo $htmlAucunResultat?></p>
                    <?php endif; ?>
                </div>

                
            </div>
        </div>
        
    </div>
    </main>
    <footer class="bg-light d-flex justify-content-center align-items-center">
        <form method="post">
            <input type="submit" value="Signaler un dysfonctionnement" class="lienPopup">
            <input type="hidden" name="popup" value="contact_admin">
        </form>
        <form method="post">
            <input type="submit" value="CGU" class="lienPopup">
            <input type="hidden" name="popup" value="cgu">
        </form>
    </footer>
    
    <?php require "popups/gestion_popups.php";?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
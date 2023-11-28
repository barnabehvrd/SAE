<?php
// Récupération des données du formulaire



var_dump($_POST);
$_SESSION['test_pwd'] = 5;
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['rue'] .", ". $_POST['code']. mb_strtoupper($_POST['ville']);
$pwd = $_POST['pwd'];
$Mail_Uti = $_POST['mail'];

$_SESSION['Mail_Temp']=$Mail_Uti;

// Connexion à la base de données 
$utilisateur = "inf2pj02";
$serveur = "localhost";
$motdepasse = "ahV4saerae";
$basededonnees = "inf2pj_02";
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Récupération de la valeur maximum de Id_Uti
$requete = "SELECT MAX(Id_Uti) AS id_max FROM UTILISATEUR";
$resultat = $connexion->query($requete);
$id_max = $resultat->fetch_assoc()['id_max'];

// Incrémentation de la valeur de $iduti
$iduti = $id_max + 1;

// Vérification de l'existence de l'adresse mail
$requete2 = "SELECT COUNT(*) AS nb FROM UTILISATEUR WHERE Mail_Uti = '$Mail_Uti'";
$resultat2 = $connexion->query($requete2);
$nb = $resultat2->fetch_assoc()['nb'];

// Exécution de la requête d'insertion si l'adresse mail n'est pas déjà utilisée
if ($nb == 0) {
    $insertion = "INSERT INTO UTILISATEUR (Id_Uti, Prenom_Uti, Nom_Uti, Adr_Uti, Pwd_Uti, Mail_Uti) VALUES ('$iduti', '$prenom', '$nom', '$adresse', '$pwd', '$Mail_Uti');";

    $connexion1 = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

    // Exécution de la requête
    if ($connexion1->query($insertion) === TRUE) {
        echo "Enregistrement réussi.";
    } else {
        echo "Erreur : " . $insertion . "<br>" . $connexion1->error;
    }

    // création producteur
    if (isset($_POST['profession'])){
        $profession = isset($_POST['profession']) ? $_POST['profession'] : '';
        $requete1 = "SELECT MAX(Id_Prod) AS id_max1 FROM PRODUCTEUR";
        $resultat1 = $connexion1->query($requete1);
        $id_max_prod = $resultat1->fetch_assoc()['id_max1'];
        $id_max_prod++;
        $insertion1 = "INSERT INTO PRODUCTEUR (Id_Uti, Id_Prod, Prof_Prod) VALUES ('$iduti', '$id_max_prod', '$profession');";
        if ($connexion1->query($insertion1) === TRUE) {
            echo "Enregistrement réussi.";
        } else {
            echo "Erreur : " . $insertion1 . "<br>" . $connexion1->error;
        }
    }
    $connexion1->close();
    $bdd2 = new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
            $isProducteur = $bdd2->query('CALL isProducteur('.$iduti.');');
            echo '<br>';
            var_dump($isProducteur);
            $returnIsProducteur = $isProducteur->fetchAll(PDO::FETCH_ASSOC);
            echo '<br>';
            var_dump($returnIsProducteur);
            $reponse=$returnIsProducteur[0]["result"];
            if ($reponse!=NULL){
                echo 'producteur';
                $_SESSION["isProd"]=true;
                //var_dump($_SESSION);
            }else {
                $_SESSION["isProd"]=false;
            }
    
            if($_SESSION["isProd"]==true){
                //$_POST['popup'] = 'addProfilPicture';
            }else {
                $_SESSION['Mail_Uti'] = $Mail_Uti;
                $_SESSION['Id_Uti'] = $iduti;
                //$_POST['popup'] = '';
            }    
} else {            
    //$_GET['erreur'] = 'adresse mail déjà utilisé';    
}
// Fermeture de la connexion
sleep(10);
$connexion->close();
?>
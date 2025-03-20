<?php require "language.php" ; ?>
<?php
require_once 'database/database.php';
use database\database;

$db = new database();

// Récupération des données du formulaire
$_SESSION['test_pwd'] = 5;
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['rue'] .", ". $_POST['code']. " ".mb_strtoupper($_POST['ville']);
$pwd = $_POST['pwd'];
$Mail_Uti = $_POST['mail'];
$_SESSION['Mail_Temp'] = $Mail_Uti;

// Hachage du mot de passe avec password_hash
$hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

// Récupération de l'ID maximum
$id_max = $db->select('SELECT MAX(Id_Uti) AS id_max FROM UTILISATEUR')[0]['id_max'];

// Incrémentation de la valeur de $iduti
$iduti = $id_max + 1;

// Vérification si l'email existe déjà
$nb = $db->select('SELECT COUNT(*) AS nb FROM UTILISATEUR WHERE Mail_Uti = :mail',
    array('mail' => $Mail_Uti))[0]['nb'];

// Exécution de la requête d'insertion si l'adresse mail n'est pas déjà utilisée
echo($nb);
if ($nb == 0) {
    // Insertion avec le mot de passe hashé et les nouvelles colonnes initialisées
    $db->query('INSERT INTO UTILISATEUR (
                  Id_Uti, 
                  Prenom_Uti, 
                  Nom_Uti, 
                  Adr_Uti, 
                  Pwd_Uti, 
                  Mail_Uti,
                  nb_tentatives_echec,
                  date_derniere_tentative
                ) VALUES (
                  :iduti, 
                  :prenom, 
                  :nom, 
                  :adresse, 
                  :pwd, 
                  :Mail_Uti,
                  0,
                  NULL
                )',[
        'iduti' => $iduti,
        'prenom' => $prenom,
        'nom' => $nom,
        'adresse' => $adresse,
        'pwd' => $hashed_password, // Utilisation du mot de passe hashé
        'Mail_Uti' => $Mail_Uti
    ]);

    echo $htmlEnregistrementUtilisateurReussi;

    // Création du producteur si la profession est définie
    if (isset($_POST['profession'])) {
        $profession = $_POST['profession'];
        $id_max_prod = $db->select('SELECT MAX(Id_Prod) AS id_max1 FROM PRODUCTEUR')[0]['id_max1'];
        $id_max_prod++;
        $insertionProducteur = $db->query('INSERT INTO PRODUCTEUR (Id_Uti, Id_Prod, Prof_Prod) VALUES (:iduti, :id_max_prod, :profession)',[
            'iduti' => $iduti,
            'id_max_prod' => $id_max_prod,
            'profession' => $profession
        ]);
        echo $htmlEnregistrementProducteurReussi;
    }

    $reponse = $db->select('CALL isProducteur(:iduti)', array('iduti' => $iduti));
    if ($reponse!=NULL){
        $_SESSION["isProd"]=true;
        //var_dump($_SESSION);
    }else {
        $_SESSION["isProd"]=false;
    }

    $_SESSION['Mail_Uti'] = $Mail_Uti;
    $_SESSION['Id_Uti'] = $iduti;
    $_SESSION['erreur'] = '';

    if($_SESSION["isProd"]==true){
        // on renvoi vers la page d'acceuil
        header('Location: /');
    }else {
        echo ("Erreur lors de l'enregistrement du producteur");
    }
} else {
    $_SESSION['erreur'] = $htmlAdrMailDejaUtilisee;
}
?>
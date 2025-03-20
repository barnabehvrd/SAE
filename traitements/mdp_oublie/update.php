<?php
    require "language.php" ;

require_once 'database/database.php';
use database\database;


$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];

if ($pwd1 == $pwd2 && $pwd1 !== null) {

    $db = new database();

    if(!isset($_SESSION)){
        session_start();
        }


    $emailCount = $db->select('SELECT COUNT(*) AS count FROM UTILISATEUR WHERE Mail_Uti=:mail', array('mail' => $_SESSION["mailTemp"]));

    if ($emailCount > 0) {

        $db->select('UPDATE UTILISATEUR SET Pwd_Uti = :pwd WHERE Mail_Uti = :mail', array('pwd' => $pwd1, 'mail' => $_SESSION["mailTemp"]));

        header('Location: pwd.php?message==$'.$htmlMessageUrlMdpMajOk);

    } else {
        header('Location: pwd.php?message='.$htmlMessageUrlAdrInvalide);
    }
}
?>
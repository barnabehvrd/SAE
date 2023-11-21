<?php
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
if ($pwd1==$pwd2 && $pwd1!==null){
    session_start();
    $host = 'localhost';
    $dbname = 'sae3';
    $user = 'root';
    $password = '';
    $bdd=new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$user,$password);
    $update="UPDATE UTILISATEUR SET Pwd_Uti = '".$pwd1."' WHERE Mail_Uti = '".$_SESSION["Mail_Uti"] ."';";
    $bdd->exec($update);
header('Location: user_informations.php');
}
?>
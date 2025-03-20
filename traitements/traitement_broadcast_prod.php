<?php
require_once __DIR__ . '/../database/database.php';
use database\database;

$db = new database();

if(!isset($_SESSION)){
        session_start();
        }

$message = $_POST['message'];
if (isset($_SESSION["Id_Uti"]) && isset($message)) {

  $db->query('CALL broadcast_Utilisateur( :id_uti, :message);', array('id_uti' => $_SESSION["Id_Uti"], 'message' => $message));

  header("Location: ../messagerie.php");
} else {
    echo "error";
    echo $message;
    var_dump(isset($_SESSION["Id_Uti"]));
    var_dump(isset($message));

  }
  
  ?>
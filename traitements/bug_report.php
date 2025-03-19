<?php

require_once 'database/database.php';
use database\database;

$db = new database();

$message = $_POST['message'];
if (isset($_SESSION["Id_Uti"]) && isset($message)) {

    $db->query('CALL broadcast_admin( :id_uti, :message);', array('id_uti' => $_SESSION["Id_Uti"], 'message' => $message));
} else {

  $db->query('CALL broadcast_admin(0 , :message);', array('message' => $message));
}


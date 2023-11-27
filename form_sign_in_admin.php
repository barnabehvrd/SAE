<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
				<form class="formulaire" action="traitement_formulaire_sign_in_admin.php" method="post">
					<h1>Connection</h1>
					<?php
					if (isset($_GET['mail'])) {
 					  	 $mail = $_GET['mail'];
   						 echo " $mail <br>";
						}
					?>
					<label for="mail">mail :</label>
					<input type="text" name="mail" id="mail" required><br><br>
					<?php 
						if (isset($_GET['pwd'])) {
 					  	 $pwd = $_GET['pwd'];
   						 echo " $pwd <br>";
						}?>
					<label for="pwd">password :</label>
					<input type="text" name="pwd" id="pwd" required><br><br>
					<input type="submit" value="Envoyer">
				</form>
</html>
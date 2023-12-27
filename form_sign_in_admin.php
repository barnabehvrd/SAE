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
 					  	 $mail = htmlspecialchars($_GET['mail']);
   						 echo " $mail <br>";
						}
					?>
					<label for="mail">mail :</label>
					<input type="text" pattern="[A-Za-z0-9._-]{1,20}@[A-Za-z0-9.-]{1,16}\.[A-Za-z]{1,4}" name="mail" id="mail" required><br><br>
					<?php 
						if (isset($_GET['pwd'])) {
 					  	 $pwd = htmlspecialchars($_GET['pwd']);
   						 echo " $pwd <br>";
						}?>
					<label for="pwd">password :</label>
					<input type="text" name="pwd" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}".{8,50}" title="Le mot de passe doit avoir entre 8 et 50 caractères." id="pwd" required><br><br>
					<input type="submit" value="Envoyer">
				</form>
</html>


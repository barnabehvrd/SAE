<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<?php
    	function dbConnect(){
        $host = 'localhost';
        $dbname = 'sae3';
        $user = 'root';
        $password = '';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
      }
    ?>
    <div class="container">
        <div class="left-column">
			<img class="logo" src="img/logo.png">
        </div>
        <div class="right-column">
            <div class="fixed-banner">
                <!-- Partie gauche du bandeau -->
                <div class="banner-left">
                    <div class="button-container">
                        <button class="button"><a href="index.php">accueil</a></button>
                        <button class="button"><a href="message.php">messagerie</a></button>           
						<button class="button"><a href="commandes.php">commandes</a></button>

                    </div>
                </div>
                <!-- Partie droite du bandeau -->
                <div class="banner-right">
					<a class="fixed-size-button" href="form_sign_in.php" >
					<?php if (!isset($_SESSION)) {
						
					session_start();
					echo "connection";
					}
					else {
					echo $_SESSION['Mail_Uti']; 
					}
						
					?>
					
					
					</a>
                </div>
            </div>
			<div class="contenu">
            <!-- Contenu de la partie droite (sous le bandeau) -->
            <h1>Partie droite (1/5)</h1>
			<?php
                $bdd=dbConnect();
				$utilisateur=$_SESSION["Id_Uti"];
                $queryGetCommande = $bdd->query(('SELECT Nom_Uti, Prenom_Uti, Adr_Uti FROM COMMANDE INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod WHERE COMMANDE.Id_Uti=\''.$utilisateur.'\';'));
                $returnQueryGetCommande = $queryGetCommande->fetchAll(PDO::FETCH_ASSOC);
                $i=0;
                if(count($returnQueryGetCommande)==0){
                    echo "Aucune commande pour le moment";
                }
                else{
                    while ($i<count($returnQueryGetCommande)){
						$Nom_Prod = $returnQueryGetCommande[$i]["Nom_Uti"];
						$Nom_Prod = strtoupper($Nom_Prod);
						$Prenom_Prod = $returnQueryGetCommande[$i]["Prenom_Uti"];
						$Adr_Uti = $returnQueryGetCommande[$i]["Adr_Uti"];
                        echo '<div class="commande" >';
                        echo "Commande n°" . $i+1 ." : Chez ".$Prenom_Prod.' '.$Nom_Prod.' - '.$Adr_Uti;
                        echo '</div> '; 
                        $i++;
                    }
                }
            ?>
			</div>
			<form class="formulaire" action="bug_report.php" method="post">
					<p class= "centered">report a bug</p>
					<label for="mail">mail :</label>
					<input type="text" name="mail" id="mail" required><br><br>
					<label for="pwd">message : </label>
					<input type="text" name="message" id="message" required><br><br>
					<input type="submit" value="Envoyer">
			</form>
			
		</div>
    </div>
</body>
</html>

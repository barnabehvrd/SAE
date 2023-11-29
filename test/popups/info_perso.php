<div class="popup">
    <div class="contenuPopup">
        <div>
            <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		    </form>
        </div>
        <p class="titrePopup">Informations personelles</p>
        <div class="formPopup">
            <?php
            require 'traitements/chargement_info_perso.php';
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {?>
                    <form method="post">
                        
                    <!--  Set default values to current user information -->
                    <label for="new_nom">Nom :</label><br>
                    <input type="text" name="new_nom" value=<?php echo ($row["Nom_Uti"]) ?>><br>

                    <label for="new_prenom">Prénom :</label><br>
                    <input type="text" name="new_prenom" value=<?php echo ($row["Prenom_Uti"]) ?>><br>
                    
                    <label for="new_adr">Adresse postale :</label><br>
                    <input type="text" name="new_adr" value="<?php echo ($row["Adr_Uti"])?>"><br>
                    
                    <!-- Add the submit button -->
                    <input type="submit" value="Modifier">
                    </form>
                    <?php
                    //var_dump($row["Adr_Uti"]);
                }
            } else {
                ?><p>Aucun résultat trouvé pour votre compte, veuillez contacter le support.</p><?php
            }
            $stmt->close();
            $connexion->close();
            ?>
        </div>
        <?php
        if (isset($_POST['formClicked'])){
            require 'traitements/update_user_info.php';
            unset($_POST['formClicked']);
        }
        ?>
    </div>
</div>


<!--
            
                <button class="button"><a href="log_out.php">déconexion</a></button>
            

                    
                                
                        </div>
                </div>
                <div class="square">
                                   <form action="update_pwd_info.php" method="post">
                                        <label for="new_mdp1">nouveau mot de passe :</label><br>
                                        <input type="text" name="pwd1"> <br>
                                        <label for="new_mdp2">ressaisissez le nouveau mot de passe :</label><br>
                                        <input type="text" name="pwd2"> <br>
                                        <input type="submit" value="Modifier">
                                   </form>
                                        
                </div>
                <div class="square">
                                     <label for="btn-producteur">Je souhaite supprimer mon compte</label>
				                        <input type="button" onclick="window.location.href='del_acc.php'" id="del_acc_button" value="supprimer">
				
                </div>
                <div class="square">
                    <h2>modifier votre photo de profil</h2>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="image" accept=".png" required>
                    <button type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
                <form class="formulaire" action="bug_report.php" method="post">
					<p class= "centered">report a bug</p>
					<label for="pwd">message : </label>
					<input type="text" name="message" id="message" required><br><br>
					<input type="submit" value="Envoyer">
			    </form>
			</div>

			
		</div>
    </div>
</body>
</html> -->

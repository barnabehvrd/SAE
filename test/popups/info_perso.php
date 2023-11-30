<div class="popup">
    <div class="contenuPopup">
        <div style="display:flex;justify-content:space-between;">
            <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		    </form>
            <form method="post">
				<input type="submit" value="se deconnecter" name="deconnexion">
                <input type="hidden" name="popup" value="info_perso">
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
                    <label for="new_nom">Nom :</label>
                    <input type="text" name="new_nom" value=<?php echo ($row["Nom_Uti"]) ?>>

                    <label for="new_prenom">Prénom :</label>
                    <input type="text" name="new_prenom" value=<?php echo ($row["Prenom_Uti"]) ?>>
                    
                    <label for="new_adr">Adresse postale :</label>
                    <input type="text" name="new_adr" value="<?php echo ($row["Adr_Uti"])?>">
                    
                    <!-- Add the submit button -->
                    <input type="submit" name="formClicked" value="Modifier">
                    </form>
                    <?php
                    //var_dump($row["Adr_Uti"]);
                }
            } else {
                ?><p>Aucun résultat trouvé pour votre compte, veuillez contacter le support.</p><?php
            }
            ?>
        </div>
        <?php
        if (isset($_POST['formClicked'])){
            require 'traitements/update_user_info.php';
            unset($_POST['formClicked']);
        }
        if(isset($_POST['deconnexion'])){
            require 'traitements/log_out.php';
            unset($_POST['deconnexion']);
        }
        ?>
    </div>
</div>

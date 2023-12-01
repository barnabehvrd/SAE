<div class="popup">
    <div class="contenuPopup">
        <div style="display:flex;justify-content:space-between;">
            <form method="post">
				<input class="lienPopup" type="submit" value="Se deconnecter" name="formClicked">
                <input type="hidden" value='info_perso' name="popup">
                <input type="hidden" name="deconnexion">
		    </form>
            <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		    </form>
        </div>
        <p class="titrePopup">Informations personelles</p>
        <div>
        <?php
        require 'traitements/chargement_info_perso.php';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {?>
                <form class="formPopup" method="post">
                    
                    <input type="hidden" value='info_perso' name="popup">
                    
                    <!--  Set default values to current user information -->
                    <div>
                        <label for="new_nom">Nom :</label>
                        <input class="zoneDeTextePopup zoneDeTextePopupFixSize" type="text" name="new_nom" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâô ]{0,100}" value=<?php echo ($row["Nom_Uti"]) ?>>
                    </div>
                    <div>
                        <label for="new_prenom">Prénom :</label>
                        <input class="zoneDeTextePopup zoneDeTextePopupFixSize" type="text" name="new_prenom" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâô ]{0,100}" value=<?php echo ($row["Prenom_Uti"]) ?>>
                    </div>
                    <div>
                        <label>Adresse postale actuelle :</label>
                        <label><?php echo ($row["Adr_Uti"])?></label>
                    </div>
                    <div>
                        <label for="rue">Rue :</label>
                        <input class="zoneDeTextePopup" type="text" name="rue" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâô ]{0,100}"  title="La rue doit commencer par une majuscule et avoir une longueur maximale de 100 caractères." required>
                    </div>
                    <div>
                            <label for="code">Code postale :</label>
                            <input class="zoneDeTextePopup" type="text" name="code" pattern="^\d{5}$" title="Le code postal doit contenir exactement 5 chiffres." required>
                    </div>
                    <div>
                        <label for="ville">Ville :</label>
                        <input class="zoneDeTextePopup" type="text" name="ville" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâô ]{0,100}" title="la ville doit faire  entre 0 et 100 caractères alphanumériques, espaces autorisés." required>
                    </div>
                    <div>
                        <?php
                        if (isset($_POST['erreur'])) {
                            $erreur = $_POST['erreur'];
                            echo '<p class="erreur">'.$erreur.'</p>';
                            unset($_POST['erreur']);
                        }
                        ?>
                    </div>
                    <input class="boutonPopup" type="submit" name="formClicked" value="Modifier">
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
            unset($_POST['formClicked']);
            require 'traitements/update_user_info.php';
            $_SESSION['actualiser'] = true;
        }
        if(isset($_POST['deconnexion'])){
            unset($_POST['deconnexion']);
            require 'traitements/log_out.php';
            $_SESSION['actualiser'] = true;
        }
        ?>
    </div>
</div>

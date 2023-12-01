<div class="popup">
    <div class="contenuPopup">
        <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		</form>
        <p class="titrePopup">Se connecter <?php if((isset($_SESSION['tempIsAdmin']) and $_SESSION['tempIsAdmin']))
                                            {echo '(Admin)';}?></p>
        <div>
            <form class="formPopup" method="post">
                <input type="hidden" name="popup" value=
                <?php if((isset($_SESSION['tempIsAdmin']) and $_SESSION['tempIsAdmin'])){echo '"sign_in_admin"';}else{echo '"sign_in_client"';}?>>
                <div>
                    <label for="mail">Mail :</label>
                    <input class="zoneDeTextePopup" type="text" pattern="[A-Za-z0-9._-]{1,20}@[A-Za-z0-9.-]{1,16}\.[A-Za-z]{1,4}"name="mail" required>
                </div>
                <div>
                    <label for="pwd">Mot de passe :</label>
                    <input class="zoneDeTextePopup" type="password" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}".{8,50}" title="Le mot de passe doit avoir entre 8 et 50 caractères." name="pwd" required>
                </div>
                <div>
                    <?php
                    if (isset($_SESSION['erreur'])) {
                        $erreur = $_SESSION['erreur'];
                        echo '<p class="erreur">'.$erreur.'</p>';
                        unset($_SESSION['erreur']);
                    }
                    ?>
                </div>
                <input class="boutonPopup" name="formClicked" type="submit" value="se connecter">
            </form>
            <?php
            if (isset($_POST['formClicked'])){
                if((isset($_SESSION['tempIsAdmin']) and $_SESSION['tempIsAdmin'])){
                    $_SESSION['debug'][0]=0;
                    require 'traitements/traitement_formulaire_sign_in_admin.php';
                }else{
                    $_SESSION['debug'][0]=1;
                    require 'traitements/traitement_formulaire_sign_in.php';
                }
                unset($_POST['formClicked']);
                $_SESSION['actualiser'] = true;
            }
            ?>
            <div>
                <form method="post">
					<?php if((isset($_SESSION['tempIsAdmin']) and $_SESSION['tempIsAdmin'])){?>
                        <input type="submit" value="Se connecter en tant qu'utilisateur lambda" class="lienPopup">
                        <input type="hidden" name="popup" value="sign_in_client">
                    <?php }else{ ?> 
                        <input type="submit" value="Se connecter en tant qu'administrateur" class="lienPopup">
                        <input type="hidden" name="popup" value="sign_in_admin">
                    <?php } ?>
			    </form>
            </div>
        </div>
        <div>
            <form method="post">
				<input type="submit" value="Mot de passe oublié ?" class="lienPopup">
                <input type="hidden" name="popup" value="reset_mdp">
			</form>
        </div>
        <div class="alignementCentreCoteACote">
            <p class="text">Vous n'avez pas de compte ?</p>
            <form method="post">
				<input type="submit" value="S'inscrire" class="lienPopup">
                <input type="hidden" name="popup" value="pre_sign_up">
			</form>
        </div>
    </div>
</div>

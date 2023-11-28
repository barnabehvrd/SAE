<div class="popup">
    <div class="contenuPopup">
        <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		</form>
        <p class="titrePopup">Se connecter <?php if((isset($_SESSION['tempIsAdmin']) and $_SESSION['tempIsAdmin']))
                                            {echo '(Admin)';}?></p>
        <div>
            <form class="formPopup" action=
                                            <?php if((isset($_SESSION['tempIsAdmin']) and $_SESSION['tempIsAdmin']))
                                            {echo '"../traitements/traitement_formulaire_sign_in_admin.php"';}
                                            else{echo '"../traitements/traitement_formulaire_sign_in.php"';}?>
                    method="post">
                <div>
                    <label for="mail">Mail :</label>
                    <input class="zoneDeTextePopup" type="text" name="mail" required>
                </div>
                <div>
                    <label for="pwd">Mot de passe :</label>
                    <input class="zoneDeTextePopup" type="text" name="pwd" required>
                </div>

                <input class="boutonPopup" type="submit" value="se connecter">

                <?php
                if (isset($_GET['mail'])) {
                    $mail = $_GET['mail'];
                    echo '<p class="erreur"> $mail </p>';
                }

                if (isset($_GET['pwd'])) {
                    $pwd = $_GET['pwd'];
                    echo '<p class="erreur"> $pwd </p>';
                }
                ?>
            </form>
            <div>
                <form method="post">
					<?php if((isset($_SESSION['tempIsAdmin']) and $_SESSION['tempIsAdmin'])){?>
                        <input type="submit" value="Se connecter en tant qu'utilisateur lambda" class="lienPopup">
                        <input type="hidden" name="popup" value="sign_in">
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
				<input type="submit" value="S'incrire" class="lienPopup">
                <input type="hidden" name="popup" value="pre_sign_up">
			</form>
        </div>
    </div>
</div>

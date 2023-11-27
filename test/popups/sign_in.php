<div class="popup">
    <div class="contenuPopup">
        <p class="titrePopup">Se Connecter</p>
        <div>
            <form class="formPopup" action="traitement_formulaire_sign_in.php" method="post"> <!--      -->
                <div>
                    <label for="mail">Mail :</label>
                    <input class="zoneDeTextePopup" type="text" name="mail" required>
                </div>
                <div>
                    <label for="pwd">Mot de passe :</label>
                    <input class="zoneDeTextePopup" type="text" name="pwd" required>
                </div>

                <input class="boutonPopup" type="submit" value="Envoyer">

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
						<input type="submit" value="Se connecter en tant que administrateur" class="lienPopup">
                        <input type="hidden" name="popup" value="sign_in_admin">
			    </form>
                <!-- <input type="button" onclick="window.location.href='form_sign_up_admin.php'" id="btn-admin" action="form_sign_up_amdin.php" value="administrateur"> -->
            </div>
        </div>
        <div class="alignementCentreCoteACote">
            <p class="text">Vous n'avez pas de compte ?</p>
            <form method="post">
				<input type="submit" value="S'incrire" class="lienPopup">
                <input type="hidden" name="popup" value="sign_up">
			</form>
        </div>
    </div>
</div>

<div class="popup">
    <div class="contenuPopup">
        <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		</form>
        <p class="titrePopup">Contacter un administrateur ou report un bug</p>
        <form class="formPopup" method="post">
            <div>
                <label for="mail">Mail :</label>
                <input type="hidden" value='0' name="formClicked">
                <input class="zoneDeTextePopup" type="text" pattern="[A-Za-z0-9._-]{1,20}@[A-Za-z0-9.-]{1,16}\.[A-Za-z]{1,4}" name="mail" id="mail" required
                <?php if(isset($_SESSION['Mail_Uti'])){
                    echo 'disable';} ?> >
            </div>
            <label for="pwd">Message : </label>
            <textarea class="grosseZoneDeTextePopup" name="message" pattern="[A-Za-z0-9.]{1,4096}" required></textarea>
            <input class="boutonPopup" type="submit" value="Envoyer">
        </form>
        <?php
        if (isset($_POST['formClicked'])){
            require 'traitements/traitement_formulaire_sign_up.php';
            unset($_POST['formClicked']);
        }
        ?>
    </div>
</div>










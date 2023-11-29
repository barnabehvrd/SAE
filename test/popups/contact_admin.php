<div class="popup">
    <div class="contenuPopup">
        <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		</form>
        <p class="titrePopup">Contacter un administrateur ou report un bug</p>
        <form class="formPopup" method="post">
            <?php if(!isset($_SESSION['Mail_Uti'])){ ?>
            <div >
                <label for="mail">Mail :</label>
                <input class="zoneDeTextePopup" type="text" pattern="[A-Za-z0-9._-]{1,20}@[A-Za-z0-9.-]{1,16}\.[A-Za-z]{1,4}" name="mail" id="mail" required>
            </div>
            <?php } ?>
            <label for="pwd">Message : </label>
            <textarea class="grosseZoneDeTextePopup" name="message" pattern="[A-Za-z0-9.]{1,4096}" required></textarea>
            <input class="boutonPopup" type="submit" value="Envoyer" name="formClicked">
        </form>
        <?php
        if (isset($_POST['formClicked'])){
            require 'traitements/traitement_formulaire_sign_up.php';
            unset($_POST['formClicked']);
        }
        ?>
    </div>
</div>










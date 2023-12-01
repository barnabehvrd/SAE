<div class="popup">
    <div class="contenuPopup">
        <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		</form>
        <p class="titrePopup">Contacter un administrateur ou report un bug</p>
        <form class="formPopup" method="post">
            <input type="hidden" value='contact_admin' name="popup">
            <?php if(!isset($_SESSION['Mail_Uti'])){ ?>
            <div >
                <label for="mail">Mail :</label>
                <input class="zoneDeTextePopup" type="text" pattern="[A-Za-z0-9._-]{1,20}@[A-Za-z0-9.-]{1,16}\.[A-Za-z]{1,4}" name="mail" id="mail" required>
            </div>
            <?php } ?>
            <label for="pwd">Message : </label>
            <textarea class="grosseZoneDeTextePopup" name="message" pattern="{1,4096}" title="respecter le format ! "required></textarea>
            <input class="boutonPopup" type="submit" value="Envoyer" name="formClicked">
        </form>
        <?php
        if (isset($_POST['formClicked'])){
            unset($_POST['formClicked']);
            require 'traitements/bug_report.php';
            $_SESSION['actualiser'] = true;
        }
        ?>
    </div>
</div>










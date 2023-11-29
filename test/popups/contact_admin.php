<div class="popup">
    <div class="contenuPopup">
        <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		</form>
        <p class="titrePopup">Contacter un administrateur ou report un bug</p>
        <form class="formPopup" action="bug_report.php" method="post">
            <div>
                <label for="mail">Mail :</label>
                <input class="zoneDeTextePopup" type="text" name="mail" id="mail" required
                <?php if(isset($_SESSION['Mail_Uti'])){
                    echo 'value="'.$_SESSION['Mail_Uti'].'" disable';
                } ?>
                
                >
            </div>
            <label for="pwd">Message : </label>
            <textarea class="grosseZoneDeTextePopup" name="message" pattern="[A-Za-z0-9.]{1,4096}" required></textarea>
            <input class="boutonPopup" type="submit" value="Envoyer">
        </form>
    </div>
</div>










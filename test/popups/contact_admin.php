<div class="popup">
    <div class="contenuPopup">
        <form method="post">
				<input type="submit" value="" class="boutonQuitPopup">
                <input type="hidden" name="popup" value="">
		</form>
        <p class="titrePopup">Contacter un administrateur ou report un bug</p>
        <form class="formPopup" action="bug_report.php" method="post">
            <div>
                <label for="mail">mail :</label>
                <input class="zoneDeTextePopup" type="text" name="mail" id="mail" required>
            </div>
            <label for="pwd">message : </label>
            <input class="grosseZoneDeTextePopup" type="text" name="message" required><br><br>
            <input class="boutonPopup" type="submit" value="Envoyer">
        </form>
    </div>
</div>










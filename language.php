<?php
    require "language_fr.php" ; 
    echo ('

        <form action="language.php" method="post">
        <label for="languagePicker">Choose a language:</label>
        <select name="language" id="languagePicker">
            <option value="fr">Français</option>
            <option value="en">English</option>
            <option value="es">Español</option>
            <option value="de">Deutsch</option>
        </select>
        <input type="submit" value="Submit">
    </form>

    ')
?>
<?php
if (isset($_POST['popup'])){
    ?>
    <div class="popup">
        <div class="contenuPopup">
            <?php
            require $_POST['popup'].".php"
            ?>
        </div>
    </div>
    <?php
}
?>
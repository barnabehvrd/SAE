<?php
    require "language.php" ; 
?>
<?php
if (isset($_POST['formClicked'])){
    require 'traitements/traitement_formulaire_sign_up.php';
    unset($_POST['formClicked']);
    $_SESSION['actualiser'] = true;
}
?>
<div class="popup">
<div class="contenuPopup">
    <form method="post">
            <input type="submit" value="" class="boutonQuitPopup">
            <input type="hidden" name="popup" value="">
    </form>
    <p class="titrePopup"><?php echo $htmlSInscrire; ?></p>
    <form class="formPopup" method="post"> 
        <div>
            <label for="nom"><?php echo $htmlNomDeuxPoints; ?></label>
            <input class="zoneDeTextePopup" type="text" name="nom" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâôè ]{0,100}" title="la ville doit faire entre 0 et 100 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
            <input type="hidden" value='sign_up' name="popup">
        </div>
        <div>
            <label for="prenom"><?php echo $htmlPrénomDeuxPoints; ?></label>
            <input class="zoneDeTextePopup" type="text" name="prenom" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâôè ]{0,100}" title="la ville doit faire entre 0 et 100 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
        </div>
        <div>
            <label for="rue"><?php echo $htmlRueDeuxPoints; ?></label>
            <input class="zoneDeTextePopup" type="text" name="rue" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôâêàéôââîââçâœççœâôœêëâôè ]{0,120}" title="la rue doit faire entre 0 et 120 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
        </div>
        <div>
            <label for="code"><?php echo $htmlCodePostDeuxPoints; ?></label>
            <input class="zoneDeTextePopup" type="text" name="code" pattern="^\d{5}$" title="Le code postal doit contenir exactement 5 chiffres." required>
        </div>
        <div>
            <label for="ville"><?php echo $htmlVilleDeuxPoints; ?></label>
            <input class="zoneDeTextePopup" type="text" name="ville" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôâêàôââîââçéâœççœâôœêëâôè ]{0,120}" title="la ville doit faire entre 0 et 120 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
        </div>
        <div>
            <label for="pwd"><?php echo $htmlNouveauMdpDeuxPoints; ?></label>
            <input class="zoneDeTextePopup" type="password" name="pwd" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}".{8,50}" title="Le mot de passe doit avoir entre 8 et 50 caractères." required>
        </div>
        <div>
            <label for="mail"><?php echo $htmlMailDeuxPoints; ?></label>
            <input class="zoneDeTextePopup" type="mail"  name="mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" size="40" required >
        </div>
        <?php if((isset($_SESSION['tempIsProd']) and $_SESSION['tempIsProd'])){?> 
        <div>
            <label for="profession"><?php echo $htmlParProfession; ?></label>

			<!--  <input class="zoneDeTextePopup" type="profession" name="profession" required> -->

            <select class="zoneDeTextePopup" name="profession" required>
                <option value="Agriculteur" selected><?php echo $htmlAgriculteur; ?></option>
                <option value="Vigneron"><?php echo $htmlVigneron; ?></option>
                <option value="Maraîcher"><?php echo $htmlMaraîcher; ?></option>
                <option value="Apiculteur"><?php echo $htmlApiculteur; ?></option>
                <option value="Éleveur de volaille"><?php echo $htmlÉleveurdevolailles; ?></option>
                <option value="Viticulteur"><?php echo $htmlViticulteur; ?></option>
                <option value="Pépiniériste"><?php echo $htmlPépiniériste; ?></option>
            </select>


        </div>
        <?php } ?>
        <div>
            <?php
            if (isset($_SESSION['erreur'])) {
                
                $erreur = $_SESSION['erreur'];
                echo '<p class="erreur">'.$erreur.'</p>';
            }
            ?>
        </div>
        <input class="boutonPopup" name="formClicked" type="submit" value="<?php echo $htmlSInscrire; ?>">
    </form>
    <div class="alignementCentreCoteACote">
        <p class="text"><?php echo $htmlDejaUnCompte; ?></p>
        <form method="post">
            <input type="submit" value="<?php echo $htmlSeConnecter; ?>" class="lienPopup">
            <input type="hidden" name="popup" value="sign_in">
        </form>
    </div>
</div>
</div>

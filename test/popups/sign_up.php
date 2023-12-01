<div class="popup">
<div class="contenuPopup">
    <form method="post">
            <input type="submit" value="" class="boutonQuitPopup">
            <input type="hidden" name="popup" value="">
    </form>
    <p class="titrePopup">S'inscrire</p>
    <form class="formPopup" method="post"> 
        <div>
            <label for="nom">Nom :</label>
            <input class="zoneDeTextePopup" type="text" name="nom" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâô ]{0,100}" title="la ville doit faire entre 0 et 100 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
            <input type="hidden" value='0' name="formClicked">
            <input type="hidden" value='sign_up' name="popup">
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input class="zoneDeTextePopup" type="text" name="prenom" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôéâêàôââîââçâœççœâôœêëâô ]{0,100}" title="la ville doit faire entre 0 et 100 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
        </div>
        <div>
            <label for="rue">Rue :</label>
            <input class="zoneDeTextePopup" type="text" name="rue" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôâêàéôââîââçâœççœâôœêëâô ]{0,120}" title="la rue doit faire entre 0 et 120 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
        </div>
        <div>
            <label for="code">Code postale :</label>
            <input class="zoneDeTextePopup" type="text" name="code" pattern="^\d{5}$" title="Le code postal doit contenir exactement 5 chiffres." required>
        </div>
        <div>
            <label for="ville">Ville :</label>
            <input class="zoneDeTextePopup" type="text" name="ville" pattern="[A-Za-z0-9îçôââêœîâôëçââÿââœçêôïëœœôââôêâçôâêàôââîââçéâœççœâôœêëâô ]{0,120}" title="la ville doit faire entre 0 et 120 caractères alphanumériques, espaces autorisés, et les caractères suivants sont autorisés : î, ç, ô, â, â, ê, œ, î, â, ô, ë, ç, â, â, ÿ, â, â, œ, ç, ê, ô, ï, ë, œ, œ, ô, â, â, ô, ê, â, ç, ô, â, ê, à, ô, â, â, î, â, â, ç, â, œ, ç, ç, œ, â, ô, œ, ê, ë, â, ô" required>
        </div>
        <div>
            <label for="pwd">Mot de passe :</label>
            <input class="zoneDeTextePopup" type="password" name="pwd" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}".{8,50}" title="Le mot de passe doit avoir entre 8 et 50 caractères." required>
        </div>
        <div>
            <label for="mail">Mail :</label>
            <input class="zoneDeTextePopup" type="mail"  name="mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" size="40" required >
        </div>
        <?php if((isset($_SESSION['tempIsProd']) and $_SESSION['tempIsProd'])){?> 
        <div>
            <label for="profession">Profession :</label>
			<input class="zoneDeTextePopup" type="profession" name="profession" required>
        </div>
        <?php } ?>
        <div>
            <?php
            if (isset($_SESSION['erreur'])) {
                
                $erreur = $_SESSION['erreur'];
                echo '<p class="erreur">'.$erreur.'</p>';
                unset($_SESSION['erreur']);
            }
            ?>
        </div>
        <input class="boutonPopup" type="submit" value="s'incrire">
    </form>
    <?php
        if (isset($_POST['formClicked'])){
            require 'traitements/traitement_formulaire_sign_up.php';
            unset($_POST['formClicked']);
            $_SESSION['actualiser'] = true;
        }
        ?>
    <div class="alignementCentreCoteACote">
        <p class="text">J'ai déjà un compte</p>
        <form method="post">
            <input type="submit" value="Se connecter" class="lienPopup">
            <input type="hidden" name="popup" value="sign_in">
        </form>
    </div>
</div>
</div>

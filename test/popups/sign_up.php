<div class="popup">
<div class="contenuPopup">
    <form method="post">
            <input type="submit" value="" class="boutonQuitPopup">
            <input type="hidden" name="popup" value="">
    </form>
    <p class="titrePopup">S'inscrire</p>
    <form class="formPopup" method="post"> <!--      -->
        <div>
            <label for="nom">Nom :</label>
            <input class="zoneDeTextePopup" type="text" name="nom" required>
            <input type="hidden" value='0' name="formClicked">
            <input type="hidden" value='sign_up' name="popup">
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input class="zoneDeTextePopup" type="text" name="prenom" required>
        </div>
        <div>
            <label for="rue">Rue :</label>
            <input class="zoneDeTextePopup" type="text" name="rue" required>
        </div>
        <div>
            <label for="code">Code postale :</label>
            <input class="zoneDeTextePopup" type="text" name="code" required>
        </div>
        <div>
            <label for="ville">Ville :</label>
            <input class="zoneDeTextePopup" type="text" name="ville" required>
        </div>
        <div>
            <label for="pwd">Mot de passe :</label>
            <input class="zoneDeTextePopup" type="password"  name="pwd" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" required>
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

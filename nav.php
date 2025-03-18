
<nav class="navbar navbar-expand-md bg-body-tertiary">
  <div class="container-fluid">
    <a href="index.php"><img class="logo-mini d-block d-md-none" href="index.php" src="img/logo.png"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><?php echo $htmlAccueil?></a> 
        </li>
        <?php if (isset($_SESSION["Id_Uti"])): ?>
          <li class="nav-item">
            <a class="nav-link" href="messagerie.php"><?php echo $htmlMessagerie?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="achats.php"><?php echo $htmlAchats?></a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION["isProd"]) and ($_SESSION["isProd"]==true)): ?>
          <li class="nav-item">
            <a class="nav-link" href="produits.php"><?php echo $htmlProduits?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="commandes.php"><?php echo $htmlCommandes?></a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION["isAdmin"]) and ($_SESSION["isAdmin"]==true)): ?>
          <li class="nav-item">
            <a class="nav-link" href="panel_admin.php"><?php echo $htmlPanelAdmin?></a>
          </li>
        <?php endif; ?>
          <li>
            <form method="post" id="languageForm">
              <div class="input-group ms-2">
                <div class="input-group-text"><i class="bi bi-translate"></i></div>
                <select name="language" id="languagePicker" class="form-select" onchange="submitForm()">
                  <option value="fr" <?php if($_SESSION["language"]=="fr") echo 'selected';?>>Français</option>
                  <option value="en" <?php if($_SESSION["language"]=="en") echo 'selected';?>>English</option>
                  <option value="es" <?php if($_SESSION["language"]=="es") echo 'selected';?>>Español</option>
                  <option value="al" <?php if($_SESSION["language"]=="al") echo 'selected';?>>Deutsch</option>
                  <option value="ru" <?php if($_SESSION["language"]=="ru") echo 'selected';?>>русский</option>
                  <option value="ch" <?php if($_SESSION["language"]=="ch") echo 'selected';?>>中國人</option>
                </select>
              </div>
            </form>
                <script>
                    function submitForm() {
                        document.getElementById("languageForm").submit();
                    }
                </script>
          </li>
      </ul>
      <form method="post" class="">
          <?php
          if(!isset($_SESSION)){
            session_start();
          }
          if(isset($_SESSION, $_SESSION['tempPopup'])){
            $_POST['popup'] = $_SESSION['tempPopup'];
            unset($_SESSION['tempPopup']);
          }
          ?>
					<input type="submit" class="btn btn-success" value="<?php if (!isset($_SESSION['Mail_Uti'])){/*$_SESSION = array()*/; echo($htmlSeConnecter);} else {echo ''.$_SESSION['Mail_Uti'].'';}?>" class="boutonDeConnection">
          <input type="hidden" name="popup" value=<?php if(isset($_SESSION['Mail_Uti'])){echo '"info_perso"';}else{echo '"sign_in"';}?>> 
        </form>
    </div>
  </div>
</nav>

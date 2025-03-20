<?php
    ob_start();
    require "language.php" ; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $htmlMarque; ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <main>
        <?php
        if(!isset($_SESSION)){
            session_start();
        }
        ?>
        <div class="row h-100 g-0">
        
        <div class="col-12 col-md-3 col-lg-2">
            <nav id="sidebar" class="h-100 flex-column align-items-stretch bg-success">
                <img class="logo d-none d-md-block" href="index.php" src="img/logo.png">
                <!-- code -->
                <div class="container-fluid">
                    <div class="d-flex flex-column my-2">
                        <p class="text-light"><?php echo $htmlContactsRecentsDeuxPoints?></p>
                        <div class="scrollbox">
                            <?php
                            require 'traitements/afficheContacts.php';
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-12 col-md-9 col-lg-10 d-flex flex-column h-100">
            <?php require "nav.php";?>
            <div class="container-fluid my-3 d-flex flex-column flex-grow-1">
                <!-- code -->
                <div class="d-flex flex-column justify-content-between flex-grow-1">
                    <div>
                        <h1>
                            <?php if (!isset($_GET['Id_Interlocuteur'])) { echo 'disabled';} ?>
                            <?php 
                            require "traitements/afficherInterlocuteur.php";
                            ?>
                        </h1>
                        <hr>
                    </div>
                    <div class="scrollbox">
                        <?php
                        require 'traitements/afficheMessages.php';
                        ?>
                    </div>
                    <div class="d-flex w-100 ">
                        <form method="post" id="zoneDEnvoi" class="w-100">
                            <div class="input-group">
                                <input type="text" name="content" id="zoneDeTexte" class="form-control <?php if ($formDisabled) { echo 'disabled';} ?>" placeholder="Message..." <?php if ($formDisabled) { echo 'disabled';} ?>>
                                <button class="btn btn-success" type="submit" value=""><i class="bi bi-send-fill"></i></button>
                            </div>
                        </form>
                        <?php
                        require 'traitements/envoyerMessage.php';
                        ?>
                    </div>
                </div>
                
                
            </div>
        </div>
        
    </div>
    </main>
    <footer class="bg-light d-flex justify-content-center align-items-center">
        <form method="post">
            <input type="submit" value="Signaler un dysfonctionnement" class="lienPopup">
            <input type="hidden" name="popup" value="contact_admin">
        </form>
        <form method="post">
            <input type="submit" value="CGU" class="lienPopup">
            <input type="hidden" name="popup" value="cgu">
        </form>
    </footer>
    <?php require "popups/gestion_popups.php";?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
ob_end_flush();
?>
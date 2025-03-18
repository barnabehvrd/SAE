<?php
  require "language.php" ; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>L'étal en ligne</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style_general.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="row h-100 g-0">
        
        <div class="col-12 col-md-3 col-lg-2">
            <nav id="sidebar" class="h-100 flex-column align-items-stretch bg-success">
                <img class="logo d-none d-md-block" href="index.php" src="img/logo.png">
                    <!-- code -->
            </nav>
        </div>
        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php";?>
            <div class="container-fluid my-3">
                <!-- code -->

                <!-- exemple de page -->
                
                <div class="d-flex flex-column">
                    <h1>Titre</h1>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <img src="/img_producteur/1.png" class="w-100 h-100 object-fit-cover rounded-start" alt="...">
                                    </div>
                                    <div class="col-7">
                                        <div class="card-body">
                                            <h2 class="card-title">Producteur</h2>
                                            <span class="badge rounded-pill text-bg-success mb-3">Métier</span>
                                            <p class="card-text"><i class="bi bi-geo-alt-fill text-success me-2"></i>Adresse du producteur, XXXXX</p>
                                            <a href="#" class="btn btn-success">Consulter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
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
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
    <main>
        <div class="row g-0">
        
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

                <!-- exemple de page liste producteurs -->
                
                <div class="d-flex flex-column">
                    <h1><?php echo $htmlProducteursEnMaj?></h1>
                    <div class="row g-3">
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

                <!-- exemple de page producteur -->
                 <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4 order-md-2">
                        <div class="d-flex flex-column bg-light rounded p-3 gap-2">
                            <img src="img_producteur/1.png" class="w-100" alt="">
                            <h1>Nom du producteur</h1>
                            <span class="badge rounded-pill text-bg-success">Métier</span>
                            <p><i class="bi bi-geo-alt-fill text-success me-2"></i>Adresse du producteur, XXXXX</p>
                            <input type="button" class="btn btn-outline-success" onclick="window.location.href='messagerie.php?Id_Interlocuteur=<?php echo $idUti; ?>'" value="<?php echo $htmlEnvoyerMessage; ?>">
                            <iframe class="map-frame" src="https://maps.google.com/maps?&q=<?php echo $address; ?>&output=embed " 
                                width="100%" height="100%">
                            </iframe>
                            <form method="get" action="insert_commande.php">
                                <input type="hidden" name="Id_Prod" value="<?php echo $Id_Prod?>">
                                <buitton type="submit" class="btn btn-success w-100"><?php echo $htmlPasserCommande; ?></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="d-flex flex-column">
                            <h2><?php echo $htmlProduitsProposesDeuxPoints; ?></h2>
                            <div class="row g-3">
                                <div class="col-12 col-lg-6 col-xl-4">
                                    <div class="card">
                                        <img src="img_produit/5.png" class="card-img-top" alt="image produit">
                                        <div class="card-body">
                                            <h5 class="card-title">Nom produit</h5>
                                            <p class="card-text"><i class="bi bi-box-seam-fill text-success me-2"></i>Type</p>
                                            <p class="card-text"><i class="bi bi-tag-fill text-success me-2"></i>XX.XX €/Kg</p>
                                            
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="bi bi-basket2-fill text-success"></i></span>
                                                <input type="number" class="form-control">
                                                <span class="input-group-text">Kg</span>
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
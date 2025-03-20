<?php
require "language.php";

require_once 'database/database.php';
use database\database;

$db = new database();
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
<?php
if(!isset($_SESSION)){
    session_start();
}

$returnQueryIdProd = $db->select('SELECT Id_Prod FROM PRODUCTEUR WHERE Id_Uti= :Id_Uti ;', [':Id_Uti' => $_SESSION["Id_Uti"]]);
$Id_Prod=$returnQueryIdProd[0]["Id_Prod"];
?>

<main>
    <div class="row g-0">
        <div class="col-12 col-md-3 col-lg-2">
            <nav id="sidebar" class="h-100 flex-column align-items-stretch bg-success">
                <img class="logo d-none d-md-block" href="index.php" src="img/logo.png">
                <div class="container-fluid">
                    <div class="d-flex flex-column g-3 py-2">
                        <h5 class="text-light mb-3"><?php echo $htmlAjouterProduit; ?></h5>
                        <form action="insert_products.php" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-basket-fill text-success"></i></span>
                                <input type="text" class="form-control" pattern="[A-Za-z0-9 ]{0,100}" name="nomProduit" placeholder="<?php echo $htmlNomDuProduit; ?>" required>
                            </div>

                            <div class="input-group">
                                <label class="input-group-text"><i class="bi bi-box-seam-fill text-success"></i></label>
                                <select class="form-select" name="categorie">
                                    <option value="6"><?php echo $htmlAnimaux; ?></option>
                                    <option value="1"><?php echo $htmlFruit; ?></option>
                                    <option value="3"><?php echo $htmlGraine; ?></option>
                                    <option value="2"><?php echo $htmlLégume; ?></option>
                                    <option value="7"><?php echo $htmlPlanche; ?></option>
                                    <option value="4"><?php echo $htmlViande; ?></option>
                                    <option value="5"><?php echo $htmlVin; ?></option>
                                </select>
                            </div>

                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-tag-fill text-success"></i></span>
                                <input type="number" min="0" name="prix" class="form-control" required>
                                <span class="input-group-text">€</span>
                            </div>

                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                <div class="form-check form-check-inline text-light">
                                    <input class="form-check-input" type="radio" name="unitPrix" value="1" id="kgPrice" checked="true">
                                    <label class="form-check-label" for="kgPrice"><?php echo $htmlLeKilo; ?></label>
                                </div>
                                <div class="form-check form-check-inline text-light">
                                    <input class="form-check-input" type="radio" name="unitPrix" value="4" id="piecePrice">
                                    <label class="form-check-label" for="piecePrice"><?php echo $htmlLaPiece; ?></label>
                                </div>
                            </div>

                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-box2-fill text-success"></i></span>
                                <input type="number" min="0" name="quantite" class="form-control" required>
                            </div>

                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                <div class="form-check form-check-inline text-light">
                                    <input class="form-check-input" type="radio" name="unitQuantite" value="1" id="kgQuantity" checked="true">
                                    <label class="form-check-label" for="kgQuantity"><?php echo $htmlKg; ?></label>
                                </div>
                                <div class="form-check form-check-inline text-light">
                                    <input class="form-check-input" type="radio" name="unitQuantite" value="2" id="lQuantity">
                                    <label class="form-check-label" for="lQuantity"><?php echo $htmlL; ?></label>
                                </div>
                                <div class="form-check form-check-inline text-light">
                                    <input class="form-check-input" type="radio" name="unitQuantite" value="3" id="m2Quantity">
                                    <label class="form-check-label" for="m2Quantity"><?php echo $htmlM2; ?></label>
                                </div>
                                <div class="form-check form-check-inline text-light">
                                    <input class="form-check-input" type="radio" name="unitQuantite" value="4" id="pieceQuantity">
                                    <label class="form-check-label" for="pieceQuantity"><?php echo $htmlPiece; ?></label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light"><?php echo $htmlImageDeuxPoints; ?></label>
                                <input class="form-control" type="file" name="image" accept=".png">
                            </div>

                            <button type="submit" class="btn btn-light"><?php echo $htmlAjouterProduit; ?></button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php"; ?>
            <div class="container-fluid my-3">
                <div class="d-flex flex-column">
                    <h1><?php echo $htmlMesProduitsEnStock; ?></h1>

                    <?php
                    $returnQueryGetProducts = $db->select('SELECT Id_Produit, Nom_Produit, Desc_Type_Produit, Prix_Produit_Unitaire, Nom_Unite_Prix, Qte_Produit, Nom_Unite_Stock FROM Produits_d_un_producteur WHERE Id_Prod= :Id_Prod ;', [':Id_Prod' => $Id_Prod]);

                    if(count($returnQueryGetProducts) == 0): ?>
                        <p class="text-center"><?php echo $htmlAucunProduitEnStock; ?></p>
                    <?php else: ?>
                        <div class="row g-3">
                            <?php foreach($returnQueryGetProducts as $produit):
                                $Id_Produit = $produit["Id_Produit"];
                                $nomProduit = $produit["Nom_Produit"];
                                $typeProduit = $produit["Desc_Type_Produit"];
                                $prixProduit = $produit["Prix_Produit_Unitaire"];
                                $QteProduit = $produit["Qte_Produit"];
                                $unitePrixProduit = $produit["Nom_Unite_Prix"];
                                $Nom_Unite_Stock = $produit["Nom_Unite_Stock"];

                                if($QteProduit > 0): ?>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card h-100">
                                            <img src="img_produit/<?php echo $Id_Produit; ?>.png" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php echo $htmlImageNonFournie; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $nomProduit; ?></h5>
                                                <p class="card-text"><i class="bi bi-box-seam-fill text-success me-2"></i><?php echo $typeProduit; ?></p>
                                                <p class="card-text"><i class="bi bi-tag-fill text-success me-2"></i><?php echo $prixProduit; ?> €/<?php echo $unitePrixProduit; ?></p>
                                                <p class="card-text"><i class="bi bi-box2-fill text-success me-2"></i><?php echo $QteProduit; ?> <?php echo $Nom_Unite_Stock; ?></p>
                                                <div class="d-flex gap-2">
                                                    <form action="product_modification.php" method="post">
                                                        <input type="hidden" name="modifyIdProduct" value="<?php echo $Id_Produit; ?>">
                                                        <button type="submit" name="action" class="btn btn-outline-success"><i class="bi bi-pencil-fill me-1"></i><?php echo $htmlModifier; ?></button>
                                                    </form>
                                                    <form action="delete_product.php" method="post">
                                                        <input type="hidden" name="deleteIdProduct" value="<?php echo $Id_Produit; ?>">
                                                        <button type="submit" name="action" class="btn btn-outline-danger"><i class="bi bi-trash-fill me-1"></i><?php echo $htmlSupprimer; ?></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-light d-flex justify-content-center align-items-center">
    <form method="post">
        <input type="submit" value="<?php echo $htmlSignalerDys?>" class="lienPopup">
        <input type="hidden" name="popup" value="contact_admin">
    </form>
    <form method="post">
        <input type="submit" value="<?php echo $htmlCGU?>" class="lienPopup">
        <input type="hidden" name="popup" value="cgu">
    </form>
</footer>

<?php require "popups/gestion_popups.php";?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
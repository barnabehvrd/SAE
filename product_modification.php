<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once 'database/database.php';
    use database\database;

    $db = new database();
    require "language.php" ;
    ?>
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

$utilisateur=htmlspecialchars($_SESSION["Id_Uti"]);
$Id_Produit_Update=htmlspecialchars($_POST["modifyIdProduct"]);
$_SESSION["Id_Produit"]=$Id_Produit_Update;

$returnQueryGetProducts = $db->select('SELECT * FROM PRODUIT WHERE Id_Produit = :Id_Produit_Update', [':Id_Produit_Update' => $Id_Produit_Update]);
$IdProd = $returnQueryGetProducts[0]["Id_Prod"];
$Nom_Produit = $returnQueryGetProducts[0]["Nom_Produit"];
$Id_Type_Produit = $returnQueryGetProducts[0]["Id_Type_Produit"];
$Qte_Produit = $returnQueryGetProducts[0]["Qte_Produit"];
$Id_Unite_Stock = $returnQueryGetProducts[0]["Id_Unite_Stock"];
$Prix_Produit_Unitaire = $returnQueryGetProducts[0]["Prix_Produit_Unitaire"];
$Id_Unite_Prix = $returnQueryGetProducts[0]["Id_Unite_Prix"];
?>
<main>
    <div class="row g-0">
        <div class="col-12 col-md-3 col-lg-2">
            <nav id="sidebar" class="h-100 flex-column align-items-stretch bg-success">
                <img class="logo d-none d-md-block" href="index.php" src="img/logo.png">
                <!-- Sidebar content -->
            </nav>
        </div>

        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php";?>
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h2 class="text-center mb-0">Modifier un produit</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img class="img-fluid rounded mb-4" src="img_produit/<?php echo $Id_Produit_Update; ?>.png" alt="<?php echo $htmlImageNonFournie; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <form action="modify_product.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="IdProductAModifier" value="<?php echo $Id_Produit_Update ?>">

                                            <div class="mb-3">
                                                <label class="form-label"><?php echo $htmlProduitDeuxPoints?></label>
                                                <input type="text" class="form-control" name="nomProduit" value="<?php echo $Nom_Produit?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label"><?php echo $htmlTypeDeuxPoints?></label>
                                                <select class="form-select" name="categorie">
                                                    <?php
                                                    switch ($Id_Type_Produit) {
                                                        case 1:
                                                            echo "<option value=\"1\">".$htmlFruit."</option>";
                                                            echo "<option value=\"6\">".$htmlAnimaux."</option>";
                                                            echo "<option value=\"3\">".$htmlGraine."</option>";
                                                            echo "<option value=\"2\">".$htmlLégume."</option>";
                                                            echo "<option value=\"7\">".$htmlPlanche."</option>";
                                                            echo "<option value=\"4\">".$htmlViande."</option>";
                                                            echo "<option value=\"5\">".$htmlVin."</option>";
                                                            break;
                                                        case 2:
                                                            echo "<option value=\"2\">".$htmlLégume."</option>";
                                                            echo "<option value=\"6\">".$htmlAnimaux."</option>";
                                                            echo "<option value=\"1\">".$htmlFruit."</option>";
                                                            echo "<option value=\"3\">".$htmlGraine."</option>";
                                                            echo "<option value=\"7\">".$htmlPlanche."</option>";
                                                            echo "<option value=\"4\">".$htmlViande."</option>";
                                                            echo "<option value=\"5\">".$htmlVin."</option>";
                                                            break;
                                                        case 3:
                                                            echo "<option value=\"3\">".$htmlGraine."</option>";
                                                            echo "<option value=\"6\">".$htmlAnimaux."</option>";
                                                            echo "<option value=\"1\">".$htmlFruit."</option>";
                                                            echo "<option value=\"2\">".$htmlLégume."</option>";
                                                            echo "<option value=\"7\">".$htmlPlanche."</option>";
                                                            echo "<option value=\"4\">".$htmlViande."</option>";
                                                            echo "<option value=\"5\">".$htmlVin."</option>";
                                                            break;
                                                        case 4:
                                                            echo "<option value=\"4\">".$htmlViande."</option>";
                                                            echo "<option value=\"6\">".$htmlAnimaux."</option>";
                                                            echo "<option value=\"1\">".$htmlFruit."</option>";
                                                            echo "<option value=\"3\">".$htmlGraine."</option>";
                                                            echo "<option value=\"2\">".$htmlLégume."</option>";
                                                            echo "<option value=\"7\">".$htmlPlanche."</option>";
                                                            echo "<option value=\"5\">".$htmlVin."</option>";
                                                            break;
                                                        case 5:
                                                            echo "<option value=\"5\">".$htmlVin."</option>";
                                                            echo "<option value=\"6\">".$htmlAnimaux."</option>";
                                                            echo "<option value=\"1\">".$htmlFruit."</option>";
                                                            echo "<option value=\"3\">".$htmlGraine."</option>";
                                                            echo "<option value=\"2\">".$htmlLégume."</option>";
                                                            echo "<option value=\"7\">".$htmlPlanche."</option>";
                                                            echo "<option value=\"4\">".$htmlViande."</option>";
                                                            break;
                                                        case 6:
                                                            echo "<option value=\"6\">".$htmlAnimaux."</option>";
                                                            echo "<option value=\"1\">".$htmlFruit."</option>";
                                                            echo "<option value=\"3\">".$htmlGraine."</option>";
                                                            echo "<option value=\"2\">".$htmlLégume."</option>";
                                                            echo "<option value=\"7\">".$htmlPlanche."</option>";
                                                            echo "<option value=\"4\">".$htmlViande."</option>";
                                                            echo "<option value=\"5\">".$htmlVin."</option>";
                                                            break;
                                                        case 7:
                                                            echo "<option value=\"7\">".$htmlPlanche."</option>";
                                                            echo "<option value=\"6\">".$htmlAnimaux."</option>";
                                                            echo "<option value=\"1\">".$htmlFruit."</option>";
                                                            echo "<option value=\"3\">".$htmlGraine."</option>";
                                                            echo "<option value=\"2\">".$htmlLégume."</option>";
                                                            echo "<option value=\"4\">".$htmlViande."</option>";
                                                            echo "<option value=\"5\">".$htmlVin."</option>";
                                                            break;
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label"><?php echo $htmlPrix?></label>
                                                <div class="input-group">
                                                    <input step="0.01" type="number" class="form-control" min="0" name="prix" value="<?php echo $Prix_Produit_Unitaire?>" required
                                                           oninput="this.value = parseFloat(this.value).toFixed(2)"
                                                           onchange="this.value = parseFloat(this.value).toFixed(2)"
                                                    >
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Unité :</label>
                                                <div class="btn-group w-100" role="group">
                                                    <input type="radio" class="btn-check" name="unitPrix" id="unitPrix1" value="1" <?php if($Id_Unite_Prix==1) echo 'checked'; ?>>
                                                    <label class="btn btn-outline-success" for="unitPrix1"><?php echo $htmlLeKilo; ?></label>

                                                    <input type="radio" class="btn-check" name="unitPrix" id="unitPrix4" value="4" <?php if($Id_Unite_Prix==4) echo 'checked'; ?>>
                                                    <label class="btn btn-outline-success" for="unitPrix4"><?php echo $htmlLaPiece; ?></label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Stock</label>
                                                <input type="number" class="form-control" min="0" step="1" name="quantite" value="<?php echo $Qte_Produit?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Unité :</label>
                                                <div class="btn-group w-100" role="group">
                                                    <input type="radio" class="btn-check" name="unitQuantite" id="unitStock1" value="1" <?php if($Id_Unite_Stock==1) echo 'checked'; ?>>
                                                    <label class="btn btn-outline-success" for="unitStock1"><?php echo $htmlKg; ?></label>

                                                    <input type="radio" class="btn-check" name="unitQuantite" id="unitStock2" value="2" <?php if($Id_Unite_Stock==2) echo 'checked'; ?>>
                                                    <label class="btn btn-outline-success" for="unitStock2"><?php echo $htmlL; ?></label>

                                                    <input type="radio" class="btn-check" name="unitQuantite" id="unitStock3" value="3" <?php if($Id_Unite_Stock==3) echo 'checked'; ?>>
                                                    <label class="btn btn-outline-success" for="unitStock3"><?php echo $htmlM2; ?></label>

                                                    <input type="radio" class="btn-check" name="unitQuantite" id="unitStock4" value="4" <?php if($Id_Unite_Stock==4) echo 'checked'; ?>>
                                                    <label class="btn btn-outline-success" for="unitStock4"><?php echo $htmlPiece; ?></label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Image :</label>
                                                <input class="form-control" type="file" name="image" accept=".png">
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-success"><?php echo $htmlConfirmerModifProd?></button>
                                                <a href="produits.php" class="btn btn-outline-secondary"><?php echo $htmlAnnulerModifProd?></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-center"><?php echo $htmlMesProduitsEnStock?></h3>
                            <div class="row g-3">
                                <?php
                                $returnQueryIdProd = $db->select('SELECT Id_Prod FROM PRODUCTEUR WHERE Id_Uti = :utilisateur', [':utilisateur' => $utilisateur]);
                                $Id_Prod = $returnQueryIdProd[0]["Id_Prod"];

                                $returnQueryGetProducts = $db->select('SELECT Id_Produit, Nom_Produit, Desc_Type_Produit, Prix_Produit_Unitaire, Nom_Unite_Prix, Qte_Produit, Nom_Unite_Stock FROM Produits_d_un_producteur WHERE Id_Prod = :idProd', [':idProd' => $Id_Prod]);

                                if(count($returnQueryGetProducts)==0){
                                    echo "<p class='text-center'>" . $htmlAucunProduitEnStock . "</p>";
                                } else {
                                    foreach ($returnQueryGetProducts as $produit) {
                                        if ($produit["Qte_Produit"] > 0) {
                                            ?>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="card h-100">
                                                    <div class="card-header bg-light">
                                                        <h5 class="card-title mb-0"><?php echo $produit["Nom_Produit"] ?></h5>
                                                    </div>
                                                    <img src="img_produit/<?php echo $produit["Id_Produit"] ?>.png" class="card-img-top object-fit-cover" style="height: 200px;" alt="<?php echo $htmlImageNonFournie ?>">
                                                    <div class="card-body">
                                                        <p class="card-text"><i class="bi bi-box-seam-fill text-success me-2"></i><?php echo $produit["Desc_Type_Produit"] ?></p>
                                                        <p class="card-text"><i class="bi bi-tag-fill text-success me-2"></i><?php echo $produit["Prix_Produit_Unitaire"] ?> €/<?php echo $produit["Nom_Unite_Prix"] ?></p>
                                                        <p class="card-text"><i class="bi bi-archive-fill text-success me-2"></i><?php echo $htmlStockDeuxPoints . $produit["Qte_Produit"] . " " . $produit["Nom_Unite_Stock"] ?></p>
                                                    </div>
                                                    <div class="card-footer d-flex justify-content-between">
                                                        <?php if ($produit["Id_Produit"] == $Id_Produit_Update): ?>
                                                            <button class="btn btn-success" disabled><?php echo $htmlModification ?></button>
                                                        <?php else: ?>
                                                            <form action="product_modification.php" method="post">
                                                                <input type="hidden" name="modifyIdProduct" value="<?php echo $produit["Id_Produit"] ?>">
                                                                <button type="submit" class="btn btn-outline-success"><?php echo $htmlModifier ?></button>
                                                            </form>
                                                        <?php endif; ?>

                                                        <form action="delete_product.php" method="post">
                                                            <input type="hidden" name="deleteIdProduct" value="<?php echo $produit["Id_Produit"] ?>">
                                                            <button type="submit" class="btn btn-outline-danger"><?php echo $htmlSupprimer ?></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
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
        <input type="submit" value="<?php echo $htmlSignalerDys ?>" class="lienPopup">
        <input type="hidden" name="popup" value="contact_admin">
    </form>
    <form method="post">
        <input type="submit" value="<?php echo $htmlCGU ?>" class="lienPopup">
        <input type="hidden" name="popup" value="cgu">
    </form>
</footer>

<?php require "popups/gestion_popups.php";?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require "language.php" ;
    require_once 'database/database.php';
    use database\database;

    $db = new database();
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

$utilisateur = $_SESSION["Id_Uti"];
$filtreCategorie = 0;
if (isset($_GET["categorie"])) {
    $filtreCategorie = $_GET["categorie"];
}
?>

<main>
    <div class="row g-0">
        <div class="col-12 col-md-3 col-lg-2">
            <nav id="sidebar" class="h-100 flex-column align-items-stretch bg-success">
                <img class="logo d-none d-md-block" href="index.php" src="img/logo.png">
                <div class="container-fluid">
                    <div class="d-flex flex-column g-3 py-2">
                        <p class="text-light"><?php echo $htmlFiltrerParDeuxPoints; ?></p>
                        <form method="get" action="delivery.php" class="d-flex flex-column gap-3">
                            <div class="input-group">
                                <label class="input-group-text" for="categories"><i class="bi bi-funnel-fill text-success"></i></label>
                                <select class="form-select" name="categorie" id="categories">
                                    <option value="0" <?php if($filtreCategorie==0) echo 'selected="selected"';?>><?php echo $htmlTOUT; ?></option>
                                    <option value="1" <?php if($filtreCategorie==1) echo 'selected="selected"';?>><?php echo $htmlENCOURS; ?></option>
                                    <option value="2" <?php if($filtreCategorie==2) echo 'selected="selected"';?>><?php echo $htmlPRETE; ?></option>
                                    <option value="4" <?php if($filtreCategorie==4) echo 'selected="selected"';?>><?php echo $htmlLIVREE; ?></option>
                                    <option value="3" <?php if($filtreCategorie==3) echo 'selected="selected"';?>><?php echo $htmlANNULEE; ?></option>
                                </select>
                            </div>
                            <input class="btn btn-light" type="submit" value="<?php echo $htmlFiltrer; ?>">
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php"; ?>
            <div class="container-fluid my-3">
                <div class="d-flex flex-column">
                    <h1><?php echo $htmlCommandes; ?></h1>
                    <div class="row g-3">
                        <?php
                        if ($filtreCategorie != 0) {
                            $returnQueryGetCommande = $db->select('SELECT Desc_Statut, Id_Commande, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut
                                FROM COMMANDE 
                                INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod 
                                INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut 
                                INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti 
                                WHERE info_producteur.Id_Uti = :utilisateur AND COMMANDE.Id_Statut = :filtreCategorie',
                                ['utilisateur' => $utilisateur, 'filtreCategorie' => $filtreCategorie]);
                        } else {
                            $returnQueryGetCommande = $db->select('
                            SELECT Desc_Statut, Id_Commande, COMMANDE.Id_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti, COMMANDE.Id_Statut
                            FROM COMMANDE
                            INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod 
                            INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut 
                            INNER JOIN UTILISATEUR ON COMMANDE.Id_Uti=UTILISATEUR.Id_Uti 
                            WHERE info_producteur.Id_Uti = :utilisateur',
                                ['utilisateur' => $utilisateur]);
                        }

                        if(count($returnQueryGetCommande) == 0) {
                            echo '<p class="text-center">' . $htmlAucuneCommande . '</p>';
                        } else {
                            foreach ($returnQueryGetCommande as $commande) {
                                $Id_Commande = $commande["Id_Commande"];
                                $Desc_Statut = mb_strtoupper($commande["Desc_Statut"]);
                                $Nom_Client = mb_strtoupper($commande["Nom_Uti"]);
                                $Prenom_Client = $commande["Prenom_Uti"];
                                $Id_Statut = $commande["Id_Statut"];
                                $Id_Uti = $commande["Id_Uti"];

                                $total = 0;

                                $returnQueryGetProduitCommande = $db->select('
                                SELECT Nom_Produit, Qte_Produit_Commande, Prix_Produit_Unitaire, Nom_Unite_Prix
                                FROM produits_commandes 
                                WHERE Id_Commande = :idCommande',
                                    ['idCommande' => $Id_Commande]);

                                $nbProduit = count($returnQueryGetProduitCommande);

                                if ($nbProduit > 0) {
                                    ?>
                                    <div class="col-12 col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Commande de ' . $Prenom_Client . ' ' . $Nom_Client; ?></h5>
                                                <p class="card-text"><span class="badge rounded-pill text-bg-<?php
                                                    if($Id_Statut == 1) echo 'primary';
                                                    elseif($Id_Statut == 2) echo 'warning';
                                                    elseif($Id_Statut == 3) echo 'danger';
                                                    elseif($Id_Statut == 4) echo 'success';
                                                    ?>"><?php echo $Desc_Statut; ?></span></p>

                                                <?php if (($Id_Statut != 4) && ($Id_Statut != 3)) { ?>
                                                    <form action="change_status_commande.php" method="post" class="mb-3">
                                                        <div class="input-group">
                                                            <select name="categorie" class="form-select">
                                                                <option value=""><?php echo $htmlModifierStatut; ?></option>
                                                                <option value="1"><?php echo $htmlENCOURS; ?></option>
                                                                <option value="2"><?php echo $htmlPRETE; ?></option>
                                                                <option value="3"><?php echo $htmlANNULEE; ?></option>
                                                                <option value="4"><?php echo $htmlLIVREE; ?></option>
                                                            </select>
                                                            <input type="hidden" name="idCommande" value="<?php echo $Id_Commande?>">
                                                            <button type="submit" class="btn btn-success"><?php echo $htmlConfirmer; ?></button>
                                                        </div>
                                                    </form>
                                                <?php } ?>

                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Produit</th>
                                                        <th scope="col">Quantité</th>
                                                        <th scope="col">Prix</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($returnQueryGetProduitCommande as $produit) {
                                                        $Nom_Produit = $produit["Nom_Produit"];
                                                        $Qte_Produit_Commande = $produit["Qte_Produit_Commande"];
                                                        $Prix_Produit_Unitaire = $produit["Prix_Produit_Unitaire"];
                                                        $Nom_Unite_Prix = $produit["Nom_Unite_Prix"];
                                                        $total += $Prix_Produit_Unitaire * $Qte_Produit_Commande;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $Nom_Produit; ?></td>
                                                            <td><?php echo $Qte_Produit_Commande . ' ' . $Nom_Unite_Prix; ?></td>
                                                            <td><?php echo number_format($Prix_Produit_Unitaire * $Qte_Produit_Commande, 2, ',', ' ') . ' €'; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td><strong>Total</strong></td>
                                                        <td></td>
                                                        <td><strong><?php echo number_format($total, 2, ',', ' ') . ' €'; ?></strong></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="d-flex gap-2">
                                                    <input type="button" class="btn btn-outline-success" onclick="window.location.href='messagerie.php?Id_Interlocuteur=<?php echo $Id_Uti; ?>'" value="<?php echo $htmlEnvoyerMessage; ?>">
                                                    <form action="download_pdf.php" method="post">
                                                        <input type="hidden" name="idCommande" value="<?php echo $Id_Commande?>">
                                                        <button type="submit" class="btn btn-outline-primary"><?php echo $htmlGenererPDF; ?></button>
                                                    </form>
                                                </div>
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
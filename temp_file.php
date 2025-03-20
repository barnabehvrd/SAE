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
                <div class="container-fluid">
                    <div class="d-flex flex-column g-3 py-2">
                        <p class="text-light"><?php echo $htmlRechercherPar?></p>
                        <form method="get" action="index.php" class="d-flex flex-column gap-3">
                            <div class="input-group">
                                <label class="input-group-text" for="categories"><i class="bi bi-person-fill text-success"></i></label>
                                <select class="form-select" name="categorie" id="categories">
                                    <option value="Tout" <?php if($_GET["categorie"]=="Tout") echo 'selected="selected"';?>><?php echo ucfirst(strtolower($htmlTOUT)) ?></option>
                                    <option value="Agriculteur" <?php if($_GET["categorie"]=="Agriculteur") echo 'selected="selected"';?>><?php echo ucfirst(strtolower($htmlENCOURS)) ?></option>
                                    <option value="Vigneron" <?php if($_GET["categorie"]=="Vigneron") echo 'selected="selected"';?>><?php echo ucfirst(strtolower($htmlPRETE)) ?></option>
                                    <option value="Maraîcher" <?php if($_GET["categorie"]=="Maraîcher") echo 'selected="selected"';?>><?php echo ucfirst(strtolower($htmlLIVREE))?></option>
                                </select>
                            </div>

                            <input class="btn btn-light" type="submit" value="<?php echo $htmlFiltrer?>">
                        </form>
                    </div>
            </nav>
        </div>
        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php";?>
            <div class="container-fluid my-3">
                <!-- code -->

                <?php
                $query='SELECT PRODUCTEUR.Id_Uti, Desc_Statut, Id_Commande, Nom_Uti, Prenom_Uti, Adr_Uti, COMMANDE.Id_Statut FROM COMMANDE INNER JOIN PRODUCTEUR ON COMMANDE.Id_Prod=PRODUCTEUR.Id_Prod INNER JOIN info_producteur ON COMMANDE.Id_Prod=info_producteur.Id_Prod INNER JOIN STATUT ON COMMANDE.Id_Statut=STATUT.Id_Statut WHERE COMMANDE.Id_Uti= :utilisateur';
                if ($filtreCategorie!=0){
                    $query=$query.' AND COMMANDE.Id_Statut= :filtreCategorie ;';

                    $returnQueryGetCommande = $db->select($query, [
                        'utilisateur' => $utilisateur,
                        'filtreCategorie' => $filtreCategorie
                    ]);

                } else {
                    $returnQueryGetCommande = $db->select($query, [
                        'utilisateur' => $utilisateur
                    ]);
                }

                $iterateurCommande=0;
                if(count($returnQueryGetCommande)==0 and ($filtreCategorie==0)){
                echo $htmlAucuneCommande;
                ?>
                <br>
                <input type="button" onclick="window.location.href='index.php'" value="<?php echo $htmlDecouverteProducteurs; ?>">
                <?php
                }
                elseif(count($returnQueryGetCommande)==0){
                    echo $htmlAucuneCommandeCorrespondCriteres;
                }
                else{
                    while ($iterateurCommande<count($returnQueryGetCommande)){
						$Id_Commande = $returnQueryGetCommande[$iterateurCommande]["Id_Commande"];
						$Nom_Prod = $returnQueryGetCommande[$iterateurCommande]["Nom_Uti"];
						$Nom_Prod = mb_strtoupper($Nom_Prod);
						$Prenom_Prod = $returnQueryGetCommande[$iterateurCommande]["Prenom_Uti"];
						$Adr_Uti = $returnQueryGetCommande[$iterateurCommande]["Adr_Uti"];
						$Desc_Statut = $returnQueryGetCommande[$iterateurCommande]["Desc_Statut"];
						$Desc_Statut = mb_strtoupper($Desc_Statut);
						$Id_Statut = $returnQueryGetCommande[$iterateurCommande]["Id_Statut"];
                        $idUti = $returnQueryGetCommande[$iterateurCommande]["Id_Uti"];

                        $total=0;

                        $returnQueryGetProduitCommande = $db->select('SELECT Nom_Produit, Qte_Produit_Commande, Prix_Produit_Unitaire, Nom_Unite_Prix FROM produits_commandes  WHERE Id_Commande = :Id_Commande', [
                            'Id_Commande' => $Id_Commande
                        ]);

						$iterateurProduit=0;
						$nbProduit=count($returnQueryGetProduitCommande);

						if ($nbProduit>0 ){ ?>

                            <

                <?php
						} ?>



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
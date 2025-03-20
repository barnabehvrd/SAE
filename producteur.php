<?php
  require "language.php" ; 

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
      // variable utilisée plusieurs fois par la suite
      $Id_Prod = $_GET["Id_Prod"];
      // id_prod to int

      $filtreType = "";
      if (isset($_GET["filtreType"])){

          $filtreType=$_GET["filtreType"];
      }
      else{
        $filtreType="TOUT";
      }

      $tri = "";
      if (isset($_GET["tri"])==true){
        $tri=$_GET["tri"];
      }
      else{
        $tri="No";
      }
      if (isset($_GET["rechercheNom"])==true){
        $rechercheNom=$_GET["rechercheNom"];
      }
      else{
        $rechercheNom="";
      }
    ?>
    <?php
        $db->select("SELECT 1");
            $query = 'SELECT Id_Produit, Id_Prod, Nom_Produit, Desc_Type_Produit, Prix_Produit_Unitaire, Nom_Unite_Prix, Qte_Produit FROM Produits_d_un_producteur WHERE Id_Prod= :idprod AND Desc_Type_Produit LIKE :filtreType AND Nom_Produit LIKE :rechercheNom';

        //tri
        if ($tri=="No"){
            $query=$query.';';
        }
        else if ($tri=="PrixAsc"){
            $query=$query.' ORDER BY Prix_Produit_Unitaire ASC;';
        }
        else if ($tri=="PrixDesc"){
            $query=$query.' ORDER BY Prix_Produit_Unitaire DESC;';
        }
        else if ($tri=="Alpha"){
            $query=$query.' ORDER BY Nom_Produit ASC;';
        }
        else if ($tri=="AntiAlpha"){
            $query=$query.' ORDER BY Nom_Produit DESC;';
        }

            if ($filtreType=="TOUT"){
            $returnQueryGetProducts=$db->select($query, [
                ':rechercheNom' =>'%'.$rechercheNom.'%',
                ':filtreType' => '%',
                ':idprod' => $Id_Prod,

            ]);

        }
        else {
            $returnQueryGetProducts=$db->select($query, [
                ':filtreType' => $filtreType,
                ':rechercheNom' =>'%'.$rechercheNom.'%',
                ':idprod' => $Id_Prod
            ]);
        }

        $db->select("SELECT 2");
    ?>
    <main>
        <div class="row g-0">
        
        <div class="col-12 col-md-3 col-lg-2">
            <nav id="sidebar" class="h-100 flex-column align-items-stretch bg-success">
                <img class="logo d-none d-md-block" href="index.php" src="img/logo.png">
                    <!-- code -->
                    <div class="container-fluid">
                        <div class="d-flex flex-column g-3 py-2">
                            <p class="text-light"><?php echo $htmlRechercherPar?></p>
                            <form method="get" class="d-flex flex-column gap-3">
                                <input type="hidden" name="Id_Prod" value="<?php echo $Id_Prod?>">
                                <input type="text" class="form-control" name="rechercheNom" value="<?php echo $rechercheNom?>" placeholder="<?php echo $htmlNom; ?>">

                                <div class="input-group">
                                    <label class="input-group-text" for="categories"><i class="bi bi-box-seam-fill text-success me-2"></i></label>
                                    <select class="form-select" name="filtreType" id="categories">
                                        <option value="TOUT" <?php if($filtreType=="TOUT") echo 'selected="selected"';?>><?php echo $htmlTout?></option>
                                        <option value="ANIMAUX" <?php if($filtreType=="ANIMAUX") echo 'selected="selected"';?>><?php echo $htmlAnimaux?></option>
                                        <option value="FRUITS" <?php if($filtreType=="FRUITS") echo 'selected="selected"';?>><?php echo $htmlFruits?></option>
                                        <option value="GRAINS" <?php if($filtreType=="GRAINS") echo 'selected="selected"';?>><?php echo $htmlGraines?></option>
                                        <option value="LÉGUMES" <?php if($filtreType=="LÉGUMES") echo 'selected="selected"';?>><?php echo $htmlLégumes?></option>
                                        <option value="PLANCHES" <?php if($filtreType=="PLANCHES") echo 'selected="selected"';?>><?php echo $htmlPlanches?></option>
                                        <option value="VIANDE" <?php if($filtreType=="VIANDE") echo 'selected="selected"';?>><?php echo $htmlViande?></option>
                                        <option value="VIN" <?php if($filtreType=="VIN") echo 'selected="selected"';?>><?php echo $htmlVin?></option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="input-group-text"><i class="bi bi-funnel-fill text-success"></i></label>
                                    <select name="tri" class="form-select" required>
                                        <option value="No" <?php if($tri=="No") echo 'selected="selected"';?>><?php echo $htmlAucunTri; ?></option>
                                        <option value="PrixAsc" <?php if($tri=="PrixAsc") echo 'selected="selected"';?>><?php echo $htmlPrixCroissant; ?></option>
                                        <option value="PrixDesc" <?php if($tri=="PrixDesc") echo 'selected="selected"';?>><?php echo $htmlPrixDecroissant; ?></option>
                                        <option value="Alpha" <?php if($tri=="Alpha") echo 'selected="selected"';?>><?php echo $htmlOrdreAlpha; ?></option>
                                        <option value="AntiAlpha" <?php if($tri=="AntiAlpha") echo 'selected="selected"';?>><?php echo $htmlOrdreAntiAlpha; ?></option>
                                    </select>
                                </div>

                                <input class="btn btn-light" type="submit" value="<?php echo $htmlRechercher?>">
                            </form>
                        </div>
                    </div>
            </nav>
        </div>
        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php";?>
            <div class="container-fluid my-3">
                
            <form method="get" action="insert_commande.php">
                <input type="hidden" name="Id_Prod" value="<?php echo $Id_Prod?>">

                <!-- exemple de page producteur -->
                 <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4 order-md-2">
                        <div class="d-flex flex-column bg-light rounded p-3 gap-2">
                            <?php 
                                $returnQueryInfoProd = $db->select('SELECT UTILISATEUR.Id_Uti, UTILISATEUR.Adr_Uti, Prenom_Uti, Nom_Uti, Prof_Prod FROM UTILISATEUR INNER JOIN PRODUCTEUR ON UTILISATEUR.Id_Uti = PRODUCTEUR.Id_Uti WHERE PRODUCTEUR.Id_Prod= :Id_Prod ;', [':Id_Prod' => $Id_Prod]); 
                                // recupération des paramètres de la requête qui contient 1 élément
                                $idUti = $returnQueryInfoProd[0]["Id_Uti"];
                                $address = $returnQueryInfoProd[0]["Adr_Uti"];
                                $nom = $returnQueryInfoProd[0]["Nom_Uti"];
                                $prenom = $returnQueryInfoProd[0]["Prenom_Uti"];
                                $profession = $returnQueryInfoProd[0]["Prof_Prod"];
                            ?>
                            <img src="img_producteur/<?php echo $idUti ?>.png" class="w-100" alt="">
                            <h1><?php echo $prenom.' '.mb_strtoupper($nom) ?></h1>
                            <span class="badge rounded-pill text-bg-success"><?php echo $profession ?></span>
                            <p><i class="bi bi-geo-alt-fill text-success me-2"></i><?php echo $address ?></p>
                            <iframe class="map-frame" src="https://maps.google.com/maps?&q=<?php echo $address ?>&output=embed" width="100%" height="100%">
                            </iframe>
                            <?php if(isset($returnQueryGetProducts)): ?>
                                <?php if (sizeof($returnQueryGetProducts)>0 and isset($_SESSION["Id_Uti"]) and $idUti!=$_SESSION["Id_Uti"]): ?>
                                    <input type="button" class="btn btn-outline-success" onclick="window.location.href='messagerie.php?Id_Interlocuteur=<?php echo $idUti ?>'" value="<?php echo $htmlEnvoyerMessage; ?>">
                                    <input type="hidden" name="Id_Prod" value="<?php echo $idUti ?>">
                                    <input type="submit" class="btn btn-success"><?php echo $htmlPasserCommande; ?></input>
                                    
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="d-flex flex-column">
                            <h2><?php echo $htmlProduitsProposesDeuxPoints; ?></h2>
                            
                            <?php if (isset($returnQueryGetProducts) && count($returnQueryGetProducts) > 0): ?>
                                <div class="row g-3">
                                    <?php foreach ($returnQueryGetProducts as $produit): ?>
                                        <div class="col-12 col-lg-6 col-xl-4">
                                            <div class="card h-100">
                                                <img src="img_produit/<?php echo $produit["Id_Produit"] ?>.png" class="card-img-top object-fit-cover" style="height: 25vh; min-height: 250px;" alt="image produit">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $produit["Nom_Produit"] ?></h5>
                                                    <p class="card-text"><i class="bi bi-box-seam-fill text-success me-2"></i><?php echo $produit["Desc_Type_Produit"] ?></p>
                                                    <p class="card-text"><i class="bi bi-tag-fill text-success me-2"></i><?php echo $produit["Prix_Produit_Unitaire"] ?> €/Kg</p>
                                                    
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-basket2-fill text-success"></i></span>
                                                        <input type="number" name="<?php echo $produit['Id_Produit'] ?>" placeholder="max : <?php echo $produit["Qte_Produit"] ?>" min="1" max="<?php echo $produit["Qte_Produit"] ?>" class="form-control" <?php if($produit["Qte_Produit"]==0) echo 'disabled'; ?> >
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                    <p><?php echo $htmlAucunProduitEnStock; ?></p>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                 </div>
            </form>     
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
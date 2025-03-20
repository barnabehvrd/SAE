<?php
if(!isset($_SESSION)){
    session_start();
}
    require "language.php" ;
    require_once 'database/database.php';
    use database\database;

    $db = new database();

    $recherche = "";
    if (isset($_GET['recherche'])) {
        $recherche = $_GET['recherche'];
    }

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
                <form method="get" action="panel_admin.php">
                    <!-- Recherche -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="button-addon2" value="<?php echo $recherche ?>" name="recherche">
                        <button class="btn btn-outline-light" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                </form>
            </nav>
        </div>
        <div class="col-12 col-md-9 col-lg-10">
            <?php require "nav.php";?>
            <div class="container-fluid my-3">
                <!-- code -->

                <div class="d-flex flex-column">
                    <h2 class="text-center">Producteurs :</h2>
                    <div class="row g-3">

                            <?php
                            // On remplace les espaces par des % pour la recherche
                            $searchString = '%' . str_replace(' ', '%', $recherche) . '%';

                            $result = $db->select('SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti AND (CONCAT(UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti) LIKE :search OR CONCAT(UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti) LIKE :search);',
                                ['search' => $searchString]);

                            if ((count($result)> 0) AND ($_SESSION["isAdmin"]==true)) {
                                foreach ($result as $row) {
                                ?>
                                    <div class="col-12 col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h2 class="card-title"><?php  echo $row['Prenom_Uti'] . ' ' . $row['Nom_Uti'] ?></h2>
                                                <span class="badge rounded-pill text-bg-success mb-3"><?php echo $row['Prof_Prod'] ?> </span>
                                                <p class="card-text"><i class="bi bi-at text-success me-2"></i><?php echo $row['Mail_Uti'] ?></p>
                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-success me-2"></i><?php echo $row['Adr_Uti'] ?></p>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-delete-user-<?php echo $row["Id_Uti"] ?>">
                                                      Supprimer le compte
                                                    </button> <br>

                                                    <!-- Modal -->
                                                   <div class="modal fade" id="modal-delete-user-<?php echo $row["Id_Uti"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                 <div class="modal-header">
                                                                       <h1 class="modal-title fs-5" id="exampleModalLabel">Supression</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                      </div>
                                                                  <div class="modal-body">
                                                                        Voulez-vous vraiment supprimer le compte de <?php echo $row["Prenom_Uti"] . ' ' . $row["Nom_Uti"] ?> ?
                                                                      </div>
                                                                  <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                        <form method="post" action="traitements/del_acc.php">
                                                                                <input class="btn btn-danger" type="submit" name="submit" id="submit" value="<?php echo $htmlSupprimerCompte ?>"><br>
                                                                                <input type="hidden" name="Id_Uti" value="<?php echo $row["Id_Uti"]?>">
                                                                            </form>
                                                                      </div>
                                                                </div>
                                                          </div>
                                                    </div>
                                                <!-- Fin du Modal -->

                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            } elseif ($recherche != "") {
                                echo "<p class='text-center'>Aucun résultat n'a été trouvé</p>";
                            }
                            ?>
                    </div>
                </div>


                <!-- Utilisateurs -->
                <div class="d-flex flex-column mt-5">
                    <h2 class="text-center"> Utilisateurs :</h2>
                    <div class="row g-3">

                        <?php

                        $result = $db->select('SELECT UTILISATEUR.Id_Uti, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM UTILISATEUR WHERE UTILISATEUR.Id_Uti  NOT IN (SELECT PRODUCTEUR.Id_Uti FROM PRODUCTEUR) AND UTILISATEUR.Id_Uti NOT IN (SELECT ADMINISTRATEUR.Id_Uti FROM ADMINISTRATEUR) AND UTILISATEUR.Id_Uti<>0 AND (CONCAT(UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti) LIKE :search OR CONCAT(UTILISATEUR.Nom_Uti, UTILISATEUR.Prenom_Uti) LIKE :search);',
                            ['search' => $searchString]);

                        if ((count($result)> 0) AND ($_SESSION["isAdmin"]==true)) {
                            foreach ($result as $row) {
                                ?>
                                <div class="col-12 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title"><?php  echo $row['Prenom_Uti'] . ' ' . $row['Nom_Uti'] ?></h3>
                                            <p class="card-text"><i class="bi bi-at text-success me-2"></i><?php echo $row['Mail_Uti'] ?></p>
                                            <p class="card-text"><i class="bi bi-geo-alt-fill text-success me-2"></i><?php echo $row['Adr_Uti'] ?></p>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-delete-user-<?php echo $row["Id_Uti"] ?>">
                                                Supprimer le compte
                                            </button> <br>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-delete-user-<?php echo $row["Id_Uti"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Supression</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez-vous vraiment supprimer le compte de <?php echo $row["Prenom_Uti"] . ' ' . $row["Nom_Uti"] ?> ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <form method="post" action="traitements/del_acc.php">
                                                                <input class="btn btn-danger" type="submit" name="submit" id="submit" value="<?php echo $htmlSupprimerCompte ?>"><br>
                                                                <input type="hidden" name="Id_Uti" value="<?php echo $row["Id_Uti"]?>">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fin du Modal -->

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } elseif ($recherche != "") {
                            echo "<p class='text-center'>Aucun résultat n'a été trouvé</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Fin de la page liste producteurs -->


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
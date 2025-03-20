<?php
if(!isset($_SESSION)){
    session_start();
}
    require "language.php" ;
    require_once 'database/database.php';
    use database\database;

    $db = new database();

?>


<!--    --><?php
//    if(!isset($_SESSION)){
//        session_start();
//        }
//
//
//        $utilisateur=htmlspecialchars($_SESSION["Id_Uti"]);
//
//        $filtreCategorie=0;
//        if (isset($_POST["typeCategorie"])==true){
//            $filtreCategorie=htmlspecialchars($_POST["typeCategorie"]);
//        }
//
//    ?>
<!---->
<!--            <div class="gallery-container">-->
<!--                        --><?php
//                            $result = $db->select('SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti');
//
//                            if ((count($result)> 0) AND ($_SESSION["isAdmin"]==true)) {
//
//                                echo '<h2 class="text-center"> Producteurs : </h2>';
//
//
//                                foreach ($result as $row) {
//                                    echo '<div class="squarePanelAdmin">';
//                                    echo $htmlNomDeuxPoints, $row["Nom_Uti"] . "<br>";
//                                    echo $htmlPrénomDeuxPoints, $row["Prenom_Uti"] . "<br>";
//                                    echo $htmlMailDeuxPoints, $row["Mail_Uti"] . "<br>";
//                                    echo $htmlAdresseDeuxPoints, $row["Adr_Uti"] . "<br>";
//                                    echo $htmlProfessionDeuxPoints, $row["Prof_Prod"] . "<br></form>";
//
//                                    echo '
//                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-delete-user-'.$row["Id_Uti"].'">
//                                          Supprimer le compte
//                                        </button> <br>
//
//                                        <!-- Modal -->
//
//                                        <div class="modal fade" id="modal-delete-user-'.$row["Id_Uti"].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
//                                          <div class="modal-dialog">
//                                            <div class="modal-content">
//                                              <div class="modal-header">
//                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Supression</h1>
//                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                                              </div>
//                                              <div class="modal-body">
//                                                Voulez-vous vraiment supprimer le compte de '.$row["Prenom_Uti"].' '.$row["Nom_Uti"].' ?
//                                              </div>
//                                              <div class="modal-footer">
//                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuller</button>
//                                                <form method="post" action="traitements/del_acc.php">
//                                                    <input type="submit" name="submit" id="submit" value="'.$htmlSupprimerCompte.'"><br>
//                                                    <input type="hidden" name="Id_Uti" value="'.$row["Id_Uti"].'">
//                                                </form>
//                                              </div>
//                                            </div>
//                                          </div>
//                                        </div>
//
//                                        <!-- Fin du Modal -->
//                                    ';
//                                }
//                                echo '</div>';
//                            } else {
//                                echo $htmlErrorDevTeam;
//                            }
//                        ?>
<!--                <div class="gallery-container">-->
<!--                --><?php
//                    $result = $db->select('SELECT UTILISATEUR.Id_Uti, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM UTILISATEUR WHERE UTILISATEUR.Id_Uti  NOT IN (SELECT PRODUCTEUR.Id_Uti FROM PRODUCTEUR) AND UTILISATEUR.Id_Uti NOT IN (SELECT ADMINISTRATEUR.Id_Uti FROM ADMINISTRATEUR) AND UTILISATEUR.Id_Uti<>0;');
//
//                    if ((count($result) > 0) AND ($_SESSION["isAdmin"]==true)) {
//                        echo"<label>".$htmlUtilisateurs."</label><br>";
//
//                        foreach ($result as $row) {
//
//                            echo '<form method="post" action="traitements/del_acc.php" class="squarePanelAdmin">
//                                <input type="submit" name="submit" id="submit" value="Supprimer le compte"><br>
//                                <input type="hidden" name="Id_Uti" value="'.$row["Id_Uti"].'">';
//
//                            echo $htmlNomDeuxPoints, $row["Nom_Uti"] . "<br>";
//                            echo $htmlPrénomDeuxPoints, $row["Prenom_Uti"] . "<br>";
//                            echo $htmlMailDeuxPoints, $row["Mail_Uti"] . "<br>";
//                            echo $htmlAdresseDeuxPoints, $row["Adr_Uti"] . "<br></form>";
//                        }
//                        echo '</div>';
//                    } else {
//                        echo $htmlErrorDevTeam;
//                    }
//               ?>
<!--            <br>-->
<!--            <div class="basDePage">-->
<!--                <form method="post">-->
<!--						<input type="submit" value="--><?php //echo $htmlSignalerDys?><!--" class="lienPopup">-->
<!--                        <input type="hidden" name="popup" value="contact_admin">-->
<!--				</form>-->
<!--                <form method="post">-->
<!--						<input type="submit" value="--><?php //echo $htmlCGU?><!--" class="lienPopup">-->
<!--                        <input type="hidden" name="popup" value="cgu">-->
<!--				</form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    --><?php //require "popups/gestion_popups.php";?>
<!--            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>-->
<!--</body>-->
<!---->
<!--)-->


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

                <!-- Producteurs -->
                <div class="d-flex flex-column">
                    <h2 class="text-center"><?php Producteurs : ?></h2>
                    <div class="row g-3">

                            <?php
                            $result = $db->select('SELECT UTILISATEUR.Id_Uti, PRODUCTEUR.Prof_Prod, PRODUCTEUR.Id_Prod, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti');

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
                                                                                <input type="submit" name="submit" id="submit" value="<?php echo $htmlSupprimerCompte ?>"><br>
                                                                                <input class="btn btn-danger" type="hidden" name="Id_Uti" value="<?php echo $row["Id_Uti"]?>">
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
                            }
                            ?>
                    </div>
                </div>


                <!-- Utilisateurs -->
                <div class="d-flex flex-column">
                    <h2 class="text-center"><?php echo $htmlUtilisateurs?></h2>
                    <div class="row g-3">

                        <?php
                        $result = $db->select('SELECT UTILISATEUR.Id_Uti, UTILISATEUR.Prenom_Uti, UTILISATEUR.Nom_Uti, UTILISATEUR.Mail_Uti, UTILISATEUR.Adr_Uti FROM UTILISATEUR WHERE UTILISATEUR.Id_Uti  NOT IN (SELECT PRODUCTEUR.Id_Uti FROM PRODUCTEUR) AND UTILISATEUR.Id_Uti NOT IN (SELECT ADMINISTRATEUR.Id_Uti FROM ADMINISTRATEUR) AND UTILISATEUR.Id_Uti<>0;');

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
                                                                <input type="submit" name="submit" id="submit" value="<?php echo $htmlSupprimerCompte ?>"><br>
                                                                <input class="btn btn-danger" type="hidden" name="Id_Uti" value="<?php echo $row["Id_Uti"]?>">
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
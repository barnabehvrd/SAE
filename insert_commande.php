<?php
$test = $_GET;
$Id_Prod=$test["Id_Prod"];
unset($test["Id_Prod"]);

$i=1;
foreach ($test as $produit => $quantite) {
    echo $produit;
    echo ' => ';
    echo $quantite;
    echo '</br>';
}


//header('Location: commandes.php?Id_Prod=314');
?>
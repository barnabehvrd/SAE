<?php

/**
 * 
 * Exercice 1 : Liste de produits
 * 
 * Récupérer le fichier produits.json situé dans les ressources du TD4.
 * À travers une fonction, récupérez le fichier JSON et transformez-le en tableau PHP.
 * Formatez l’affichage sous forme d’un  tableau HTML qui affiche les données
 * Mettez en place un filtre de marque que l’on peut activer ou désactiver dans un paramètre d’URL
 * 
 * 
 */ 

 function getProduits() {
    $json = file_get_contents("produits.json");
    $produits = json_decode($json, true);
    return $produits;
}
$produits = getProduits();

if (isset($_GET["marque"])) {
    $produits = array_filter($produits, function ($produit) {
        return $produit["marque"] == $_GET["marque"];
    });
}
?>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Marque</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit) { ?>
            <tr>
                <td><?php echo $produit["titre"]; ?></td>
                <td><?php echo $produit["marque"]; ?></td>
                <td><?php echo $produit["prix"]; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
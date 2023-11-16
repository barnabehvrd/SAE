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

function get_produits(){
    $fichier = file_get_contents('ressources/products.json');
    $fichierParsed = json_decode($fichier,true);
    $produits = $fichierParsed['products'];
    return $produits;
}

function get_produits_filtered_by_brand($brand){
    $produits = get_produits();
    

    // Version 1
    /*
    //$produits_filtered = array();
    foreach($produits as $produit){
        if($produit['brand'] === $brand){
            $produits_filtered[] = $produit;
        }
    }
    return $produits_filtered;
    */

    // Version 2

    $array_filtered = array_filter($produits, function($produit) {
        return $produit['brand'] === $_GET['brand'];
    });
    
    return $array_filtered;
}

if(isset($_GET['brand'])){
    $produits = get_produits_filtered_by_brand($_GET['brand']);
}else{
    $produits = get_produits();
}

?>
<table>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Marque</th>
        <th>Prix</th>
    </tr>
    <?php foreach($produits as $produit){?>
        <tr>
            <td><?php echo $produit['title']; ?></td>
            <td><?php echo $produit['description']; ?></td>
            <td><?php echo $produit['brand']; ?></td>
            <td><?php echo $produit['price']; ?></td>
        </tr>
    <?php } ?>


</table>
<?php

/**
 * Fonction pour récupérer le fichier JSON et le transformer en tableau PHP
 *
 * @param string $fichier
 * @return array
 */function getProductsFromJson(string $fichier): array
{
    $products = file_get_contents($fichier);
    $products = json_decode($products, true);

    return $products;
}

// Récupérer le fichier JSON
$products = getProductsFromJson("products.json");

// Afficher les titres des produits
foreach ($products as $product) {
    if (array_key_exists("title", $product)) {
        echo $product["title"];
    }
}

$products = getProductsFromJson("products.json");

// Afficher les produits sous forme de tableau HTML
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <?php
    foreach ($products as $product) {
    if (array_key_exists("title", $product)) {
        echo $product["title"];
    }
}
    ?>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Prix</th>
                <th>Réduction</th>
                <th>Note</th>
                <th>Stock</th>
            </tr>
        </thead>

        
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product["title"]; ?></td>
                    <td><?php echo $product["price"]; ?></td>
                    <td><?php echo $product["discountPercentage"]; ?></td>
                    <td><?php echo $product["rating"]; ?></td>
                    <td><?php echo $product["stock"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
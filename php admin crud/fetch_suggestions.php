<?php
// Inclure le fichier de configuration de la base de données
@include 'config.php';

// Vérifier si la requête de recherche est définie et non vide
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Nettoyer et valider la requête de recherche
    $query = mysqli_real_escape_string($conn, $_GET['query']);

    // Exécuter la requête SQL pour sélectionner les produits correspondant à la requête de recherche
    $select = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$query%'");
    $products = [];

    // Vérifier si des produits correspondant à la recherche ont été trouvés
    if ($select) {
        // Parcourir les résultats de la requête et les stocker dans un tableau
        while ($row = mysqli_fetch_assoc($select)) {
            $products[] = $row;
        }

        // Si des produits correspondant à la recherche sont trouvés, générer les suggestions
        if (!empty($products)) {
            foreach ($products as $product) {
                // Appeler une fonction auxiliaire pour générer chaque élément de suggestion
                generateSuggestionItem($product);
            }
        } else {
            // Si aucun produit correspondant à la recherche n'est trouvé, afficher un message approprié
            echo '<div class="suggestion-item">No products found</div>';
        }
    } else {
        // Gestion des erreurs de requête SQL
        echo '<div class="suggestion-item">Error fetching products</div>';
    }
} else {
    // Si la requête de recherche est vide, afficher un message approprié
    echo '<div class="suggestion-item">Please enter a search query</div>';
}

// Fonction auxiliaire pour générer chaque élément de suggestion
function generateSuggestionItem($product) {
    echo '<div class="suggestion-item" data-product-id="' . $product['id'] . '">';
    echo '<img src="uploaded_img/' . (isset($product['image']) ? $product['image'] : 'default.jpg') . '" width="50" height="50" alt="' . (isset($product['name']) ? $product['name'] : 'Product Name') . '" />';
    echo '<div class="suggestion-details">';
    echo '<span class="suggestion-name">' . (isset($product['name']) ? $product['name'] : 'Product Name') . '</span>';
    echo '<span class="suggestion-price">$' . (isset($product['price']) ? $product['price'] : '0.00') . '</span>';
    if (isset($product['discount']) && $product['discount'] > 0) {
        echo '<span class="suggestion-discount">-' . $product['discount'] . '%</span>';
    }
    echo '<span class="suggestion-rating">Rating: ' . (isset($product['rating']) ? $product['rating'] : '0') . ' stars</span>';
    echo '</div>';
    echo '</div>';
}
?>

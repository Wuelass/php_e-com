<?php
require 'controllers/config.php'; // Connexion à la base de données

// Récupération de l'ID du produit depuis l'URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupération des détails du produit depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Produit non trouvé.";
    exit;
}
?>
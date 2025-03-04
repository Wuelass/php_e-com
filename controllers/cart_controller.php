<?php
require 'controllers/config.php'; // Connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour voir votre panier.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer l'ID du panier pour l'utilisateur
$stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$cart_id = $stmt->fetchColumn();

if (!$cart_id) {
    echo "Panier non trouvé pour cet utilisateur.";
    exit();
}

// Récupérer les produits dans le panier
$stmt = $pdo->prepare("SELECT p.product_name, p.image, ci.price_at_cart, ci.product_id, ci.quantity FROM cart_item ci JOIN product p ON ci.product_id = p.id WHERE ci.cart_id = :cart_id");
$stmt->execute(['cart_id' => $cart_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
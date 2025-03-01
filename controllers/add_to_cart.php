<?php
session_start();
require 'config.php'; // Fichier de connexion PDO

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);

    // Récupérer l'ID du panier pour l'utilisateur
    $stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $cart_id = $stmt->fetchColumn();

    if (!$cart_id) {
        echo "Panier non trouvé pour cet utilisateur.";
        exit();
    }

    // Récupérer le prix du produit
    $stmt = $pdo->prepare("SELECT price FROM product WHERE id = :product_id");
    $stmt->execute(['product_id' => $product_id]);
    $product_price = $stmt->fetchColumn();

    if (!$product_price) {
        echo "Produit non trouvé.";
        exit();
    }

    // Vérifier si le produit est déjà dans le panier
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cart_item WHERE cart_id = :cart_id AND product_id = :product_id");
    $stmt->execute(['cart_id' => $cart_id, 'product_id' => $product_id]);
    $productExists = $stmt->fetchColumn();

    if ($productExists) {
        echo "Le produit est déjà dans le panier.";
    } else {
        // Ajouter le produit au panier avec le prix
        $stmt = $pdo->prepare("INSERT INTO cart_item (cart_id, product_id, price_at_cart) VALUES (:cart_id, :product_id, :price_at_cart)");
        $stmt->execute(['cart_id' => $cart_id, 'product_id' => $product_id, 'price_at_cart' => $product_price]);

        if ($stmt) {
            header("Location: ../store.php"); // Redirige vers la page du panier
            exit();
        } else {
            echo "Erreur lors de l'ajout au panier.";
        }
    }
} else {
    echo "Vous devez être connecté pour ajouter un produit au panier.";
}
?>

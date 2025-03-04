<?php
session_start();
require 'config.php'; // Fichier de connexion PDO

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);
    $action = $_POST['action'];

    // Récupérer l'ID du panier pour l'utilisateur
    $stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $cart_id = $stmt->fetchColumn();

    if (!$cart_id) {
        echo "Panier non trouvé pour cet utilisateur.";
        exit();
    }

    // Récupérer la quantité actuelle du produit dans le panier
    $stmt = $pdo->prepare("SELECT quantity FROM cart_item WHERE cart_id = :cart_id AND product_id = :product_id");
    $stmt->execute(['cart_id' => $cart_id, 'product_id' => $product_id]);
    $quantity = $stmt->fetchColumn();

    if ($quantity === false) {
        echo "Produit non trouvé dans le panier.";
        exit();
    }

    if ($action == 'increase') {
        $quantity++;
    } elseif ($action == 'decrease' && $quantity > 1) {
        $quantity--;
    }

    // Mettre à jour la quantité du produit dans le panier
    $stmt = $pdo->prepare("UPDATE cart_item SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id");
    $stmt->execute(['quantity' => $quantity, 'cart_id' => $cart_id, 'product_id' => $product_id]);

    header("Location: ../cart.php"); // Redirige vers la page du panier
    exit();
} else {
    echo "Vous devez être connecté pour modifier votre panier.";
}
?>

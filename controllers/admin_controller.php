<?php
require 'config.php'; // Connexion à la base de données

// Ajout d'un produit
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO product (product_name, price, stock_quantity, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$product_name, $price, $stock_quantity, $description]);

    header("Location: admin_menu.php");
    exit();
}

// Suppression d'un produit
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM product WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin_menu.php");
    exit();
}

// Récupération des produits
$products = $pdo->query("SELECT * FROM product")->fetchAll(PDO::FETCH_ASSOC);
<?php
require 'config.php'; // Connexion à la base de données
require 'upload.php';

// Ajout d'un produit
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $description = $_POST['description'];

    // Upload de l'image
    $image_path = uploadImage($_FILES['image']);

    // Insérer dans la BDD uniquement si l'image est bien enregistrée
    if ($image_path) {
        $stmt = $pdo->prepare("INSERT INTO product (product_name, price, stock_quantity, description, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product_name, $price, $stock_quantity, $description, $image_path]);

        header("Location: admin_menu.php");
        exit();
    } else {
        echo "Erreur lors de l'upload de l'image.";
    }
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
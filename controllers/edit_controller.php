<?php
// Connexion à la base de données
require 'controllers\config.php';

// Vérifier si un ID est passé en paramètre
if (!isset($_GET['id'])) {
    die("ID du produit non spécifié.");
}

$id = $_GET['id'];

// Récupération du produit à modifier
$stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Produit introuvable.");
}

// Mise à jour du produit
if (isset($_POST['update'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $description = $_POST['description'];

    // Gestion de l'image
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $stmt = $pdo->prepare("UPDATE product SET product_name = ?, price = ?, stock_quantity = ?, image = ?, description = ? WHERE id = ?");
    $stmt->execute([$product_name, $price, $stock_quantity, $description, $target_file, $id]);

    header("Location: admin_menu.php");
    exit();
}
?>
<?php include 'includes/header.php'; ?>

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

    $stmt = $pdo->prepare("UPDATE product SET product_name = ?, price = ?, description = ? WHERE id = ?");
    $stmt->execute([$product_name, $price, $description, $id]);

    header("Location: admin_menu.php");
    exit();
}
?>

    <h2>Modifier le produit</h2>
    <form method="post">
        <input type="text" name="name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
        <button type="submit" name="update">Mettre à jour</button>
    </form>
    <a href="admin_menu.php">Retour</a>

<?php include 'includes/footer.php'; ?>


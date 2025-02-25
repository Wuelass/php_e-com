<?php include 'includes/header.php'; ?>

<?php

require 'controllers\config.php';

// Ajout d'un produit
if (isset($_POST['add'])) {
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des produits</title>
</head>
<body>
    <h2>Ajouter un produit</h2>
    <form method="post" action="admin_menu.php">
        <input type="text" name="product_name" placeholder="Nom" required>
        <input type="number" name="price" placeholder="Prix" required>
        <input type="number" name="stock_quantity" placeholder="Quantiter" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit" name="add">Ajouter</button>
    </form>

    <h2>Liste des produits</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantiter</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= htmlspecialchars($product['product_name']) ?></td>
            <td><?= htmlspecialchars($product['price']) ?></td>
            <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td>
                <a href="edit.php?id=<?= $product['id'] ?>">Modifier</a>
                <a href="admin_menu.php?delete=<?= $product['id'] ?>" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>


<?php include 'includes/footer.php'; ?>
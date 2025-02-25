<?php include 'includes/header.php'; ?>
<?php require 'controllers/edit_controller.php'; ?>

    <h2>Modifier le produit</h2>
    <form method="post">
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        <input type="number" name="stock_quantity" value="<?= htmlspecialchars($product['stock_quantity']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
        <button type="submit" name="update">Mettre à jour</button>
    </form>
    <a href="admin_menu.php">Retour</a>

<?php include 'includes/footer.php'; ?>


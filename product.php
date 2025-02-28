<?php include 'includes/header.php'; ?>
<?php require 'controllers/product_controller.php'; ?>

<div class="container">
    <div class="product-detail">
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
        <h1><?= htmlspecialchars($product['product_name']) ?></h1>
        <p><?= htmlspecialchars($product['description']) ?></p>
        <p class="price"><?= number_format($product['price'], 2) ?> €</p>
        <a href="store.php" class="btn">Retour à la boutique</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

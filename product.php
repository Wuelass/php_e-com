<?php include 'includes/header.php'; ?>
<?php require 'controllers/product_controller.php'; ?>

<div class="container">
    <div class="product-detail">
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
        <h1><?= htmlspecialchars($product['product_name']) ?></h1>
        <p><?= htmlspecialchars($product['description']) ?></p>
        <p class="price"><?= number_format($product['price'], 2) ?> €</p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="controllers/add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" class="btn">Ajouter au panier</button>
            </form>
        <?php endif; ?>
        <a href="store.php" class="btn">Retour à la boutique</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

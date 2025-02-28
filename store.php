<?php
require 'controllers/config.php'; // Connexion à la base de données

// Récupération des produits depuis la base de données
$products = $pdo->query("SELECT * FROM product")->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Nos Produits</h1>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                    <h2><?= htmlspecialchars($product['product_name']) ?></h2>
                    <!-- <p><?= htmlspecialchars($product['description']) ?></p> -->
                    <p class="price"><?= number_format($product['price'], 2) ?> €</p>
                    <a href="product.php?id=<?= $product['id'] ?>" class="btn">Voir le produit</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>


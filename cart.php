<?php include 'includes/header.php'; ?>
<?php require 'controllers/cart_controller.php'; ?>

<div class="container">
    <h1>Votre Panier</h1>
    <?php if (empty($cart_items)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Image</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" width="50"></td>
                        <td><?= number_format($item['price_at_cart'], 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href="store.php" class="btn">Continuer vos achats</a>
</div>

<?php include 'includes/footer.php'; ?>
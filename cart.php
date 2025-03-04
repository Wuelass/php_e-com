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
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_price = 0;
                foreach ($cart_items as $item): 
                    $total_price += $item['price_at_cart'] * $item['quantity'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" width="50"></td>
                        <td><?= number_format($item['price_at_cart'], 2) ?> €</td>
                        <td>
                            <form action="controllers/update_cart.php" method="post" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" name="action" value="decrease" class="btn">-</button>
                            </form>
                            <?= $item['quantity'] ?>
                            <form action="controllers/update_cart.php" method="post" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button type="submit" name="action" value="increase" class="btn">+</button>
                            </form>
                        </td>
                        <td><?= number_format($item['price_at_cart'] * $item['quantity'], 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total-price">
            <h2>Total: <?= number_format($total_price, 2) ?> €</h2>
        </div>
    <?php endif; ?>
    <a href="store.php" class="btn">Continuer vos achats</a>
</div>

<?php include 'includes/footer.php'; ?>
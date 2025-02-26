<?php include 'includes/header.php'; ?>
<?php require 'controllers/admin_controller.php'; ?>
    
    <div class="container">
            <h2>Ajouter un produit</h2>
            <form method="post" action="admin_menu.php" enctype="multipart/form-data">
                <input type="text" name="product_name" placeholder="Nom" required>
                <input type="number" name="price" placeholder="Prix" required>
                <input type="number" name="stock_quantity" placeholder="Quantité" required>
                <textarea name="description" placeholder="Description" required></textarea>
                <input type="file" name="image" required>
                <button type="submit" name="add">Ajouter</button>
            </form>
        
        
        <h2>Liste des produits</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
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
    </div>
    
<?php include 'includes/footer.php'; ?>

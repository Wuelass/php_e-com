<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softcult Store</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon_io/favicon-32x32.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">


</head>
<body>
<header class="nav-bar">
    <div class="logo">
        <a href="/">Softcult</a>
    </div>
    <div class="nav-buttons">
        <a href="/store.php" class="btn">Store</a>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') : ?>
            <a href="/admin_menu.php" class="btn btn-admin">Admin Panel</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a href="/cart.php" class="btn btn-admin">Panier</a>
            <a href="/dashboard.php" class="btn">Bonjour, <?= htmlspecialchars($_SESSION['username']); ?></a>
            <a href="/controllers/logout.php" class="btn btn-primary">Déconnexion</a>
        <?php else : ?>
            <a href="/login.php" class="btn">Login</a>
            <a href="/signup.php" class="btn btn-primary">Sign Up</a>
        <?php endif; ?>
    </div>
</header>

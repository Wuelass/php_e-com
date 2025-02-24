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
</head>
<body>
<header class="nav-bar">
    <div class="logo">
        <a href="/">Softcult</a>
    </div>
    <div class="nav-buttons">
        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') : ?>
            <a href="/admin/dashboard.php" class="btn btn-admin">Admin Panel</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a href="/dashboard.php" class="btn">Bonjour, <?= htmlspecialchars($_SESSION['username']); ?></a>
            <a href="/controllers/logout.php" class="btn btn-primary">Déconnexion</a>
        <?php else : ?>
            <a href="/login.php" class="btn">Login</a>
            <a href="/signup.php" class="btn btn-primary">Sign Up</a>
        <?php endif; ?>
    </div>
</header>

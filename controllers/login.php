<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        error_log("Erreur : Tous les champs sont requis.");
        header("Location: login.php?error=emptyfields");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("Erreur : Email invalide.");
        header("Location: login.php?error=invalidemail");
        exit();
    }

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie, créer une session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        error_log("Connexion réussie pour {$user['username']} (ID: {$user['id']})");
        header("Location: /"); // Rediriger vers une page après connexion
        exit();
    } else {
        error_log("Erreur : Email ou mot de passe incorrect.");
        header("Location: login.php?error=invalidcredentials");
        exit();
    }
}
?>

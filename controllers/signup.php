<?php
session_start();
require 'config.php'; // Fichier de connexion PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($email) || empty($password)) {
        echo "Tous les champs sont requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse e-mail invalide.";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $userExists = $stmt->fetchColumn(); // Récupère le nombre d'utilisateurs trouvés

        if ($userExists) {
            echo "Cet e-mail est déjà utilisé.";
        } else {
            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashed_password
            ]);

            if ($stmt) {
                // Récupérer l'ID du nouvel utilisateur
                $user_id = $pdo->lastInsertId();

                // Insérer l'ID de l'utilisateur dans la table cart
                $stmt = $pdo->prepare("INSERT INTO cart (user_id) VALUES (:user_id)");
                $stmt->execute(['user_id' => $user_id]);

                if ($stmt) {
                    error_log("Inscription réussie et panier créé. Redirection en cours...");
                    header("Location: ../login.php"); // Redirige vers la page de connexion
                    exit(); // Important pour arrêter l'exécution après la redirection
                } else {
                    error_log("Erreur lors de la création du panier.");
                }
            } else {
                error_log("Erreur lors de l'inscription.");
            }
        }
    }
}
?>

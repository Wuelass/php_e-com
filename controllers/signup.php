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
                error_log("Inscription réussie. Vous pouvez maintenant vous connecter.");
            } else {
                error_log("Erreur lors de l'inscription.");
            }
            
        }
    }
}
?>

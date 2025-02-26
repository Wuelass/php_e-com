<?php
require 'config.php'; // Connexion à la base de données

// Fonction pour sécuriser l'upload
function uploadImage($file) {
    $target_dir = "uploads/";

    // Vérifier si un fichier est bien envoyé
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null; // Pas d'upload
    }

    // Vérifier l'extension du fichier (pour éviter les fichiers dangereux)
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_types)) {
        return null; // Type non autorisé
    }

    // Générer un nom unique pour l'image
    $unique_name = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $unique_name;

    // Déplacer le fichier uploadé
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file; // Retourne le chemin du fichier
    }

    return null;
}

?>
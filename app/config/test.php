<?php
require 'Database.php';

try {
    $conn = Database::getConnection();
    echo "✅ Connexion réussie";
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage();
}
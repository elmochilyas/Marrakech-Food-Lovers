<?php
class RecipeController {
    public function index() {
        // TODO: Load recipes from database
        $recipes = []; // Placeholder: load from DB later
        $pageTitle = 'Recipes - Marrakech Food Lovers';
        require_once __DIR__ . '/../views/recipes/index.php';
    }

    // Add other methods as needed (create, store, edit, delete)
}
?>

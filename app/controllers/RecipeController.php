<?php
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';

class RecipeController
{
    private function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    private function redirectIfNotLoggedIn(): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: /Marrakech%20Food%20Lovers/login');
            exit;
        }
    }

    public function indexAll()
    {
        $db = Database::getConnection();
        $recipeModel = new Recipe($db);
        $recipes = $recipeModel->getAll();
        $showActions = false;

        $pageTitle = 'Toutes les Recettes - Marrakech Food Lovers';
        require_once __DIR__ . '/../views/recipes/index.php';
    }

    public function index()
    {
        $this->redirectIfNotLoggedIn();

        $db = Database::getConnection();
        $recipeModel = new Recipe($db);
        $recipes = $recipeModel->getByUser($_SESSION['user_id']);
        $showActions = true;

        $pageTitle = 'Mes Recettes - Marrakech Food Lovers';
        require_once __DIR__ . '/../views/recipes/index.php';
    }

    public function create()
    {
        $this->redirectIfNotLoggedIn();

        $db = Database::getConnection();
        $categoryModel = new Category($db);
        $categories = $categoryModel->getAll();

        $pageTitle = 'Ajouter une Recette - Marrakech Food Lovers';
        require_once __DIR__ . '/../views/recipes/create.php';
    }

    public function store()
    {
        $this->redirectIfNotLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /Marrakech%20Food%20Lovers/recettes/create');
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $ingredients = trim($_POST['ingredients'] ?? '');
        $instructions = trim($_POST['instructions'] ?? '');
        $prepTime = !empty($_POST['prep_time']) ? (int)$_POST['prep_time'] : null;
        $cookTime = !empty($_POST['cook_time']) ? (int)$_POST['cook_time'] : null;
        $portions = !empty($_POST['portions']) ? (int)$_POST['portions'] : null;
        $categoryId = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;

        if (empty($title) || empty($ingredients) || empty($instructions)) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Veuillez remplir tous les champs obligatoires.'];
            header('Location: /Marrakech%20Food%20Lovers/recettes/create');
            exit;
        }

        $db = Database::getConnection();
        $recipeModel = new Recipe($db);
        $recipe = $recipeModel->create(
            $_SESSION['user_id'],
            $title,
            $ingredients,
            $instructions,
            $prepTime,
            $cookTime,
            $portions,
            $categoryId
        );

        if ($recipe) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Recette créée avec succès!'];
            header('Location: /Marrakech%20Food%20Lovers/recettes');
        } else {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Erreur lors de la création de la recette.'];
            header('Location: /Marrakech%20Food%20Lovers/recettes/create');
        }
        exit;
    }

    public function edit(int $id)
    {
        $this->redirectIfNotLoggedIn();

        $db = Database::getConnection();
        $recipeModel = new Recipe($db);
        $categoryModel = new Category($db);

        $recipe = $recipeModel->getById($id);
        
        if (!$recipe || $recipe->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Recette non trouvée ou accès refusé.'];
            header('Location: /Marrakech%20Food%20Lovers/recettes');
            exit;
        }

        $categories = $categoryModel->getAll();

        $pageTitle = 'Modifier la Recette - Marrakech Food Lovers';
        require_once __DIR__ . '/../views/recipes/edit.php';
    }

    public function update(int $id)
    {
        $this->redirectIfNotLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /Marrakech%20Food%20Lovers/recettes/edit/' . $id);
            exit;
        }

        $db = Database::getConnection();
        $recipeModel = new Recipe($db);
        
        $recipe = $recipeModel->getById($id);
        
        if (!$recipe || $recipe->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Recette non trouvée ou accès refusé.'];
            header('Location: /Marrakech%20Food%20Lovers/recettes');
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $ingredients = trim($_POST['ingredients'] ?? '');
        $instructions = trim($_POST['instructions'] ?? '');
        $prepTime = !empty($_POST['prep_time']) ? (int)$_POST['prep_time'] : null;
        $cookTime = !empty($_POST['cook_time']) ? (int)$_POST['cook_time'] : null;
        $portions = !empty($_POST['portions']) ? (int)$_POST['portions'] : null;
        $categoryId = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;

        if (empty($title) || empty($ingredients) || empty($instructions)) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Veuillez remplir tous les champs obligatoires.'];
            header('Location: /Marrakech%20Food%20Lovers/recettes/edit/' . $id);
            exit;
        }

        $success = $recipeModel->update(
            $id,
            $_SESSION['user_id'],
            $title,
            $ingredients,
            $instructions,
            $prepTime,
            $cookTime,
            $portions,
            $categoryId
        );

        if ($success) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Recette mise à jour avec succès!'];
            header('Location: /Marrakech%20Food%20Lovers/recettes');
        } else {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Erreur lors de la mise à jour de la recette.'];
            header('Location: /Marrakech%20Food%20Lovers/recettes/edit/' . $id);
        }
        exit;
    }

    public function delete(int $id)
    {
        $this->redirectIfNotLoggedIn();

        $db = Database::getConnection();
        $recipeModel = new Recipe($db);

        $recipe = $recipeModel->getById($id);
        
        if (!$recipe || $recipe->getUserId() !== $_SESSION['user_id']) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Recette non trouvée ou accès refusé.'];
            header('Location: /Marrakech%20Food%20Lovers/recettes');
            exit;
        }

        $success = $recipeModel->delete($id, $_SESSION['user_id']);

        if ($success) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Recette supprimée avec succès!'];
        } else {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Erreur lors de la suppression de la recette.'];
        }

        header('Location: /Marrakech%20Food%20Lovers/recettes');
        exit;
    }
}

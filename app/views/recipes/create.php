<?php
$pageTitle = 'Ajouter une Recette - Marrakech Food Lovers';

require_once __DIR__ . '/../layout/header.php';
?>

<div class="page-header">
    <h2>Ajouter une Recette</h2>
    <a href="/Marrakech%20Food%20Lovers/recettes" class="btn btn-secondary">← Retour</a>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['flash']['type']); ?>">
        <?php echo htmlspecialchars($_SESSION['flash']['message']); ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<form method="POST" action="/Marrakech%20Food%20Lovers/recettes/store" class="recipe-form">
    <div class="form-group">
        <label for="title">Titre de la recette *</label>
        <input type="text" id="title" name="title" required class="form-control" 
               value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="cook_time">Temps de cuisson (min)</label>
            <input type="number" id="cook_time" name="cook_time" class="form-control" min="0"
                   value="<?php echo isset($_POST['cook_time']) ? htmlspecialchars($_POST['cook_time']) : ''; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select id="category_id" name="category_id" class="form-control">
            <option value="">-- Sélectionner une catégorie --</option>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->getId(); ?>"
                        <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $category->getId()) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category->getName()); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="ingredients">Ingrédients *</label>
        <textarea id="ingredients" name="ingredients" required class="form-control" rows="6"
                  placeholder="Liste des ingrédients (un par ligne)"><?php echo isset($_POST['ingredients']) ? htmlspecialchars($_POST['ingredients']) : ''; ?></textarea>
    </div>

    <div class="form-group">
        <label for="instructions">Instructions *</label>
        <textarea id="instructions" name="instructions" required class="form-control" rows="10"
                  placeholder="Étapes de préparation"><?php echo isset($_POST['instructions']) ? htmlspecialchars($_POST['instructions']) : ''; ?></textarea>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Créer la recette</button>
        <a href="/Marrakech%20Food%20Lovers/recettes" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php
require_once __DIR__ . '/../layout/footer.php';

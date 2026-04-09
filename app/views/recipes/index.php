<?php
$pageTitle = 'My Recipes - Marrakech Food Lovers';

require_once __DIR__ . '/../layout/header.php';
?>

<div class="page-header">
    <h2>My Recipes</h2>
    <a href="/Marrakech%20Food%20Lovers/recettes/create" class="btn btn-primary">+ Add New Recipe</a>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['flash']['type']); ?>">
        <?php echo htmlspecialchars($_SESSION['flash']['message']); ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (empty($recipes)): ?>
    <div class="empty-state">
        <h3>No recipes yet</h3>
        <p>Start by creating your first recipe!</p>
        <a href="/Marrakech%20Food%20Lovers/recettes/create" class="btn btn-primary">Create Recipe</a>
    </div>
<?php else: ?>
    <div class="recipes-grid">
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card">
                <div class="recipe-card-header">
                    <h3><?php echo htmlspecialchars($recipe->getTitle()); ?></h3>
                </div>
                <div class="recipe-card-body">
                    <div class="recipe-meta">
                        <span class="meta-item">
                            <strong>Prep Time:</strong> <?php echo htmlspecialchars($recipe->getPrepTime()); ?> min
                        </span>
                        <?php if ($recipe->getCookTime()): ?>
                            <span class="meta-item">
                                <strong>Cook Time:</strong> <?php echo htmlspecialchars($recipe->getCookTime()); ?> min
                            </span>
                        <?php endif; ?>
                        <?php if ($recipe->getPortions()): ?>
                            <span class="meta-item">
                                <strong>Portions:</strong> <?php echo htmlspecialchars($recipe->getPortions()); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="recipe-date">
                        <small>Created: <?php echo htmlspecialchars(date('M d, Y', strtotime($recipe->getCreatedAt()))); ?></small>
                    </div>
                </div>
                <div class="recipe-card-actions">
                    <a href="/recettes/edit/<?php echo $recipe->getId(); ?>" class="btn btn-secondary">Edit</a>
                    <a href="/recettes/delete/<?php echo $recipe->getId(); ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>

<?php
$pageTitle = 'Mes Recettes - Marrakech Food Lovers';

require_once __DIR__ . '/../layout/header.php';
?>

<div class="page-header">
    <h2>Mes Recettes</h2>
    <a href="/Marrakech%20Food%20Lovers/recettes/create" class="btn btn-primary">+ Ajouter une recette</a>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['flash']['type']); ?>">
        <?php echo htmlspecialchars($_SESSION['flash']['message']); ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (empty($recipes)): ?>
    <div class="empty-state">
        <h3>Aucune recette</h3>
        <p>Commencez par créer votre première recette!</p>
        <a href="/Marrakech%20Food%20Lovers/recettes/create" class="btn btn-primary">Créer une recette</a>
    </div>
<?php else: ?>
    <div class="recipes-grid">
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card">
                <div class="recipe-card-header">
                    <h3><?php echo htmlspecialchars($recipe->getTitle()); ?></h3>
                    <?php if (method_exists($recipe, 'getUsername')): ?>
                        <small class="recipe-author">Par: <?php echo htmlspecialchars($recipe->getUsername()); ?></small>
                    <?php endif; ?>
                </div>
                <div class="recipe-card-body">
                    <?php if ($recipe->getIngredients()): ?>
                        <div class="recipe-section">
                            <h4>Ingrédients:</h4>
                            <p><?php echo nl2br(htmlspecialchars($recipe->getIngredients())); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($recipe->getInstructions()): ?>
                        <div class="recipe-section">
                            <h4>Instructions:</h4>
                            <p><?php echo nl2br(htmlspecialchars($recipe->getInstructions())); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="recipe-meta">
                        <?php if ($recipe->getCookTime()): ?>
                            <span class="meta-item">
                                <strong>Temps de cuisson:</strong> <?php echo htmlspecialchars($recipe->getCookTime()); ?> min
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="recipe-date">
                        <small>Créée le: <?php echo htmlspecialchars(date('d M Y', strtotime($recipe->getCreatedAt()))); ?></small>
                    </div>
                </div>
                <?php if (!empty($showActions)): ?>
                <div class="recipe-card-actions">
                    <a href="/Marrakech%20Food%20Lovers/recettes/edit/<?php echo $recipe->getId(); ?>" class="btn btn-secondary">Modifier</a>
                    <a href="/Marrakech%20Food%20Lovers/recettes/delete/<?php echo $recipe->getId(); ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette?');">Supprimer</a>
                </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php
require_once __DIR__ . '/../layout/footer.php';
?>

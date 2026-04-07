<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Marrakech Food Lovers'; ?></title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <h1><a href="/">🍽️ Marrakech Food Lovers</a></h1>
            </div>
            <nav class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="user-welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="/logout" class="nav-link">Logout</a>
                <?php else: ?>
                    <a href="/login" class="nav-link">Login</a>
                    <a href="/register" class="nav-link nav-link-active">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
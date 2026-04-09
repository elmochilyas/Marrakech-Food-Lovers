<?php


session_start();


require_once 'config/Database.php';
$db = Database::getConnection();

// 3. Inclure les controllers
require_once 'controllers/UserController.php';
require_once 'controllers/RecipeController.php';

// 4. Inclure les models
require_once 'models/user.php';

//require_once 'controllers/UserController.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = explode('/', $url);

$controller = isset($url[0]) && $url[0] !== '' ? $url[0] : 'home';
$action     = isset($url[1]) && $url[1] !== '' ? $url[1] : 'index';


switch ($controller) {
    case 'users':
        $ctrl = new UserController($db);
        if ($action === 'register') $ctrl->register();
        elseif ($action === 'login')    $ctrl->login();
        elseif ($action === 'logout')   $ctrl->logout();
        break;

    case 'recettes':
        $ctrl = new RecipeController();
        if ($action === 'index')   $ctrl->index();
        elseif ($action === 'create') $ctrl->create();
        elseif ($action === 'store')  $ctrl->store();
        elseif ($action === 'edit')   $ctrl->edit($url[2] ?? null);
        elseif ($action === 'delete') $ctrl->delete($url[2] ?? null);
        break;

    default:
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Marrakech Food Lovers</title>
            <style>
                body { font-family: sans-serif; padding: 50px; text-align: center; }
                nav a { margin: 0 15px; text-decoration: none; color: #333; }
                nav a:hover { text-decoration: underline; }
            </style>
        </head>
        <body>
            <h1>Bienvenue sur Marrakech Food Lovers</h1>
            <nav>
                <a href="users/login">Connexion</a>
                <a href="users/register">Inscription</a>
                <a href="recettes">Recettes</a>
            </nav>
        </body>
        </html>
        <?php
    
        echo "Bienvenue sur Marrakech Food Lovers";
        break;
}
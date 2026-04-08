<?php

// 1. Démarrer la session (pour login/logout plus tard)
session_start();

// 2. Inclure la connexion à la BDD
require_once 'config/Database.php';

// 3. Inclure les controllers
require_once 'controllers/UserController.php';
// require_once 'controllers/RecipeController.php';

// 4. Lire l'URL demandée
// Ex: /recettes/create  =>  $url = ['recettes', 'create']
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = explode('/', $url);

$controller = isset($url[0]) && $url[0] !== '' ? $url[0] : 'home';
$action     = isset($url[1]) && $url[1] !== '' ? $url[1] : 'index';

// 5. Router : appelle le bon controller et la bonne méthode
switch ($controller) {
    case 'users':
        $ctrl = new UserController();
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
        // Page d'accueil ou 404
        echo "Bienvenue sur Marrakech Food Lovers";
        break;
}
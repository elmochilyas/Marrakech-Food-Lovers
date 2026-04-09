<?php


session_start();


require_once 'config/Database.php';


//require_once 'controllers/UserController.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = explode('/', $url);

$controller = isset($url[0]) && $url[0] !== '' ? $url[0] : 'home';
$action     = isset($url[1]) && $url[1] !== '' ? $url[1] : 'index';


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
    
        echo "Bienvenue sur Marrakech Food Lovers";
        break;
}
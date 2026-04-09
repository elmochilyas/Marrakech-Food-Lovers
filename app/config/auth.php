<?php

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'You must be logged in to access this page.'
        ];
        header('Location: /login');
        exit();
    }
}

function getCurrentUserId(): ?int
{
    return isLoggedIn() ? (int)$_SESSION['user_id'] : null;
}

function getCurrentUsername(): ?string
{
    return isLoggedIn() ? $_SESSION['username'] : null;
}

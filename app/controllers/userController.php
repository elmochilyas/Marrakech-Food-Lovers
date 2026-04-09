<?php

class UserController
{
    private PDO $db;

    public function __construct(PDO $database)
    {
        $this->db = $database;
    }

    public function register(): void
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username)) {
                $errors[] = "Username is required.";
            } elseif (strlen($username) < 3) {
                $errors[] = "Username must be at least 3 characters long.";
            } elseif (strlen($username) > 50) {
                $errors[] = "Username must not exceed 50 characters.";
            } elseif (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
                $errors[] = "Username can only contain letters, numbers, underscores, and hyphens.";
            }

            if (empty($email)) {
                $errors[] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a valid email address.";
            } elseif (strlen($email) > 100) {
                $errors[] = "Email must not exceed 100 characters.";
            }

            if (empty($password)) {
                $errors[] = "Password is required.";
            } elseif (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long.";
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $errors[] = "Password must contain at least one uppercase letter.";
            } elseif (!preg_match('/[0-9]/', $password)) {
                $errors[] = "Password must contain at least one number.";
            }


            if (empty($errors)) {
                $userModel = new User($this->db);

                $existingUser = $userModel->findByEmail($email);
                if ($existingUser) {
                    $errors[] = "This email address is already registered.";
                }
            }

            if (empty($errors)) {
                $userModel = new User($this->db);

                $passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

                $newUser = $userModel->create($username, $email, $passwordHash);

                if ($newUser) {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'Account created successfully! Please log in with your credentials.'
                    ];

                    header('Location: /Marrakech%20Food%20Lovers/users/login');
                    exit();
                } else {
                    $errors[] = "An error occurred while creating your account. Please try again.";
                }
            }
        }

        $pageTitle = 'Register - Marrakech Food Lovers';
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function login(): void
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $rememberMe = !empty($_POST['remember_me']);

            if (empty($email)) {
                $errors[] = "Email is required.";
            }

            if (empty($password)) {
                $errors[] = "Password is required.";
            }

            if (empty($errors)) {
                $userModel = new User($this->db);

                $user = $userModel->findByEmail($email);

                if ($user && $userModel->verifyPassword($password, $user->getPasswordHash())) {
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['email'] = $user->getEmail();

                    if ($rememberMe) {
                        setcookie(
                            'remember_token',
                            bin2hex(random_bytes(32)),
                            time() + (30 * 24 * 60 * 60),
                            '/',
                            '',
                            false,
                            true
                        );
                    }

                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'Welcome back, ' . htmlspecialchars($user->getUsername()) . '!'
                    ];

                    header('Location: /Marrakech%20Food%20Lovers/recettes');
                    exit();
                } else {
                    $errors[] = "Invalid email address or password.";
                }
            }
        }

        $pageTitle = 'Login - Marrakech Food Lovers';
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout(): void
    {
        session_destroy();
        $_SESSION = [];

        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }

        header('Location: /Marrakech%20Food%20Lovers/');
        exit();
    }
}
?>
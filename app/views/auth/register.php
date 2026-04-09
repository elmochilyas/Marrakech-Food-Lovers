<?php
// Set page title
$pageTitle = 'Register - Marrakech Food Lovers';

// Include header
require_once __DIR__ . '/../layout/header.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Create Your Account</h2>
        <p class="auth-subtitle">Join our community of food lovers</p>

        <!-- Error Messages Section -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <h4>⚠️ Registration Failed</h4>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Success Message (if redirected from successful submission) -->
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                ✅ <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form id="registrationForm" action="" method="POST" class="auth-form" novalidate>

            <!-- Username Field -->
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-input"
                    placeholder="Choose a username"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                    minlength="3"
                    maxlength="50"
                    required
                >
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    placeholder="your@email.com"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                    maxlength="100"
                    required
                >
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Create a strong password"
                    minlength="8"
                    maxlength="255"
                    required
                >
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">
                Create Account
            </button>

        </form>

        <!-- Login Link -->
        <div class="auth-footer">
            <p>Already have an account? <a href="/login" class="link">Login here</a></p>
        </div>
    </div>
</div>

<?php
// Include footer
require_once __DIR__ . '/../layout/footer.php';
?>
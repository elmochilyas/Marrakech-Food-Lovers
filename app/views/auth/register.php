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

<!-- Validation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('passwordConfirm');

    // Validation functions
    function validateUsername() {
        const length = usernameInput.value.length >= 3;
        updateHint('usernameHint', 'length', length);
        return length;
    }

    function validateEmail() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const valid = emailRegex.test(emailInput.value);
        updateHint('emailHint', 'format', valid);
        return valid;
    }

    function validatePassword() {
        const value = passwordInput.value;
        const length = value.length >= 8;
        const uppercase = /[A-Z]/.test(value);
        const number = /[0-9]/.test(value);

        updateHint('passwordHint', 'length', length);
        updateHint('passwordHint', 'uppercase', uppercase);
        updateHint('passwordHint', 'number', number);

        return length && uppercase && number;
    }

    function validateConfirm() {
        const match = passwordInput.value === confirmInput.value && passwordInput.value.length > 0;
        updateHint('confirmHint', 'match', match);
        return match;
    }

    function updateHint(containerId, rule, isValid) {
        const container = document.getElementById(containerId);
        const hint = container.querySelector(`[data-rule="${rule}"]`);
        if (hint) {
            const icon = hint.querySelector('.hint-icon');
            if (isValid) {
                hint.classList.add('valid');
                hint.classList.remove('invalid');
                icon.textContent = '✅';
            } else {
                hint.classList.add('invalid');
                hint.classList.remove('valid');
                icon.textContent = '❌';
            }
        }
    }

    // Event listeners for real-time validation
    usernameInput.addEventListener('input', validateUsername);
    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', () => {
        validatePassword();
        validateConfirm(); // Re-check confirm when password changes
    });
    confirmInput.addEventListener('input', validateConfirm);

    // Form submission
    form.addEventListener('submit', function(e) {
        // Validate all fields before submission
        const usernameValid = validateUsername();
        const emailValid = validateEmail();
        const passwordValid = validatePassword();
        const confirmValid = validateConfirm();

        if (!usernameValid || !emailValid || !passwordValid || !confirmValid) {
            e.preventDefault();
            alert('Please fix the validation errors above.');
        }
    });
});
</script>

<?php
// Include footer
require_once __DIR__ . '/../layout/footer.php';
?>
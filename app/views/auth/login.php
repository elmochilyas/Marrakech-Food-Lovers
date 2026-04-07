<?php
// Set page title for header.php to use
$pageTitle = 'Login - Marrakech Food Lovers';

// Include header (opens HTML, navbar, main container)
require_once __DIR__ . '/../layout/header.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Sign In to Your Account</h2>
        <p class="auth-subtitle">Welcome back to our food community</p>

        <!-- ============================================
             ERROR MESSAGES SECTION
             Same as registration form — displays backend validation errors
             ============================================ -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <h4>⚠️ Login Failed</h4>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- ============================================
             SUCCESS MESSAGE
             Shows if login was successful (unlikely but possible)
             ============================================ -->
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                ✅ <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <!-- ============================================
             LOGIN FORM
             Submits to /login endpoint via POST
             ============================================ -->
        <form id="loginForm" action="/login" method="POST" class="auth-form" novalidate>

            <!-- EMAIL FIELD -->
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
                    autocomplete="email"
                >

            </div>

            <!-- PASSWORD FIELD -->
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Enter your password"
                    maxlength="255"
                    required
                    autocomplete="current-password"
                >

            </div>

            <!-- REMEMBER ME CHECKBOX (Optional feature) -->
            <div class="form-group form-group-checkbox">
                <label class="checkbox-label" for="rememberMe">
                    <input
                        type="checkbox"
                        id="rememberMe"
                        name="remember_me"
                        value="1"
                    >
                    <span>Remember me for 30 days</span>
                </label>
                <!-- 
                    This is optional. Backend can use this to:
                    - Set a longer cookie lifetime (30 days instead of session)
                    - Or set a "remember token" in DB for persistent login
                -->
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit" class="btn btn-primary btn-block">
                Sign In
            </button>

        </form>

        <!-- LOGIN FOOTER - Link to registration -->
        <div class="auth-footer">
            <p>Don't have an account? <a href="/register" class="link">Register here</a></p>
            <p><a href="#" class="link link-small">Forgot password?</a></p>
            <!-- Note: "Forgot password" is a bonus feature, not required for MVP -->
        </div>
    </div>
</div>

<!-- ============================================
     CLIENT-SIDE VALIDATION SCRIPT
     Provides real-time visual feedback
     ============================================ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    /**
     * Validate email format
     * Uses regex to check: something@something.something
     */
    function validateEmail() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const valid = emailRegex.test(emailInput.value);
        updateHint('emailHint', 'format', valid);
        return valid;
    }

    /**
     * Validate password is not empty
     * For login, we don't check strength — that was done at registration
     */
    function validatePassword() {
        const filled = passwordInput.value.length > 0;
        updateHint('passwordHint', 'filled', filled);
        return filled;
    }

    /**
     * Update visual hint (changes icon + color)
     * @param {string} containerId - ID of the hints container
     * @param {string} rule - Data rule name (e.g., "format", "filled")
     * @param {boolean} isValid - Is this rule satisfied?
     */
    function updateHint(containerId, rule, isValid) {
        const container = document.getElementById(containerId);
        const hint = container.querySelector(`[data-rule="${rule}"]`);
        if (hint) {
            const icon = hint.querySelector('.hint-icon');
            if (isValid) {
                // Valid: add 'valid' class, remove 'invalid', show green checkmark
                hint.classList.add('valid');
                hint.classList.remove('invalid');
                icon.textContent = '✅';
            } else {
                // Invalid: add 'invalid' class, remove 'valid', show red X
                hint.classList.add('invalid');
                hint.classList.remove('valid');
                icon.textContent = '❌';
            }
        }
    }

    // REAL-TIME VALIDATION
    // Update hints as user types (before form submission)
    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', validatePassword);

    /**
     * Form submission handler
     * Validates locally before sending to server
     */
    form.addEventListener('submit', function(e) {
        // Validate all fields
        const emailValid = validateEmail();
        const passwordValid = validatePassword();

        // If validation fails, prevent submission and alert user
        if (!emailValid || !passwordValid) {
            e.preventDefault();
            alert('Please fill in all fields correctly.');
        }
        // If validation passes, form submits normally via POST to /login
    });
});
</script>

<?php
// Include footer (closes main, adds footer, closes HTML)
require_once __DIR__ . '/../layout/footer.php';
?>
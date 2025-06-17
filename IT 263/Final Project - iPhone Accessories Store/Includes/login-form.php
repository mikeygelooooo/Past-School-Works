<section class="tab-pane fade show active" id="pills-login" role="tabpanel" tabindex="0">
    <p class="fs-4 fw-semibold text-center my-4">Log In to iEssentials</p>
    <form id="login-form" method="post" action="../PHP/login.php" novalidate>
        <div class="mb-3">
            <label for="login-email-input" class="form-label">Email Address</label>
            <input required type="email" class="form-control" id="login-email-input" name="login-email" placeholder="Enter Email Address">
            <div class="invalid-feedback" id="email-error">Please enter a valid email address.</div>
        </div>
        <div class="mb-5">
            <label for="login-password-input" class="form-label">Password</label>
            <div class="input-group">
                <input required type="password" class="form-control" id="login-password-input" name="login-password" placeholder="Enter Password" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}">
                <div class="input-group-append">
                    <button type="button" class="btn btn-light" id="show-password-btn">
                        <i class="bi bi-eye" id="show-password-icon"></i>
                    </button>
                </div>
            </div>
            <div class="invalid-feedback" id="password-error">Invalid password.</div>
        </div>
        <div class="text-center">
            <button type="submit" form="login-form" class="btn btn-lg btn-secondary fw-medium w-50" value="login">Log-in</button>
        </div>
    </form>
</section>

<script>
    (function() {
        'use strict';

        // DOM elements
        const form = document.querySelector('#login-form');
        const emailInput = document.getElementById('login-email-input');
        const passwordInput = document.getElementById('login-password-input');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const showPasswordBtn = document.getElementById('show-password-btn');
        const showPasswordIcon = document.getElementById('show-password-icon');

        // Clear validation errors on input
        function clearValidationError(input, errorElement) {
            input.setCustomValidity('');
            input.classList.remove('is-invalid');
            errorElement.textContent = input === emailInput ? 'Please enter a valid email address.' : 'Invalid password.';
        }

        emailInput.addEventListener('input', () => clearValidationError(emailInput, emailError));
        passwordInput.addEventListener('input', () => clearValidationError(passwordInput, passwordError));

        // Toggle password visibility
        showPasswordBtn.addEventListener('click', function() {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            showPasswordIcon.classList.toggle('bi-eye', !isPassword);
            showPasswordIcon.classList.toggle('bi-eye-slash', isPassword);
        });

        // Form submission
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../PHP/login.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        window.location.href = "../index.php?msg=Logged in successfully";
                    } else {
                        const input = response.error === 'email' ? emailInput : passwordInput;
                        const errorElement = response.error === 'email' ? emailError : passwordError;
                        input.setCustomValidity('Invalid');
                        errorElement.textContent = response.error === 'email' ? 'Email does not exist.' : 'Incorrect password.';
                        input.classList.add('is-invalid');
                    }
                }
            };
            xhr.send(formData);

            form.classList.add('was-validated');
        }, false);
    })();
</script>
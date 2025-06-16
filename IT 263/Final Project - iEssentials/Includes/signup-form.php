<section class="tab-pane fade show" id="pills-signup" role="tabpanel" tabindex="0">
    <p class="fs-4 fw-semibold text-center my-4">Sign Up to iEssentials</p>
    <form id="signup-form" method="post" action="../PHP/signup.php" novalidate>
        <div class="mb-3">
            <label for="name-input" class="form-label">Name</label>
            <input required type="text" class="form-control" id="name-input" name="signup-name" placeholder="Enter Name" pattern="^[a-zA-Z\s]+$">
            <div class="invalid-feedback" id="name-feedback">Please enter a valid name. Only letters and spaces are allowed.</div>
        </div>
        <div class="mb-3">
            <label for="email-input" class="form-label">Email Address</label>
            <input required type="email" class="form-control" id="email-input" name="signup-email" placeholder="Enter Email Address">
            <div class="invalid-feedback" id="email-feedback">Please enter a valid email address.</div>
        </div>
        <div class="mb-3">
            <label for="password-input" class="form-label">Password</label>
            <div class="input-group">
                <input required type="password" class="form-control" id="password-input" name="signup-password" placeholder="Enter Password" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}">
                <div class="input-group-append">
                    <button type="button" class="btn btn-light" id="show-password-signup">
                        <i class="bi bi-eye" id="show-password-signup-icon"></i>
                    </button>
                </div>
            </div>
            <div class="invalid-feedback">Password must be at least 6 characters long, and contain both letters and numbers.</div>
        </div>
        <div class="mb-5">
            <label for="address-input" class="form-label">Address</label>
            <input required type="text" class="form-control" id="address-input" name="signup-address" placeholder="Enter Address">
            <div class="invalid-feedback">Please enter a valid address.</div>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-lg btn-secondary fw-medium w-50" id="openSignupModal">Sign-up</button>
        </div>
    </form>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmSignup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Account Creation</h1>
                    <button type="button" class="btn text-white fs-6" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to save the entered data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="signup-form" class="btn btn-secondary fw-medium">Sign-up</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';

        // DOM elements
        const signupForm = document.getElementById('signup-form');
        const nameInput = document.getElementById('name-input');
        const emailInput = document.getElementById('email-input');
        const nameFeedback = document.getElementById('name-feedback');
        const emailFeedback = document.getElementById('email-feedback');
        const passwordInput = document.getElementById('password-input');
        const showPasswordBtn = document.getElementById('show-password-signup');
        const showPasswordIcon = document.getElementById('show-password-signup-icon');
        const openSignupModalBtn = document.getElementById('openSignupModal');
        const confirmSignupModal = new bootstrap.Modal(document.getElementById('confirmSignup'));

        /**
         * Check availability of a field (name or email)
         * @param {string} field - The field to check ('name' or 'email')
         * @param {string} value - The value to check
         * @param {HTMLElement} feedbackElement - The feedback element to update
         * @param {function} callback - Callback function with availability result
         */
        function checkAvailability(field, value, feedbackElement, callback) {
            if (value.trim() === "") {
                callback(false);
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../PHP/signup.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    feedbackElement.style.display = response.status === "exists" ? "block" : "none";
                    feedbackElement.textContent = response.status === "exists" ? `This ${field} is already taken.` : '';
                    callback(response.status !== "exists");
                }
            };
            xhr.send(`field=${field}&value=${value}`);
        }

        // Toggle password visibility
        showPasswordBtn.addEventListener('click', function() {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            showPasswordIcon.classList.toggle('bi-eye', !isPassword);
            showPasswordIcon.classList.toggle('bi-eye-slash', isPassword);
        });

        // Validate form and show modal
        openSignupModalBtn.addEventListener('click', function(event) {
            event.preventDefault();

            // Reset form validation state
            signupForm.classList.remove('was-validated');

            const nameAvailablePromise = new Promise((resolve) => checkAvailability('name', nameInput.value, nameFeedback, resolve));
            const emailAvailablePromise = new Promise((resolve) => checkAvailability('email', emailInput.value, emailFeedback, resolve));

            Promise.all([nameAvailablePromise, emailAvailablePromise]).then(([nameAvailable, emailAvailable]) => {
                // Add form validation
                signupForm.classList.add('was-validated');

                const emptyInputs = Array.from(signupForm.querySelectorAll('input[required]')).some(input => input.value.trim() === '');

                if (!emptyInputs && signupForm.checkValidity() && nameAvailable && emailAvailable) {
                    confirmSignupModal.show();
                }
            });
        });

        // Form submission
        signupForm.addEventListener('submit', function(event) {
            event.preventDefault();
            signupForm.submit();
        });

        // Bootstrap form validation
        Array.from(document.querySelectorAll('#signup-form')).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
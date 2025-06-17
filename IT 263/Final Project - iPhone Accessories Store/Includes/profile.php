<section class="tab-pane active container-fluid py-5 text-white" id="profile" role="tabpanel">
    <div class="d-flex flex-lg-row flex-column align-items-lg-center justify-content-lg-center">
        <div class="order-lg-1 order-1 profile-img text-center mb-5 mb-lg-0 me-lg-5">
            <img class="img-container img-fluid rounded-circle" src="../Resources/profile-img.jpg" alt="You">
        </div>
        <div class="order-lg-2 order-2 profile-details col-12 col-lg-6 mt-5 mt-lg-0 ms-lg-5">
            <?php
            $query = "SELECT * FROM Customer WHERE cust_id = '$session_id'";
            $result = mysqli_query($connection, $query);
            $account = mysqli_fetch_assoc($result);
            ?>

            <div id="profile-info">
                <p class="display-5 fw-bold"><?php echo $account["cust_name"] ?></p>
                <p class="fs-3 fw-semibold"><?php echo $account["cust_email"] ?></p>
                <p class="fs-3 fw-semibold"><?php echo $account["cust_address"] ?></p>
            </div>

            <div id="edit-form-container" class="d-none d-flex align-items-center justify-content-center w-100">
                <form id="edit-form" action="../PHP/edit-profile.php" method="post" class="w-100" novalidate>
                    <input type="hidden" id="id-edit" name="edit-id" value="<?php echo $session_id; ?>">
                    <div class="mb-3">
                        <input required type="text" class="form-control form-control-lg w-100" id="name-edit" name="edit-name" placeholder="New Name" value="<?php echo $account["cust_name"] ?>" pattern="^[a-zA-Z\s]+$">
                        <div class="invalid-feedback">Please enter a valid name. Only letters and spaces are allowed.</div>
                        <div class="invalid-feedback" id="edit-name-feedback">This name is already taken.</div>
                    </div>
                    <div class="mb-3">
                        <input required type="email" class="form-control form-control-lg w-100" id="email-edit" name="edit-email" placeholder="New Email" value="<?php echo $account["cust_email"] ?>">
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                        <div class="invalid-feedback" id="edit-email-feedback">This email is already taken.</div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input required type="password" class="form-control form-control-lg" id="password-edit" name="edit-password" placeholder="New Password" value="<?php echo $session_password ?>" pattern="(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-lg btn-light" id="show-password-btn">
                                    <i class="bi bi-eye" id="show-password-icon"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">Password must be at least 6 characters long, and only contains both letters and numbers.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input required type="text" class="form-control form-control-lg w-100" id="address-edit" name="edit-address" placeholder="New Address" value="<?php echo $account["cust_address"] ?>">
                        <div class="invalid-feedback">Please enter a valid address.</div>
                    </div>
                    <div class="btn-container mt-5 d-flex w-100" style="gap: 10px 10px">
                        <button type="button" class="btn btn-lg btn-secondary fw-medium fs-5 py-3" data-bs-toggle="modal" data-bs-target="#confirmAccountEdit">Confirm</button>

                        <div class="modal fade" id="confirmAccountEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark text-white">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Account Edit</h1>
                                        <button type="button" class="btn text-white fs-6" data-bs-dismiss="modal">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to save the edited data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" form="edit-form" class="btn btn-secondary fw-medium" id="save-changes-btn">
                                            Confirm Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-lg btn-outline-secondary fw-medium fs-5 py-3" id="cancel-edit">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

            <div id="button-container" class="btn-container mt-5 d-flex w-100" style="gap: 10px 10px">
                <button class="btn btn-lg btn-secondary fw-medium fs-5 py-3" id="edit-profile-btn">
                    Edit Profile
                </button>

                <button type="button" class="btn btn-lg btn-outline-secondary fw-medium fs-5 py-3" data-bs-toggle="modal" data-bs-target="#confirmLogout">Log Out</button>

                <div class="modal fade" id="confirmLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-dark text-white">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Log Out</h1>
                                <button type="button" class="btn text-white fs-6" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to log out of your account?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-secondary fw-medium" onclick="document.location='../PHP/logout.php'" id="logout-btn">Log Out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const nameInput = document.getElementById('name-edit');
    const emailInput = document.getElementById('email-edit');
    const nameFeedback = document.getElementById('edit-name-feedback');
    const emailFeedback = document.getElementById('edit-email-feedback');
    const saveChangesBtn = document.getElementById('save-changes-btn');
    const editForm = document.getElementById('edit-form');
    const userId = document.getElementById('id-edit').value;

    const checkUserAvailability = function(name, email) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../PHP/edit-profile.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                const response = xhr.responseText;
                if (response === 'exists') {
                    const existingName = xhr.getResponseHeader('Existing-Name');
                    const existingEmail = xhr.getResponseHeader('Existing-Email');

                    if (existingName === 'true') {
                        nameInput.setCustomValidity('Name already exists');
                        nameFeedback.classList.add('d-block');
                    } else {
                        nameInput.setCustomValidity('');
                        nameFeedback.classList.remove('d-block');
                    }

                    if (existingEmail === 'true') {
                        emailInput.setCustomValidity('Email already exists');
                        emailFeedback.classList.add('d-block');
                    } else {
                        emailInput.setCustomValidity('');
                        emailFeedback.classList.remove('d-block');
                    }
                } else {
                    nameInput.setCustomValidity('');
                    nameFeedback.classList.remove('d-block');
                    emailInput.setCustomValidity('');
                    emailFeedback.classList.remove('d-block');
                }
            }
        };
        xhr.send(`name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&id=${userId}`);
    };

    nameInput.addEventListener('input', function() {
        checkUserAvailability(nameInput.value, emailInput.value);
    });

    emailInput.addEventListener('input', function() {
        checkUserAvailability(nameInput.value, emailInput.value);
    });

    saveChangesBtn.addEventListener('click', function(event) {
        if (!editForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        editForm.classList.add('was-validated');
    });

    document.getElementById('edit-profile-btn').addEventListener('click', function() {
        document.getElementById('profile-info').classList.add('d-none');
        document.getElementById('edit-form-container').classList.remove('d-none');
        document.getElementById('button-container').classList.add('d-none');
    });

    document.getElementById('cancel-edit').addEventListener('click', function() {
        document.getElementById('edit-form-container').classList.add('d-none');
        document.getElementById('profile-info').classList.remove('d-none');
        document.getElementById('button-container').classList.remove('d-none');
    });

    const passwordInput = document.getElementById('password-edit');
    const showPasswordBtn = document.getElementById('show-password-btn');
    const showPasswordIcon = document.getElementById('show-password-icon');

    showPasswordBtn.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordIcon.classList.remove('bi-eye');
            showPasswordIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            showPasswordIcon.classList.remove('bi-eye-slash');
            showPasswordIcon.classList.add('bi-eye');
        }
    });

    (function() {
        'use strict'

        var forms = document.querySelectorAll('#edit-form')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
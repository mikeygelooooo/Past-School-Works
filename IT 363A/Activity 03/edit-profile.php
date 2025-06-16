<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FindMyStuff | Edit Profile</title>
    <link rel="icon" href="Resources/logo.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/flatly/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-body-tertiary">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid px-4">
            <!-- Brand -->
            <a class="navbar-brand" href="#" style="font-family: 'Lobster';">
                <h3 class="mb-0">
                    <i class="fas fa-boxes-packing"></i>
                    FindMyStuff
                </h3>
            </a>

            <!-- Search Bar -->
            <form class="d-none d-lg-flex ms-auto" style="width: 30%;">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Search lost and found items...">
                    <button class="btn btn-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Nav Items -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <a class="nav-link d-flex align-items-center" href="#">
                        <i class="fas fa-home me-1"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link d-flex align-items-center" href="#">
                        <i class="fas fa-search me-1"></i>
                        Browse
                    </a>
                </li>

                <!-- Quick Report -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-plus-circle me-1"></i>
                        Report
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-exclamation-circle text-danger me-2"></i>Report Lost Item</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle text-success me-2"></i>Report Found Item</a></li>
                    </ul>
                </li>

                <!-- Notifications -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            2 <!-- 2 unread notifications -->
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                        <li>
                            <h6 class="dropdown-header">Notifications</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-comment text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold text-primary">New message about your lost item</p> <!-- Bold for unread -->
                                        <small class="text-muted">5 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-search text-success"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold text-primary">Match found for your lost item</p> <!-- Bold for unread -->
                                        <small class="text-muted">1 hour ago</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-check text-muted"></i> <!-- Read notification -->
                                    </div>
                                    <div>
                                        <p class="mb-0">Your item has been returned</p> <!-- Normal for read -->
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-center" href="#">View All Notifications</a></li>
                    </ul>
                </li>

                <!-- Messages -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-comment-dots fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            1 <!-- 1 unread message -->
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                        <li>
                            <h6 class="dropdown-header">Messages</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="me-3 position-relative">
                                        <img src="Resources/spy.png" alt="User" class="rounded-circle" width="40" height="40">
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <p class="mb-0 fw-bold text-primary">John Doe</p> <!-- Bold for unread -->
                                        <small class="text-muted text-truncate" style="display: inline-block; max-width: 200px;">Hey, did you find your lost item?</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <img src="Resources/woman.png" alt="User" class="rounded-circle" width="40" height="40">
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <p class="mb-0">Jane Smith</p> <!-- Normal for read -->
                                        <small class="text-muted text-truncate" style="display: inline-block; max-width: 200px;">I think I found your item. Can you confirm?</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <img src="Resources/teacher.png" alt="User" class="rounded-circle" width="40" height="40">
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <p class="mb-0">Mike Johnson</p> <!-- Normal for read -->
                                        <small class="text-muted text-truncate" style="display: inline-block; max-width: 200px;">Let me know if you need any help!</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-center" href="#">View All Messages</a></li>
                    </ul>
                </li>

                <!-- User Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="Resources/man.png" alt="User Profile" class="img-fluid rounded-circle border border-2 border-light me-1" width="35">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-list me-2"></i>My Items</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2"></i>My Notifications</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-comment me-2"></i>My Messages</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container my-5">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img class="img-fluid rounded-circle border border-3 border-primary"
                                    src="Resources/man.png" alt="User" width="150">
                            </div>
                            <h5 class="card-title mb-1">John Doe</h5>
                            <p class="text-muted small mb-3">@johndoe</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-camera me-1"></i>Change Photo
                            </a>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="list-group-item list-group-item-action text-white active">
                                <i class="fas fa-user me-2"></i>Profile Details
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-receipt me-2"></i>My Items
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-cog me-2"></i>My Notifications
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-cog me-2"></i>My Messages
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary-subtle py-3">
                            <h5 class="card-title mb-0">Edit Profile Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control bg-body-secondary" value="John" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control bg-body-secondary" value="Doe" readonly>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control bg-body-secondary" value="johndoe" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control bg-body-secondary" value="johndoe@email.com" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" class="form-control bg-body-secondary" value="0987654321" readonly>
                            </div>
                            <hr class="my-4">
                            <div class="col-lg-6">
                                <div class="d-flex flex-column flex-sm-row justify-content-start gap-2">
                                    <a href="#" class="btn btn-primary w-100">
                                        <i class="fas fa-floppy-disk me-2"></i>Save Changes
                                    </a>
                                    <button type="submit" class="btn btn-secondary w-100">
                                        <i class="fas fa-x me-2"></i>Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-dark text-light pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 style="font-family: 'Lobster';">FindMyStuff</h5>
                    <p class="small">Helping people recover their lost items since 2024.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-light text-decoration-none">About</a></li>
                        <li class="list-inline-item"><a href="#" class="text-light text-decoration-none">Contact</a></li>
                        <li class="list-inline-item"><a href="#" class="text-light text-decoration-none">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#" class="text-light text-decoration-none">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
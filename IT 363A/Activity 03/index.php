<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FindMyStuff | Home</title>
    <link rel="icon" href="Resources/logo.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/flatly/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
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
                    <a class="nav-link d-flex align-items-center active" href="#">
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
        <!-- Hero Section -->
        <div class="bg-light py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Lost Something? Found Something?</h1>
                        <p class="lead mb-4">Connect with your community to find lost items or help others recover their belongings.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button class="btn btn-primary btn-lg px-4 me-md-2">Report Lost Item</button>
                            <button class="btn btn-outline-primary btn-lg px-4">Report Found Item</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="Resources/hero.jpg" alt="Lost and Found Items" class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                <i class="fas fa-file-alt fs-4"></i>
                            </div>
                            <h5 class="card-title">Easy Reporting</h5>
                            <p class="card-text">Quick and simple process to report lost or found items with detailed descriptions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                <i class="fas fa-search fs-4"></i>
                            </div>
                            <h5 class="card-title">Smart Search</h5>
                            <p class="card-text">Advanced search features to help you find exactly what you're looking for.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                <i class="fas fa-handshake fs-4"></i>
                            </div>
                            <h5 class="card-title">Community Driven</h5>
                            <p class="card-text">Connect with local community members to recover lost items safely.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Items Section -->
        <div class="bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-4">Recently Reported Items</h2>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm">
                            <div class="overflow-hidden" style="height: 200px;">
                                <img src="Resources/item1.JPG" class="card-img-top img-fluid" alt="Lost Item" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div class="card-body">
                                <span class="badge bg-danger mb-2">Lost</span>
                                <h5 class="card-title">Blue Backpack</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> Central Park<br>
                                    <strong>Date Reported:</strong> February 14th
                                </p>
                                <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm">
                            <div class="overflow-hidden" style="height: 200px;">
                                <img src="Resources/item2.jpg" class="card-img-top img-fluid" alt="Found Item" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div class="card-body">
                                <span class="badge bg-success mb-2">Found</span>
                                <h5 class="card-title">House Keys</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> Downtown Coffee Shop<br>
                                    <strong>Date Reported:</strong> February 13th
                                </p>
                                <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm">
                            <div class="overflow-hidden" style="height: 200px;">
                                <img src="Resources/item3.jpg" class="card-img-top img-fluid" alt="Lost Item" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div class="card-body">
                                <span class="badge bg-danger mb-2">Lost</span>
                                <h5 class="card-title">iPhone 13</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> Metro Station<br>
                                    <strong>Date Reported:</strong> February 12th
                                </p>
                                <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm">
                            <div class="overflow-hidden" style="height: 200px;">
                                <img src="Resources/item4.jpg" class="card-img-top img-fluid" alt="Found Item" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div class="card-body">
                                <span class="badge bg-success mb-2">Found</span>
                                <h5 class="card-title">Wallet</h5>
                                <p class="card-text">
                                    <strong>Location:</strong> City Mall food court<br>
                                    <strong>Date Reported:</strong> February 11th
                                </p>
                                <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- "View More" Button -->
                <div class="text-center mt-4">
                    <button class="btn btn-primary btn-lg px-4">View More Items</button>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">Ready to Find Your Lost Items?</h2>
                    <p class="lead mb-4">Join our community today and increase your chances of recovering lost items.</p>
                    <button class="btn btn-primary btn-lg px-4">Get Started</button>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
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
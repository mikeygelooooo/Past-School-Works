<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-lg sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="index.php" style="font-family: 'Lobster';">
                <h4 class="mb-0">
                    <i class="fas fa-boxes-packing"></i>FindMyStuff
                </h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home me-1"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="reports.php">
                            <i class="fas fa-search me-1"></i>
                            Browse
                        </a>
                    </li>
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus-circle me-1"></i>Report
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="report-lost.php">
                                    <i class="fas fa-exclamation-circle text-danger me-2"></i>Report Lost Item
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="report-found.php">
                                    <i class="fas fa-check-circle text-success me-2"></i>Report Found Item
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php include "Scripts/database.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FindMyStuff Admin</title>
    <link rel="icon" href="Resources/logo.svg">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <nav class="main-header navbar navbar-expand navbar-dark bg-dark shadow-lg sticky-top px-3">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars fs-5"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item me-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-comment-dots fs-5"></i>
                </a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-bell fs-5"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link mb-0">
                            <i class="nav-icon fas fa-boxes-packing fs-5"></i>
                            <p class="fs-5 ms-1" style="font-family: 'Lobster';">FindMyStuff</p>
                        </a>
                    </li>

                    <hr class="border border-white border-1 opacity-50">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Manage Items</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-flag"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <main class="content-wrapper">
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>185</h3>
                            <p>Total Items</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>85</h3>
                            <p>Resolved Reports</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>100</h3>
                            <p>Pending Reports</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>154</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Recent Item Reports</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item</th>
                                <th class="text-center">Status</th>
                                <th>Location</th>
                                <th class="text-center">Date Reported</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM REPORTS ORDER BY date_reported DESC";
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) :
                                $report_id = $row["report_id"]
                            ?>
                                <tr class="align-middle">
                                    <td><?php echo $row['report_id'] ?></td>
                                    <td><?php echo $row['item_name'] ?></td>
                                    <td class="text-center">
                                        <?php if ($row['report_type'] == "lost") : ?>
                                            <span class="badge bg-danger">Lost</span>
                                        <?php else : ?>
                                            <span class="badge bg-success">Found</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['location'] ?></td>
                                    <td class="text-center"><?php echo $row['date_reported'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-dark me-1" data-bs-toggle="modal" data-bs-target="#report<?php echo $report_id ?>">
                                            <i class="fas fa-circle-info"></i>
                                        </button>
                                        <div class="modal fade" id="report<?php echo $report_id ?>" tabindex="-1">
                                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content text-start text-wrap">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Report #<?php echo $report_id ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-4">
                                                            <div class="col-md-6">
                                                                <h6 class="border-bottom pb-2">Item Details</h6>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Item Name</label>
                                                                    <p><?php echo $row['item_name'] ?></p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Description</label>
                                                                    <p><?php echo $row['item_description'] ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6 class="border-bottom pb-2">Location & Contact</h6>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Item Location</label>
                                                                    <p><?php echo $row['location'] ?></p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Reporter</label>
                                                                    <p><?php echo $row['reporter_name'] ?></p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Reporter Contact</label>
                                                                    <p><?php echo $row['reporter_contact'] ?></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-md-6">
                                                                <h6 class="border-bottom pb-2">Date Information</h6>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Date Reported</label>
                                                                    <p><?php echo $row['date_reported'] ?></p>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold">Date of Event</label>
                                                                    <p><?php echo $row['date_event'] ?></p>
                                                                </div>
                                                            </div>
                                                            <?php if ($row['report_type'] == 'found') : ?>
                                                                <div class="col-md-6">
                                                                    <h6 class="border-bottom pb-2">Status Information</h6>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Current Location</label>
                                                                        <?php if ($row['current_location'] == 'withMe') : ?>
                                                                            <p>With the Reporter</p>
                                                                        <?php elseif ($row['current_location'] == 'security') : ?>
                                                                            <p>With Security Personnel</p>
                                                                        <?php elseif ($row['current_location'] == 'lostFound') : ?>
                                                                            <p>With Lost & Found Office</p>
                                                                        <?php elseif ($row['current_location'] == 'other') : ?>
                                                                            <p>Other Location</p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Owner Verification Method</label>
                                                                        <p><?php echo $row['owner_verification'] ?></p>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="report-edit.php?report_id=<?php echo $report_id ?>" class="btn btn-sm btn-outline-dark me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Delete Button -->
                                        <a class="btn btn-sm btn-outline-danger" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $report_id ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $report_id ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this report?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <a href="Scripts/delete.php?report_id=<?php echo $report_id ?>" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a href="index.php#report" class="btn btn-outline-primary">Add Report</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="main-footer bg-dark text-light">
        © 2025 <span style="font-family: 'Lobster';">FindMyStuff</span>. All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <a href="privacy-policy.php" class="text-light text-decoration-none">Privacy Policy</a>
                </li>
                <li class="list-inline-item">
                    <a href="terms-of-service.php" class="text-light text-decoration-none">Terms of Service</a>
                </li>
            </ul>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
</body>

</html>
<?php include "Scripts/database.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FindMyStuff | Browse Reports</title>
    <link rel="icon" href="Resources/logo.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/flatly/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <?php include 'Components/header.php' ?>

    <main>
        <?php if (isset($_GET["msg"])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <section class="bg-body-tertiary py-5" id="search">
            <div class="container">
                <div class="row justify-content-center text-center mb-4">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-3">Find What You've Lost</h1>
                        <p class="lead mb-4">Our community helps reunite people with their lost belongings every day</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="bg-white p-4 rounded shadow">
                            <form class="row g-3">
                                <div class="col-md-5">
                                    <select class="form-select form-select-lg">
                                        <option selected>I'm looking for...</option>
                                        <option>Lost Items</option>
                                        <option>Found Items</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control form-control-lg" placeholder="Keywords (phone, wallet, keys...)">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light py-5" id="recent">
            <div class="container">
                <div class="text-center mb-4">
                    <h2 class="h2 mb-0">Reported Items</h2>
                </div>

                <div class="row g-4">
                    <?php
                    $sql = "SELECT * FROM REPORTS ORDER BY date_reported DESC";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) :
                        $report_id = $row["report_id"]
                    ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="card border-0 shadow h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['item_name'] ?></h5>

                                    <?php if ($row['report_type'] == "lost") : ?>
                                        <p class="badge bg-danger">Lost</p>
                                    <?php else : ?>
                                        <p class="badge bg-success">Found</p>
                                    <?php endif; ?>

                                    <p class="card-text text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i> <?php echo $row['location'] ?>
                                        <br>
                                        <i class="far fa-calendar-alt me-1"></i> <?php echo $row['date_event'] ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#report<?php echo $report_id ?>">
                                        View Details
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
                                                <div class="modal-footer">
                                                    <a href="report-edit.php?report_id=<?php echo $report_id ?>" class="btn btn-secondary">Edit</a>
                                                    <a href="Scripts/delete.php?report_id=<?php echo $report_id ?>" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'Components/footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
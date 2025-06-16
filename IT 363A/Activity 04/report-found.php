<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FindMyStuff | Found Item Report</title>
    <link rel="icon" href="Resources/logo.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/flatly/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <?php include 'Components/header.php' ?>

    <main>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Report Found Item</h4>
                        </div>
                        <div class="card-body bg-body-tertiary">
                            <form method="post" action="Scripts/add.php">
                                <input type="hidden" name="report_type" value="found">
                                <div class="mb-3">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" class="form-control" name="reporter_name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Contact (Email or Phone)</label>
                                    <input type="text" class="form-control" name="reporter_contact" required>
                                </div>

                                <!-- Item Info -->
                                <div class="mb-3">
                                    <label class="form-label">Item Name</label>
                                    <input type="text" class="form-control" name="item_name" placeholder="e.g. Blue Backpack" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="item_description" rows="2" placeholder="Color, brand, identifying features"></textarea>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Date Found</label>
                                        <input type="date" class="form-control" name="date_event" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Location Found</label>
                                        <input type="text" class="form-control" name="location" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Current Item Location</label>
                                    <select class="form-control" name="current_location" required>
                                        <option selected disabled>Select location</option>
                                        <option value="withMe">Still with me</option>
                                        <option value="lostFound">Turned in to Lost & Found</option>
                                        <option value="security">Turned in to Security</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">How can the owner verify this is their item?</label>
                                    <input type="text" class="form-control" name="owner_verification" placeholder="What specific details should the owner know?">
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Submit Report</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'Components/footer.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
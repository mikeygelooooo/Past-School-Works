<div class="col">
    <div class="card bg-dark text-white h-100 d-flex flex-column">
        <img src="../Resources/Display/<?= htmlspecialchars($accessory['acs_photo']) ?>" class="card-img-top" alt="<?= htmlspecialchars($accessory['acs_name']) ?>">
        <div class="card-body d-flex flex-column text-center px-2">
            <div class="flex-grow-1">
                <h3 class="fs-4 fw-semibold"><?= htmlspecialchars($accessory['acs_name']) ?></h3>
                <p class="fs-5 fw-semibold mb-3">₱ <?= number_format($accessory['acs_price'], 2, '.', ',') ?></p>
            </div>
            <div class="mt-auto">
                <button type="button" class="btn btn-outline-light border-3 fw-semibold fs-6" data-bs-toggle="modal" data-bs-target="#accessoryModalA<?= $accessory_id ?>F<?= $filter ?>">
                    Purchase
                </button>
            </div>
        </div>
    </div>

    <?php include 'accessory-details.php'; ?>
</div>
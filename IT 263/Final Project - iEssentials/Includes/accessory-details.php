<div class="modal fade" id="accessoryModalA<?= $accessory_id ?>F<?= $filter ?>" tabindex="-1" aria-labelledby="accessoryModalLabel<?= $accessory_id ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl modal-fullscreen-md-down">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header px-4">
                <h2 class="modal-title fs-2 fw-bold" id="accessoryModalLabel<?= $accessory_id ?>"><?= htmlspecialchars($accessory["acs_name"]) ?></h2>
                <button type="button" class="btn text-white fs-4" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body container p-3">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <img src="../Resources/Display/<?= htmlspecialchars($accessory["acs_photo"]) ?>" alt="<?= htmlspecialchars($accessory["acs_name"]) ?>" class="img-fluid border border-2 border-black rounded mb-3">
                    </div>
                    <div class="col-lg-9 mb-3">
                        <h3 class="fs-5 fw-semibold">Accessory Overview</h3>
                        <p class="fs-6"><?= nl2br(htmlspecialchars($accessory["acs_description"])) ?></p>
                        <p class="fs-5 fw-semibold">
                            Price: <span class="fw-normal">₱ <?= number_format($accessory["acs_price"], 2, '.', ',') ?></span>
                        </p>
                    </div>
                </div>

                <?php include "order-form.php" ?>
            </div>
            <div class="modal-footer">
                <?php if (isset($_SESSION["cust_id"])) : ?>
                    <button type="submit" form="purchaseA<?= $accessory_id ?>F<?= $filter ?>" class="btn btn-lg btn-outline-secondary p-3">Add to Cart</button>
                    <button type="button" class="btn btn-lg btn-secondary p-3" onclick="passInput(<?= $accessory_id ?>, <?= $filter ?>, <?= $accessory['acs_price'] ?>)">Check Out</button>
                <?php else : ?>
                    <button type="button" class="btn btn-lg btn-outline-secondary p-3" onclick="document.location='account-forms.php'">Add to Cart</button>
                    <button type="button" class="btn btn-lg btn-secondary p-3" onclick="document.location='account-forms.php'">Check Out</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include "direct-checkout.php" ?>
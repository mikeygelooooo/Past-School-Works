<div class="modal fade" id="checkoutModalA<?= $accessory_id ?>F<?= $filter ?>" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h2 class="modal-title fs-2 fw-bold">Check Out</h2>
                <button type="button" class="btn text-white fs-4" data-bs-dismiss="modal" onclick="backToAccessoryModal(<?= $accessory_id ?>, <?= $filter ?>)">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4">
                        <img src="../Resources/Display/<?= htmlspecialchars($accessory['acs_photo']) ?>" class="img-fluid border border-2 border-black rounded" alt="Accessory Image">
                    </div>
                    <div class="col-xl-8">
                        <form id="checkoutA<?= $accessory_id ?>F<?= $filter ?>" method="post" action="../PHP/checkout.php">
                            <input type="hidden" name="order-customer" value="<?= $_SESSION['cust_id'] ?>">
                            <input type="hidden" name="order-accessory" value="<?= $accessory_id ?>">
                            <h3 class="fs-3 fw-bold text-center"><?= htmlspecialchars($accessory['acs_name']) ?></h3>
                            <p class="fs-5 fw-semibold text-center">
                                ₱ <?= number_format($accessory['acs_price'], 2, '.', ',') ?>
                            </p>
                            <h4 class="fs-5 fw-semibold">Order Specifications:</h4>
                            <div class="row">
                                <?php if ($accessory['acs_id'] > 0 && $accessory['acs_id'] < 4) : ?>
                                    <div class="col-lg-6">
                                        <p class="fs-6">iPhone Model</p>
                                        <p class="form-control" id="model-display-A<?= $accessory_id ?>F<?= $filter ?>"></p>
                                        <input type="hidden" id="model-checkoutA<?= $accessory_id ?>F<?= $filter ?>" name="order-model">
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="order-model" value="0">
                                <?php endif; ?>

                                <?php if ($accessory['acs_id'] != 1) : ?>
                                    <div class="col-lg-6">
                                        <p class="fs-6">Color</p>
                                        <p class="form-control" id="color-display-A<?= $accessory_id ?>F<?= $filter ?>"></p>
                                        <input type="hidden" id="color-checkoutA<?= $accessory_id ?>F<?= $filter ?>" name="order-color">
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="order-color" value="0">
                                <?php endif; ?>
                            </div>
                            <h4 class="fs-5 fw-semibold mt-4">Payment Details:</h4>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <p class="fs-6">Quantity</p>
                                    <input type="text" class="form-control" id="quantity-checkoutA<?= $accessory_id ?>F<?= $filter ?>" name="order-quantity" readonly>
                                </div>
                                <div class="col-lg-6">
                                    <p class="fs-6">Total</p>
                                    <p class="form-control" id="total-display-A<?= $accessory_id ?>F<?= $filter ?>"></p>
                                    <input type="hidden" id="total-checkoutA<?= $accessory_id ?>F<?= $filter ?>" name="order-total">
                                </div>
                            </div>
                            <h4 class="fs-5 fw-semibold mt-4">Delivery Details:</h4>
                            <div class="row">
                                <?php
                                $current_date = date('Y-m-d');
                                $delivery_date = date('Y-m-d', strtotime('+7 days'));
                                ?>
                                <div class="col-lg-6">
                                    <p class="fs-6">Payment Method</p>
                                    <p class="form-control">Cash on Delivery</p>
                                </div>
                                <input type="hidden" name="order-date" value="<?= $current_date ?>">
                                <div class="col-lg-6">
                                    <p class="fs-6">Delivery Date</p>
                                    <input type="date" class="form-control" name="order-delivery" value="<?= $delivery_date ?>" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="checkoutFooterA<?= $accessory_id ?>F<?= $filter ?>">
                <button type="button" class="btn btn-lg btn-outline-secondary p-3" onclick="backToAccessoryModal(<?= $accessory_id ?>, <?= $filter ?>)">Cancel</button>
                <button type="button" class="btn btn-lg btn-secondary p-3" onclick="showConfirmation(<?= $accessory_id ?>, <?= $filter ?>)">Confirm</button>
            </div>
            <div class="modal-footer d-none" id="confirmFooterA<?= $accessory_id ?>F<?= $filter ?>">
                <p class="me-auto">Are you sure you want to place this order?</p>
                <button type="button" class="btn btn-lg btn-outline-secondary p-3" onclick="hideConfirmation(<?= $accessory_id ?>, <?= $filter ?>)">Back</button>
                <button type="submit" form="checkoutA<?= $accessory_id ?>F<?= $filter ?>" class="btn btn-lg btn-secondary p-3">Place Order</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmation(accessoryId, filter) {
        document.getElementById(`checkoutFooterA${accessoryId}F${filter}`).classList.add('d-none');
        document.getElementById(`confirmFooterA${accessoryId}F${filter}`).classList.remove('d-none');
    }

    function hideConfirmation(accessoryId, filter) {
        document.getElementById(`confirmFooterA${accessoryId}F${filter}`).classList.add('d-none');
        document.getElementById(`checkoutFooterA${accessoryId}F${filter}`).classList.remove('d-none');
    }
</script>
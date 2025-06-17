<?php

/**
 * Checkout Modal for Cart Items
 * 
 * This template displays a modal for checking out items from the cart.
 * It includes product details, order specifications, payment details,
 * and delivery information.
 */
?>

<div class="modal fade" id="checkoutModalCart<?= $cart_id ?>" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h2 class="modal-title fs-2 fw-bold">Check Out</h2>
                <button type="button" class="btn text-white fs-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4">
                        <img src="../Resources/Display/<?= htmlspecialchars($cart_item['acs_photo']) ?>" class="img-fluid border border-2 border-black rounded" alt="Product Image">
                    </div>
                    <div class="col-xl-8">
                        <form id="checkoutCart<?= $cart_id ?>" method="post" action="../PHP/checkout.php">
                            <input type="hidden" name="order-customer" value="<?= $_SESSION['cust_id'] ?>">
                            <input type="hidden" name="order-accessory" value="<?= $cart_item['acs'] ?>">
                            <h3 class="fs-3 fw-bold text-center"><?= htmlspecialchars($cart_item['acs_name']) ?></h3>
                            <p class="fs-5 fw-semibold text-center">
                                ₱ <?= number_format($cart_item['total'], 2, '.', ',') ?>
                            </p>
                            <h4 class="fs-5 fw-semibold">Order Specifications:</h4>
                            <div class="row">
                                <?php if (isset($cart_item['model'])) : ?>
                                    <div class="col-lg-6">
                                        <p class="fs-6">iPhone Model</p>
                                        <p class="form-control"><?= htmlspecialchars($cart_item['model_name']) ?></p>
                                        <input type="hidden" name="order-model" value="<?= $cart_item['model'] ?>">
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="order-model" value="0">
                                <?php endif; ?>

                                <?php if (isset($cart_item['color'])) : ?>
                                    <div class="col-lg-6">
                                        <p class="fs-6">Color</p>
                                        <p class="form-control"><?= htmlspecialchars($cart_item['color_name']) ?></p>
                                        <input type="hidden" name="order-color" value="<?= $cart_item['color'] ?>">
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="order-color" value="0">
                                <?php endif; ?>
                            </div>
                            <h4 class="fs-5 fw-semibold mt-4">Payment Details:</h4>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <p class="fs-6">Quantity</p>
                                    <input type="text" class="form-control" name="order-quantity" value="<?= $cart_item['quantity'] ?>" readonly>
                                </div>
                                <div class="col-lg-6">
                                    <p class="fs-6">Total</p>
                                    <p class="form-control">₱ <?= number_format($cart_item['total'], 2, '.', ',') ?></p>
                                    <input type="hidden" name="order-total" value="<?= $cart_item['total'] ?>">
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
                            <input type="hidden" name="cart-id" value="<?= $cart_id ?>">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="checkoutFooterCart<?= $cart_id ?>">
                <button type="button" class="btn btn-lg btn-outline-secondary p-3" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-lg btn-secondary p-3" onclick="showConfirmationCart(<?= $cart_id ?>)">Confirm</button>
            </div>
            <div class="modal-footer d-none" id="confirmFooterCart<?= $cart_id ?>">
                <p class="me-auto">Are you sure you want to place this order?</p>
                <button type="button" class="btn btn-lg btn-outline-secondary p-3" onclick="hideConfirmationCart(<?= $cart_id ?>)">Back</button>
                <button type="submit" form="checkoutCart<?= $cart_id ?>" class="btn btn-lg btn-secondary p-3">Place Order</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmationCart(cartId) {
        document.getElementById(`checkoutFooterCart${cartId}`).classList.add('d-none');
        document.getElementById(`confirmFooterCart${cartId}`).classList.remove('d-none');
    }

    function hideConfirmationCart(cartId) {
        document.getElementById(`confirmFooterCart${cartId}`).classList.add('d-none');
        document.getElementById(`checkoutFooterCart${cartId}`).classList.remove('d-none');
    }
</script>
<div class="row row-cols-1 row-cols-xl-2 g-4">
    <?php if (mysqli_num_rows($result) > 0) : ?>
        <?php while ($cart_item = mysqli_fetch_assoc($result)) : ?>
            <?php
            $cart_id = $cart_item['cart_id'];
            $acs_name = htmlspecialchars($cart_item['acs_name']);
            $acs_photo = htmlspecialchars($cart_item['acs_photo']);
            $quantity = intval($cart_item['quantity']);
            $total = number_format($cart_item['total'], 2);
            ?>
            <div class="col">
                <div class="card bg-dark text-white h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-5">
                            <img src="../Resources/Display/<?php echo $acs_photo; ?>" class="img-fluid rounded" alt="<?php echo $acs_name; ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body d-flex flex-column h-100">
                                <div>
                                    <p class="fs-5 fw-semibold mb-2"><?php echo $acs_name; ?></p>
                                    <?php if (isset($cart_item['model'])) : ?>
                                        <p class="fs-6 fw-semibold mb-1">Model: <?php echo htmlspecialchars($cart_item['model_name']); ?></p>
                                    <?php endif; ?>
                                    <?php if (isset($cart_item['color'])) : ?>
                                        <p class="fs-6 fw-semibold mb-1">Color: <?php echo htmlspecialchars($cart_item['color_name']); ?></p>
                                    <?php endif; ?>
                                    <p class="fs-6 fw-semibold mb-1">Quantity: <?php echo $quantity; ?></p>
                                    <p class="fs-6 fw-semibold mb-1">Total: ₱ <?php echo $total; ?></p>
                                </div>
                                <div class="mt-auto d-flex justify-content-end">
                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-outline-light fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#confirmDelete<?php echo $cart_id; ?>">
                                        Delete
                                    </button>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="confirmDelete<?php echo $cart_id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-dark text-white">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Confirm Removal From Cart</h1>
                                                    <button type="button" class="btn text-white fs-6" data-bs-dismiss="modal">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to remove this item from your cart?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-secondary fw-medium" onclick="location.href='../PHP/delete-from-cart.php?cart_id=<?php echo $cart_id; ?>'">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-outline-light fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#cartModal<?php echo $cart_id; ?>">
                                        Edit
                                    </button>

                                    <!-- Checkout Button -->
                                    <button type="button" class="btn btn-light fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#checkoutModalCart<?php echo $cart_id; ?>">
                                        Check Out
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // Include edit cart form and checkout modal
                include "../Includes/edit-cart-form.php";
                include "cart-checkout.php";
                ?>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="col-12 text-center">
            <h3 class="text-white text-center">Cart is empty</h3>
        </div>
    <?php endif; ?>
</div>
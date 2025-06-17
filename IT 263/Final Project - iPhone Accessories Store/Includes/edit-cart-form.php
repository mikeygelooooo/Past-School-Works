<div class="modal fade" id="cartModal<?= $cart_id ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-md-down">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header px-4">
                <p class="modal-title fs-2 fw-bold"><?= htmlspecialchars($cart_item["acs_name"]) ?></p>
                <button type="button" class="btn text-white fs-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body container p-3">
                <div class="row">
                    <div class="col-lg-5 mb-3">
                        <img src="../Resources/Display/<?= htmlspecialchars($cart_item["acs_photo"]) ?>" class="img-fluid border border-2 border-black rounded mb-3" alt="<?= htmlspecialchars($cart_item["acs_name"]) ?>">
                    </div>
                    <div class="col-lg-7 mb-3">
                        <form id="cartEdit<?= $cart_id ?>" method="post" action="../PHP/edit-cart-item.php">
                            <input type="hidden" name="cart-id" value="<?= $cart_item['cart_id'] ?>">
                            <input type="hidden" name="cart-accessory" value="<?= $cart_item['acs'] ?>">
                            <p class="fs-2 fw-bold">Order Details:</p>
                            <div class="mb-2">
                                <p class="fs-5">Quantity</p>
                                <input required type="number" class="form-control" name="cart-quantity" placeholder="Enter Quantity" min="1" value="<?= intval($cart_item['quantity']) ?>">
                            </div>
                            <?php if ($cart_item["acs"] > 0 && $cart_item["acs"] < 4) : ?>
                                <div class="mb-2">
                                    <p class="fs-5">iPhone Model</p>
                                    <select required class="form-select" name="cart-model">
                                        <option value="">Choose Model</option>
                                        <?php
                                        $model_query = "SELECT * FROM Models";
                                        $model_result = mysqli_query($connection, $model_query);

                                        while ($model = mysqli_fetch_assoc($model_result)) : ?>
                                            <option value="<?= $model["model_id"] ?>" <?= ($model["model_id"] == $cart_item["model"]) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($model["model_name"]) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="cart-model" value="0">
                            <?php endif; ?>

                            <?php if ($cart_item["acs"] != 1) : ?>
                                <div class="mb-2">
                                    <p class="fs-5">Color</p>
                                    <select required class="form-select" name="cart-color">
                                        <option value="">Choose Color</option>
                                        <?php
                                        $color_query = "SELECT * FROM Colors";
                                        $color_result = mysqli_query($connection, $color_query);

                                        while ($color = mysqli_fetch_assoc($color_result)) : ?>
                                            <option value="<?= $color["color_id"] ?>" <?= ($color["color_id"] == $cart_item["color"]) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($color["color_name"]) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="cart-color" value="0">
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="editFooterCart<?= $cart_id ?>">
                <button type="button" class="btn btn-lg btn-outline-secondary p-3" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-lg btn-secondary p-3" onclick="showConfirmationEdit(<?= $cart_id ?>)">Confirm Edit</button>
            </div>
            <div class="modal-footer d-none" id="confirmFooterEdit<?= $cart_id ?>">
                <p class="me-auto">Are you sure you want to save these changes?</p>
                <button type="button" class="btn btn-lg btn-outline-secondary p-3" onclick="hideConfirmationEdit(<?= $cart_id ?>)">Back</button>
                <button type="submit" form="cartEdit<?= $cart_id ?>" class="btn btn-lg btn-secondary p-3">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmationEdit(cartId) {
        document.getElementById(`editFooterCart${cartId}`).classList.add('d-none');
        document.getElementById(`confirmFooterEdit${cartId}`).classList.remove('d-none');
    }

    function hideConfirmationEdit(cartId) {
        document.getElementById(`confirmFooterEdit${cartId}`).classList.add('d-none');
        document.getElementById(`editFooterCart${cartId}`).classList.remove('d-none');
    }
</script>
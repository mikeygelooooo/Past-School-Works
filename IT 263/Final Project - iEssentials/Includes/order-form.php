<div class="row">
    <div class="col-12">
        <p class="fs-4 fw-semibold">Order Specifications</p>
    </div>

    <!-- Order form -->
    <form id="purchaseA<?= $accessory_id ?>F<?= $filter ?>" method="post" action="../PHP/add-to-cart.php">
        <?php if (isset($_SESSION["cust_id"])) : ?>
            <input type="hidden" name="order-customer" value="<?= htmlspecialchars($_SESSION["cust_id"]) ?>">
        <?php endif; ?>
        <input type="hidden" name="order-accessory" value="<?= htmlspecialchars($accessory_id) ?>">

        <div class="row">
            <!-- Quantity input -->
            <div class="col-lg-4 mb-3">
                <p class="fs-5">Quantity</p>
                <input required type="number" id="quantity-inputA<?= $accessory_id ?>F<?= $filter ?>" class="form-control" name="order-quantity" placeholder="Enter Quantity" min="1" value="1">
            </div>

            <?php if ($accessory["acs_id"] > 0 && $accessory["acs_id"] < 4) : ?>
                <!-- iPhone Model selection -->
                <div class="col-lg-4 mb-3">
                    <p class="fs-5">iPhone Model</p>
                    <select required class="form-select" id="model-inputA<?= $accessory_id ?>F<?= $filter ?>" name="order-model">
                        <option value="">Choose Model</option>
                        <?php
                        $model_query = "SELECT * FROM Models";
                        $model_result = mysqli_query($connection, $model_query);

                        while ($model = mysqli_fetch_assoc($model_result)) : ?>
                            <option value="<?= htmlspecialchars($model["model_id"]) ?>">
                                <?= htmlspecialchars($model["model_name"]) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            <?php else : ?>
                <input type="hidden" name="order-model" value="0">
            <?php endif; ?>

            <?php if ($accessory["acs_id"] != 1) : ?>
                <!-- Color selection -->
                <div class="col-lg-4 mb-3">
                    <p class="fs-5">Color</p>
                    <select required class="form-select" id="color-inputA<?= $accessory_id ?>F<?= $filter ?>" name="order-color">
                        <option value="">Choose Color</option>
                        <?php
                        $color_query = "SELECT * FROM Colors";
                        $color_result = mysqli_query($connection, $color_query);

                        while ($color = mysqli_fetch_assoc($color_result)) : ?>
                            <option value="<?= htmlspecialchars($color["color_id"]) ?>">
                                <?= htmlspecialchars($color["color_name"]) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            <?php else : ?>
                <input type="hidden" name="order-color" value="0">
            <?php endif; ?>
        </div>
    </form>
</div>
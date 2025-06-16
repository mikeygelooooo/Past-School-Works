<section class="tab-pane container-fluid py-5 text-white" id="history" role="tabpanel">
    <div class="row row-cols-1 row-cols-xl-2 g-4">
        <?php
        // Query to fetch order history
        $query = "SELECT o.*, a.acs_name, a.acs_photo, m.model_name, c.color_name 
                  FROM Orders o
                  JOIN Accessories a ON o.acs = a.acs_id
                  LEFT JOIN Models m ON o.model = m.model_id
                  LEFT JOIN Colors c ON o.color = c.color_id
                  WHERE o.cust = ?
                  ORDER BY o.order_id DESC";

        // Prepare and execute the query
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $session_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) :
            while ($order = mysqli_fetch_assoc($result)) : ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="../Resources/Display/<?= htmlspecialchars($order['acs_photo']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($order['acs_name']) ?>">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <p class="fs-5 fw-semibold mb-2"><?= htmlspecialchars($order["acs_name"]) ?></p>
                                    <?php if (!empty($order["model_name"])) : ?>
                                        <p class="fs-6 fw-semibold mb-1">Model: <?= htmlspecialchars($order["model_name"]) ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($order["color_name"])) : ?>
                                        <p class="fs-6 fw-semibold mb-1">Color: <?= htmlspecialchars($order["color_name"]) ?></p>
                                    <?php endif; ?>
                                    <p class="fs-6 fw-semibold mb-1">Quantity: <?= htmlspecialchars($order["quantity"]) ?></p>
                                    <p class="fs-6 fw-semibold mb-1">Total: ₱ <?= number_format($order["total"], 2) ?></p>
                                    <p class="fs-6 fw-semibold mb-1">Order Date: <?= htmlspecialchars($order["order_date"]) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <div class="col-12 text-center">
                <h3>Order history is empty</h3>
            </div>
        <?php endif;

        mysqli_stmt_close($stmt);
        ?>
    </div>
</section>
<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// Function to check if a page is active
function isActive($page) {
    global $current_page;
    return $current_page === $page ? 'active' : '';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="box-shadow: 0 6px 20px 0 rgba(0,0,0,.2);">
    <div class="container-fluid px-3">
        <!-- Logo and Brand Name -->
        <a class="navbar-brand" href="../index.php">
            <img class="nav-logo" src="../Resources/logo.png" alt="iEssentials Logo">
            <span class="fs-3 fw-semibold align-middle">iEssentials</span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive('accessories.php'); ?>" href="accessories.php">
                        <span class="fs-5 fw-medium px-2">Accessories</span>
                    </a>
                </li>
                
                <?php if (isset($_SESSION["cust_id"])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isActive('shoppingcart.php'); ?>" href="shoppingcart.php">
                            <span class="fs-5 fw-medium px-2">Cart</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo isActive(isset($_SESSION["cust_id"]) ? 'account.php' : 'account-forms.php'); ?>" 
                       href="<?php echo isset($_SESSION["cust_id"]) ? 'account.php' : 'account-forms.php'; ?>">
                        <span class="fs-5 fw-medium px-2">Account</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
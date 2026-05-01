<?php
session_start();
include "config/connection.php";
include "includes/head.php";
include "includes/nav.php";
?>

<div class="container my-5 py-5">
    
    <?php 
    if (isset($_GET['order']) && $_GET['order'] == 'success'): 
    ?>
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-check2-circle text-success fs-1"></i>
            </div>
            <h2 class="text-uppercase fw-bold mb-3">Order Placed Successfully!</h2>
            <p class="text-muted mb-4">Thank you for choosing Sensa Skin. Your glowing journey starts now.</p>
            <a href="shop.php" class="btn btn-dark rounded-0 px-5 py-3">CONTINUE SHOPPING</a>
        </div>

    <?php 
    elseif (!empty($_SESSION['cart'])): 
    ?>
        <h2 class="text-uppercase fw-bold mb-5 text-center">Your Shopping Cart</h2>
        <table class="table align-middle">
            <thead class="text-uppercase small border-bottom">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grandTotal = 0;
                foreach ($_SESSION['cart'] as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $grandTotal += $subtotal;
                ?>
                <tr>
                    <td>
                        <img src="assets/img/<?= $item['image'] ?>" width="50" class="me-3"/>
                        <span class="fw-bold text-uppercase small"><?= $item['name'] ?></span>
                    </td>
                    <td><?= number_format($item['price'], 2) ?> $</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center border quantity-wrapper">
                            <a href="logic/update_quantity.php?id=<?= $item['id'] ?>&action=minus" 
                               class="btn btn-sm btn-light rounded-0 border-end py-1 px-2 text-dark shadow-none">
                                <i class="bi bi-dash"></i>
                            </a>
                            <span class="px-3 fw-bold small"><?= $item['quantity'] ?></span>
                            <a href="logic/update_quantity.php?id=<?= $item['id'] ?>&action=plus" 
                               class="btn btn-sm btn-light rounded-0 border-start py-1 px-2 text-dark shadow-none">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>
                    </td>
                    <td><?= number_format($subtotal, 2) ?> $</td>
                    <td>
                        <a href="logic/remove_item.php?id=<?= $item['id'] ?>" class="text-danger text-decoration-none">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-5">
            <h4 class="fw-bold">GRAND TOTAL: <?= number_format($grandTotal, 2) ?> $</h4>
            
            <?php if(isset($_SESSION['user'])): ?>
                <a href="logic/process_checkout.php" class="btn btn-dark rounded-0 px-5 py-2">
                    PROCEED TO CHECKOUT
                </a>
            <?php else: ?>
                <div class="d-flex align-items-center">
                    <span class="text-muted small me-3">Please <a href="login.php" class="text-dark fw-bold">Login</a> to continue</span>
                    <a href="login.php?msg=auth_required" class="btn btn-outline-dark rounded-0 px-5 py-2">
                        CHECKOUT
                    </a>
                </div>
            <?php endif; ?>
        </div>

    <?php 
    else: 
    ?>
        <div class="text-center py-5">
            <p class="lead text-muted">Your cart is empty.</p>
            <a href="shop.php" class="btn btn-outline-dark rounded-0 mt-3">BACK TO SHOP</a>
        </div>
    <?php endif; ?>

</div>

<?php include "includes/footer.php"; ?>
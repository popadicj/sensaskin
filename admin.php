<?php
session_start();
require_once "config/connection.php";
if(!isset($_SESSION['user']) || $_SESSION['user']->role_id != 1) {
    header("Location: index.php");
    exit;
}
require_once "includes/head.php";
require_once "includes/nav.php";
?>
<div class="container-fluid my-5" style="min-height: 70vh;">
    <div class="row">
        <div class="col-md-3 border-end">
            <h4 class="mb-4">Admin Dashboard</h4>
            <div class="list-group">
                <a href="admin.php?page=products" class="list-group-item list-group-item-action">
                    <i class="bi bi-box-seam me-3 text-secondary"></i> Manage Products
                </a>
                <a href="admin.php?page=messages" class="list-group-item list-group-item-action">
                    <i class="bi bi-envelope me-3 text-secondary"></i> Customer Messages
                </a>
                <a href="admin.php?page=users" class="list-group-item list-group-item-action">
                    <i class="bi bi-people me-3 text-secondary"></i> User List
                </a>
                <a href="admin.php?page=polls" class="list-group-item bg-light">
                    <i class="bi bi-bar-chart-fill me-3 text-secondary"></i> Poll Statistics</a>
            </div>
        </div>
        <div class="col-md-9 px-4">
            <?php 
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
                switch($page) {
                    case 'products':
                        include "includes/admin_products.php";
                        break;
                    case 'messages':
                        include "includes/admin_messages.php";
                        break;
                    case 'users':
                        include "includes/admin_users.php";
                        break;
                    case 'polls':
                        include "logic/get_poll_results.php"; 
                        include "includes/admin_polls.php";
                        break;
                    default:
                        echo "<h2 class='mt-5'>Welcome, Admin!</h2><p>Select an option from the left to start managing Sensa Skin.</p>";
                        break;
                }
            ?>
        </div>
    </div>
</div>

<?php 
require_once "includes/footer.php";
?>
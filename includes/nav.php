<body>
    <div id="top-bar" class="d-flex flex-wrap align-items-center justify-content-between px-3 py-2 border-bottom bg-white">
        <div class="logo me-3">
            <h1 class="m-0">
                <a href="index.php" class="text-dark text-decoration-none" style="letter-spacing: 2px;">
                    SENSA SKIN
                </a>
            </h1>
        </div>
        <div class="search-container position-relative d-none d-md-block mx-auto">
            <form action="shop.php" method="GET">
                <input type="search" id="tbSearch" name="search"
                    class="form-control rounded-pill px-4"
                    placeholder="Search skincare..."
                    value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"/>
                <button type="submit"
                    class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent pe-3">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
        <div class="user-actions d-flex align-items-center gap-3 ms-auto">
            <?php if(isset($_SESSION['user'])): ?>
                <span class="user-name small text-muted d-none d-sm-inline">
                    Hello, <?= $_SESSION['user']->first_name ?>
                </span>
                 <a href="logic/logout.php" class="text-dark text-decoration-none small d-flex align-items-center gap-1">
                    <i class="bi bi-box-arrow-right nav-icon"></i>
                    <span class="d-none d-lg-inline">Logout</span>
                </a>
                <?php if($_SESSION['user']->role_id == 1): ?>
                    <a href="admin.php" class="text-dark text-decoration-none small d-flex align-items-center gap-1">
                        <i class="bi bi-gear-fill nav-icon"></i>
                        <span class="d-none d-lg-inline">Admin</span>
                    </a>
                <?php endif; ?>
           <?php else: ?>
                <a href="login.php" class="text-dark text-decoration-none small d-flex align-items-center gap-1">
                    <i class="bi bi-person-circle nav-icon"></i>
                    <span class="d-none d-lg-inline">Login</span>
                </a>
            <?php endif; ?>
             <a href="cart.php" class="nav-link d-flex align-items-center gap-1 p-0 m-0">
                <div class="position-relative d-inline-block">
                    <i class="bi bi-cart3 nav-icon"></i>
                    <span id="cart-count"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                        <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                    </span>
                </div>
                <span class="d-none d-lg-inline">Cart</span>
            </a>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light py-2">
        <div class="container-fluid"> 
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <?php
                    $query = "SELECT * FROM navigation ORDER BY position ASC";
                    $result = $conn->query($query);
                    $links = $result->fetchAll(); 
                    echo '<ul class="navbar-nav gap-lg-5">';
                    foreach($links as $link) {
                        echo '<li class="nav-item text-center">
                                <a class="nav-link text-uppercase small text-lg-center text-end text-dark px-3" href="' . $link->path . '">' . $link->label . '</a>
                            </li>';
                    }
                    echo '</ul>';
                ?> 
            </div>
        </div>
    </nav>
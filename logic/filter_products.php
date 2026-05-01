<?php
    require_once "../config/connection.php";

    $params = [];
    $query = "SELECT p.*, s.type_name, c.category_name 
              FROM products p
              JOIN skin_types s ON p.skin_type_id = s.id_skin_type
              JOIN categories c ON p.category_id = c.id_category
              WHERE 1=1";

    $search = "";
    if(isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
    } elseif(isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
    }

    if ($search != "") {
        $query .= " AND p.name LIKE ?";
        $params[] = "%$search%";
    }

    if(isset($_POST['skins']) && !empty($_POST['skins'])) {
        $skins = $_POST['skins']; 
        $placeholders = str_repeat('?,', count($skins) - 1) . '?';
        $query .= " AND p.skin_type_id IN ($placeholders)";
        foreach($skins as $s) { $params[] = $s; }
    }
    if(isset($_POST['cats']) && !empty($_POST['cats'])) {
        $cats = $_POST['cats'];
        $placeholders = str_repeat('?,', count($cats) - 1) . '?';
        $query .= " AND p.category_id IN ($placeholders)";
        foreach($cats as $c) { $params[] = $c; }
    }
    if(isset($_POST['price'])) {
        $query .= " AND p.price <= ?";
        $params[] = $_POST['price'];
    }
    $allowedSort = ['asc', 'desc'];
    if(isset($_POST['sort']) && in_array($_POST['sort'], $allowedSort)) {
        $order = ($_POST['sort'] == 'asc') ? 'ASC' : 'DESC';
        $query .= " ORDER BY p.price $order";
    }
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $products = $stmt->fetchAll();
    if(count($products) == 0) {
        echo "<div class='col-12 text-center my-5'><p class='text-muted'>No products found.</p></div>";
        exit;
    }
    foreach($products as $product): ?>
        <div class="col product-item">
            <div class="product-card h-100 text-center">
                <div class="product-img position-relative overflow-hidden">
                    <img src="assets/img/<?= $product->image ?>" alt="<?= $product->name ?>"/>
                </div>
                <div class="product-content pt-3">
                    <span class="skin-label small text-muted text-uppercase"><?= $product->type_name ?></span>
                    <h3 class="product-title h5 my-2"><?= $product->name ?></h3>
                    <p class="price fw-bold"><?= number_format($product->price, 2) ?> $</p>
                    <button class="add-to-cart btn btn-outline-dark rounded-0 w-100 py-2">Add to Cart</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
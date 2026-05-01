<?php 
session_start();
require_once "config/connection.php";
require_once "includes/head.php";
require_once "includes/nav.php";

$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$params = [];
$query = "SELECT p.*, p.id_product AS product_real_id, s.type_name, c.category_name 
          FROM products p
          JOIN skin_types s ON p.skin_type_id = s.id_skin_type
          JOIN categories c ON p.category_id = c.id_category
          WHERE 1=1";

if ($searchTerm !== "") {
    $query .= " AND p.name LIKE ?";
    $params[] = "%$searchTerm%";
}
$stmt = $conn->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(); 
$skinTypes = $conn->query("SELECT * FROM skin_types")->fetchAll();
$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>
<main class="container my-5">
    <div class="row align-items-start">
        <aside class="col-lg-3">
            <div class="filter-sidebar p-4 shadow-sm rounded-4">
                <h5 class="filter-title">Product Type</h5>
                <div class="mb-4">
                    <?php foreach($categories as $c): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input cat-filter" type="checkbox" value="<?= $c->id_category ?>" id="cat<?= $c->id_category ?>">
                            <label class="form-check-label" for="cat<?= $c->id_category ?>"><?= $c->category_name ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                </hr>
                <h5 class="filter-title">Skin Type</h5>
                <div class="mb-4">
                    <?php foreach($skinTypes as $s): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input skin-filter" type="checkbox" value="<?= $s->id_skin_type ?>" id="skin<?= $s->id_skin_type ?>">
                            <label class="form-check-label" for="skin<?= $s->id_skin_type ?>"><?= $s->type_name ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <h5 class="filter-title">Max Price</h5>
                <input type="range" class="form-range" id="priceRange" min="0" max="150" step="0.5" value="150"/>
                <span class="fw-bold" id="rangeValue">150</span>$
            </div>
        </aside>
        <section class="col-lg-9">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="products-display">
                <?php foreach($products as $product): ?>
                    <div class="col product-item">
                        <div class="product-card h-100">
                            <div class="product-img position-relative overflow-hidden">
                                <img src="assets/img/<?= $product->image ?>" class="w-100 h-100" alt="<?= $product->name ?>">
                            </div>

                            <div class="product-content pt-3 text-center">
                                <span class="skin-label text-uppercase text-muted small"><?= $product->type_name ?></span>
                                <h3 class="product-title h5 fw-bold my-2"><?= $product->name ?></h3>
                                <p class="price mb-3">
                                    <?php if(!empty($product->old_price) && $product->old_price > $product->price): ?>
                                        <span class="text-muted text-decoration-line-through me-2 small fw-light">
                                            <?= number_format($product->old_price, 2) ?> $
                                        </span>
                                    <?php endif; ?>
                                    <span class="fw-bold text-dark">
                                        <?= number_format($product->price, 2) ?> $
                                    </span>
                                </p>
                                <button type="button" 
                                        class="add-to-cart btn btn-outline-dark rounded-0 w-100 py-2 btn-add-ajax"
                                        data-id="<?= $product->product_real_id ?>"
                                        data-name="<?= $product->name ?>"
                                        data-price="<?= $product->price ?>"
                                        data-image="<?= $product->image ?>">
                                    Add to Cart
                                </button>
                                <div class="cart-notification-area"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>
<?php require_once "includes/footer.php"; ?>
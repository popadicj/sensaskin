<div class="d-flex justify-content-between align-items-center mb-4 my-5">
    <h3 class="fw-light">Sensa Skin Collection</h3>
    <button type="button" class="btn btn-dark btn-sm px-4" data-bs-toggle="modal" data-bs-target="#addProductModal">
        + Add New Product
    </button>
</div>
<div class="table-responsive bg-white shadow-sm rounded">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Popular</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM products ORDER BY id_product DESC";
            $products = $conn->query($query)->fetchAll();
            if(count($products) > 0):
                foreach($products as $p):
            ?>
            <tr id="product-row-<?= $p->id_product ?>">
                <td class="ps-4">
                    <img src="assets/img/<?= $p->image ?>" alt="<?= $p->name ?>" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                </td>
                <td>
                    <span class="fw-bold d-block"><?= $p->name ?></span>
                    <small class="text-muted">ID: #<?= $p->id_product ?></small>
                </td>
                <td><?= number_format($p->price, 2) ?> $</td>
                <td>
                    <?= $p->is_popular ? '<span class="badge bg-success-subtle text-success">Yes</span>' : '<span class="badge bg-light text-muted">No</span>' ?>
                </td>
                <td class="text-end pe-4">
                    <button type="button" class="btn btn-sm btn-outline-primary edit-product me-2 mb-1 mb-md-0" 
                            data-id="<?= $p->id_product ?>" 
                            data-name="<?= htmlspecialchars($p->name) ?>"
                            data-price="<?= $p->price ?>"
                            data-desc="<?= htmlspecialchars($p->description) ?>"
                            data-cat="<?= $p->category_id ?>"
                            data-skin="<?= $p->skin_type_id ?>">
                        <i class="bi bi-pencil"></i> Edit
                    </button>

                    <button class="btn btn-sm btn-outline-danger delete-product" data-id="<?= $p->id_product ?>">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </td>
            </tr>
            <?php 
                endforeach; 
            else:
            ?>
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">No products found in database.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
include "includes/admin_product_modal.php"; 
?>
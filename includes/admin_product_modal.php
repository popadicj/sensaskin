<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Sensa Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="logic/add_product.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="pName" class="form-control" required/>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Price ($)</label>
                            <input type="number" step="0.01" name="pPrice" class="form-control" required/>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Old Price</label>
                            <input type="number" step="0.01" name="pOldPrice" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="pCat" class="form-select" required>
                                <option value="">Choose...</option>
                                <?php 
                                    $cats = $conn->query("SELECT * FROM categories")->fetchAll();
                                    foreach($cats as $c) echo "<option value='{$c->id_category}'>{$c->category_name}</option>";
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Skin Type</label>
                            <select name="pSkinType" class="form-select" required>
                                <option value="">Choose...</option>
                                <?php                                    
                                    $skinTypes = $conn->query("SELECT * FROM skin_types")->fetchAll();
                                    foreach($skinTypes as $st) echo "<option value='{$st->id_skin_type}'>{$st->type_name}</option>";
                                ?>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="pImage" class="form-control" required/>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="pDesc" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pPopular" id="pPopular"/>
                                <label class="form-check-label" for="pPopular">Mark as Popular</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btnAddProduct" class="btn btn-dark">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
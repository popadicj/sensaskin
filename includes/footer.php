 <footer class="bg-light pt-5 pb-3 border-top">
    <div class="container">
        <div class="row g-4"> 
            <div class="col-md-4">
                <h5 class="text-uppercase mb-4 fw-bold">Sensa Skin</h5>
                <p class="text-muted small">
                    Clean cosmetics born out of love for nature and science. 
                    Providing your skin with the best botanical secrets.
                </p>
            </div>
            <div class="col-md-4 px-md-5 ps-3">
                <h5 class="text-uppercase mb-4 fw-bold">Quick Links</h5>
                <ul class="list-unstyled">
                    <?php 
                        $query = "SELECT * FROM navigation ORDER BY position ASC";
                        $result = $conn->query($query);
                        $links = $result->fetchAll(); 
                        foreach($links as $link): 
                    ?>
                        <li class="mb-2">
                            <a href="<?= $link->path ?>" class="text-decoration-none text-muted small text-uppercase">
                                <?= $link->label ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="text-uppercase mb-4 fw-bold">Contact Us</h5>
                <p class="text-muted small mb-1"><i class="bi bi-geo-alt me-2"></i> Belgrade, Serbia</p>
                <p class="text-muted small mb-1"><i class="bi bi-envelope me-2"></i> info@sensaskin.com</p>
                <p class="text-muted small"><i class="bi bi-telephone me-2"></i> +381 60 123 4567</p>
            </div>
        </div>
        <hr class="my-4 text-muted">
        <div class="text-center">
            <p class="small text-muted mb-0">
                &copy; <?= date('Y') ?> Sensa Skin. All rights reserved.
            </p>
            <div class="footer-icons py-1">
                <a href="sitemap.xml" target="_blank" title="Sitemap" class="text-dark mx-3 text-decoration-none">
                    <i class="bi bi-diagram-3 fs-5"></i> 
                </a>

                <a href="documentation.pdf" target="_blank" title="Documentation" class="text-dark mx-3 text-decoration-none">
                    <i class="bi bi-file-earmark-pdf fs-5"></i>
                </a>
            </div>
        </div>
        
    </div>
</footer>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="assets/js/main.js"></script>
</body>
</html>
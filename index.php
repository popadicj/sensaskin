<?php 
session_start();
require_once "config/connection.php";
require_once "includes/head.php";
require_once "includes/nav.php";

$queryPopular = "SELECT p.*, p.id_product AS product_real_id, s.type_name 
                 FROM products p 
                 JOIN skin_types s ON p.skin_type_id = s.id_skin_type 
                 WHERE p.is_popular = 1";
$popularProducts = $conn->query($queryPopular)->fetchAll();
$surveyQuery = "SELECT * FROM surveys WHERE is_active = 1 LIMIT 1";
$activeSurvey = $conn->query($surveyQuery)->fetch();
$options = [];
if($activeSurvey) {
    $sId = $activeSurvey->id_surveys;
    $optionsQuery = "SELECT * FROM survey_options WHERE survey_id = $sId";
    $options = $conn->query($optionsQuery)->fetchAll();
}
?>
<header id="header" class="container-fluid py-5">
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <div class="col-md-7 px-md-5 mb-5 mb-md-0">
                <div id="header-text">
                    <h2 class="display-3 fw-normal mb-4">PURE CARE.<br>VISIBLE RESULTS.</h2>
                    <p class="hero-subtitle mb-5">High-performance skincare formulas designed for your natural glow.</p>
                    <a href="shop.php" class="hero-btn text-decoration-none rounded-1">Shop Collection</a>
                </div>
            </div>
            <div class="col-md-5 text-end">
                <div class="header-img text-center">
                    <img src="assets/img/hero.jpg" class="img-fluid" alt="Sensa Skin Hero"/>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="about-brand py-5" id="about-brand">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <div class="about-image shadow-lg">
                    <img src="assets/img/about-brand.jpg" class="img-fluid w-100" alt="About us"/>
                </div>
            </div>
            <div class="col-md-6 px-md-5"> 
                <div class="about-info">
                    <h2 class="mb-4">About us</h2>
                    <p class="lead mb-4">
                        <span id="text-start">
                            Sensa Skin was born out of love for clean cosmetics. Our mission is to provide the skin with only the best of nature with scientifically proven results. We believe that skincare should be a ritual, not a chore, which is why every formula is carefully crafted to balance efficacy and sensory pleasure.
                        </span>
                        <span class="collapse" id="collapseAbout">
                        From our sustainably sourced botanical extracts to our high-performance active ingredients, we never compromise on quality. Our laboratory works tirelessly to ensure that every drop of our serums and creams respects the natural barrier of your skin while delivering a healthy, radiant glow.<br/>
                        We are more than just a brand; we are a community dedicated to transparency and conscious beauty. Join us on our journey to redefine what it means to have healthy skin, one botanical secret at a time.
                        </span>
                    </p>
                    <button type="button"  id="readMoreLink" class="btn-main border-0 rounded-1" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="false" aria-controls="collapseAbout">
                            Read more
                    </button>
                </div>
            </div> 
        </div> 
    </div> 
</section>
<section class="popular py-5 position-relative" id="popular">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-12 text-center">
                <h2 class="display-4 fw-normal m-0">Most Popular</h2>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-end mt-3 mt-md-0">
                <div class="carousel-controls d-flex gap-3">
                    <button id="prevBtn" class="border-0 bg-transparent fs-1 p-0"><i class="bi bi-chevron-left"></i></button>
                    <button id="nextBtn" class="border-0 bg-transparent fs-1 p-0"><i class="bi bi-chevron-right"></i></button>
                </div>
            </div>
        </div>
        <div class="carousel-wrapper overflow-hidden">
            <div class="product-track d-flex popular-slider">
                <?php if(!empty($popularProducts)): ?>
                    <?php foreach($popularProducts as $product): ?>
                        <div class="product-card">
                            <div class="product-img position-relative overflow-hidden">
                                <img src="assets/img/<?= $product->image ?>" class="w-100 h-100" alt="<?= $product->name ?>"/>
                            </div>
                            <div class="product-content pt-3 text-center">
                                <span class="skin-label text-uppercase text-muted small"><?= $product->type_name ?></span>
                                <h3 class="h5 fw-bold my-2"><?= $product->name ?></h3>
                                
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
                                        class="btn btn-outline-dark rounded-0 w-100 py-2 btn-add-ajax"
                                        data-id="<?= $product->product_real_id ?>"
                                        data-name="<?= $product->name ?>"
                                        data-price="<?= $product->price ?>"
                                        data-image="<?= $product->image ?>">
                                    Add to Cart
                                </button>
                                <div class="cart-notification-area"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php if($activeSurvey): ?>
<section class="survey-section py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10">
                <div class="survey-card p-4 p-md-5 text-center">
                    <span class="survey-label text-uppercase mb-3 d-block">COMMUNITY POLL</span>
                    <h3 class="mb-4"><?= $activeSurvey->question ?></h3>
                    <form id="pollForm">
                        <input type="hidden" id="pollId" value="<?= $sId ?>"/>
                        <div class="poll-options d-flex flex-wrap justify-content-center gap-3 mb-4">
                            <?php foreach($options as $opt): ?>
                                <label class="poll-control m-0">
                                    <input type="radio" name="skinType" value="<?= $opt->id_option ?>" class="d-none">
                                    <span class="control-label border rounded-pill px-4 py-2 d-inline-block shadow-sm bg-white">
                                        <?= $opt->option_text ?>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php if(isset($_SESSION['user'])): ?>
                            <button type="button" id="btnSubmitVote" class="btn btn-dark rounded-1 px-5 py-3 text-uppercase fw-bold">
                                Submit Vote
                            </button>
                        <?php else: ?>
                            <p class="login-msg text-muted mt-3">
                                Please <a href="login.php" class="text-dark fw-bold">login</a> to participate.
                            </p>
                        <?php endif; ?>
                    </form>
                    <div id="poll-msg" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once "includes/footer.php"; ?>
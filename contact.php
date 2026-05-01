<?php 
session_start();
require_once "config/connection.php";
require_once "includes/head.php";
require_once "includes/nav.php";
?>
<main class="login-wrapper d-flex align-items-center py-5"> <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 text-center">
                <h1 class="display-5 mb-3">Contact Us</h1>
                <p class="text-muted mb-5">Send us a message and we'll get back to you shortly.</p>
                <form id="contactForm">
                    <div class="mb-4 text-start">
                        <input type="text" id="contactName" class="custom-input" placeholder="Full Name"/>
                        <div class="error-text text-danger small" id="errName"></div>
                    </div>
                    <div class="mb-4 text-start">
                        <input type="email" id="contactEmail" class="custom-input" placeholder="Email Address">
                        <div class="error-text text-danger small" id="errEmail"></div>
                    </div>
                    <div class="mb-4 text-start">
                        <textarea id="contactMessage" class="custom-input" rows="2" placeholder="Your Message"></textarea>
                        <div class="error-text text-danger small" id="errMessage"></div>
                    </div>
                    <button type="button" id="btnSendContact" class="btn-main w-100">Send Message</button>
                </form>             
                <div id="contact-feedback" class="mt-4"></div>
            </div>
        </div>
    </div>
</main>
<?php require_once "includes/footer.php"; ?>
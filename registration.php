<?php 
session_start();
require_once "config/connection.php";
require_once "includes/head.php";
require_once "includes/nav.php";
?>
<main class="login-wrapper d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-container text-center">
                    <h1 class="display-5 mb-3">Join Sensa Skin</h1>
                    <p class="text-muted mb-5">Create your account and start shopping</p>
                    
                    <form id="registerForm">
                        <div class="form-group mb-3 text-start">
                            <input type="text" name="firstName" id="firstName" class="custom-input" placeholder="First Name">
                            <p class="error-text small text-danger mt-1"></p>
                        </div>
                        <div class="form-group mb-3 text-start">
                            <input type="text" name="lastName" id="lastName" class="custom-input" placeholder="Last Name">
                            <p class="error-text small text-danger mt-1"></p>
                        </div>
                        <div class="form-group mb-3 text-start">
                            <input type="email" name="email" id="email" class="custom-input" placeholder="Email Address">
                            <p class="error-text small text-danger mt-1"></p>
                        </div>
                        <div class="form-group mb-4 text-start">
                            <input type="password" name="password" id="password" class="custom-input" placeholder="Password">
                            <p class="error-text small text-danger mt-1"></p>
                        </div>
                        <button type="button" id="btnRegister" class="btn-main w-100">Register</button>
                    </form>
                    <div class="auth-footer mt-4">
                        <p class="small">Already have an account? <a href="login.php" class="text-dark fw-bold">Login here</a></p>
                    </div>
                    <div id="feedback" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once "includes/footer.php"; ?>
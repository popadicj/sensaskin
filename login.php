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
                    <h1 class="display-5 mb-3" style="font-family: 'Serif', serif;">Welcome Back</h1>
                    <p class="text-muted mb-5">Please enter your details</p>
                    <div id="login-feedback" class="mb-3"></div>
                    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'auth_required'): ?>
                        <div class="alert alert-info rounded-0 border-0 text-center small mb-4">
                            You need to be logged in to complete your order.
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="logic/login.php">
                        <div class="form-group mb-3 text-start">
                            <input type="email" id="email" name="email" class="custom-input" placeholder="Email Address" required/>
                        </div>
                        <div class="form-group mb-4 text-start">
                            <input type="password" id="password" name="password" class="custom-input" placeholder="Password" required/>
                        </div>
                        <button type="submit" name="btnLogin" id="btnLogin" class="btn-main w-100">Login</button>
                    </form>
                    <div class="auth-footer mt-4">
                        <p class="small">New here? <a href="registration.php" class="text-dark fw-bold">Create an account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once "includes/footer.php"; ?>
<?php 
session_start();
require_once "config/connection.php";
require_once "includes/head.php";
require_once "includes/nav.php";
?>
<div class="container my-5">
    <div class="row align-items-center"> 
        <div class="col-md-6 text-center">
            <img src="assets/img/author.jpg" alt="Author" class="img-fluid author"/>
        </div>
        <div class="col-md-6 my-5 text-center">
            <p class="fs-4">Ime i prezime: Jelena Popadić</p>
            <p class="fs-4">Broj indeksa: 94/23</p>
        </div>

    </div>
</div>
<?php 
require_once "includes/footer.php";
?>
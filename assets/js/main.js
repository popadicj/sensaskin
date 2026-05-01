$(document).ready(function () {

    //CAROUSEL
    const track = document.querySelector('.product-track');
    const next = document.querySelector('#nextBtn');
    const prev = document.querySelector('#prevBtn');
    const cards = document.querySelectorAll('.product-card');

    if (track && next && prev && cards.length > 0) {
        let counter = 0;
        const cardsToShow = 4;

        function updateCarousel() {
            const firstCard = cards[0];
            const cardWidth = firstCard.offsetWidth;
            const style = window.getComputedStyle(track);
            const gap = parseInt(style.gap) || 0;
            
            const moveAmount = cardWidth + gap;
            track.style.transform = `translateX(-${counter * moveAmount}px)`;

            prev.style.opacity = (counter === 0) ? "0.3" : "1";
            prev.style.pointerEvents = (counter === 0) ? "none" : "auto";
            
            next.style.opacity = (counter >= cards.length - cardsToShow) ? "0.3" : "1";
            next.style.pointerEvents = (counter >= cards.length - cardsToShow) ? "none" : "auto";
        }
        next.addEventListener('click', () => {
            if (counter < cards.length - cardsToShow) {
                counter++;
                updateCarousel();
            }
        });
        prev.addEventListener('click', () => {
            if (counter > 0) {
                counter--;
                updateCarousel();
            }
        });
        updateCarousel();
    }

    //ABOUT SECTION
    $('#collapseAbout').on('shown.bs.collapse', function () {
        $('#readMoreLink').text('Read less');
    }).on('hidden.bs.collapse', function () {
        $('#readMoreLink').text('Read more');
    });

    //REGISTRACIJA
    $(document).on('click', '#btnRegister', function (e) {
        e.preventDefault();
        let errorsCount = 0;
        let fName = $('#firstName');
        let lName = $('#lastName');
        let email = $('#email');
        let pass = $('#password');

        let reName = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,15}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,15}|-[A-ZŠĐČĆŽ][a-zšđčćž]{2,15})?$/;
        let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        let rePass = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[\W_])(?=.*\d).{8,}$/;

        function proveri(re, obj, message) {
            let errorElement = obj.next('.error-text');
            if (!re.test(obj.val().trim())) {
                errorsCount++;
                errorElement.html(message).css("color", "#ff4d4d");
            } else {
                errorElement.html("");
            }
        }
        proveri(reName, fName, "Name must start with capital letter.");
        proveri(reName, lName, "Surname must start with capital letter.");
        proveri(reEmail, email, "Please enter a valid email address(e.g., example@gmail.com)");
        proveri(rePass, pass, "Min 8 characters, uppercase, lowercase, number and special character.");

        if (errorsCount === 0) {
            $.ajax({
                url: "logic/registration.php",
                method: "POST",
                data: {
                    firstName: fName.val().trim(),
                    lastName: lName.val().trim(),
                    email: email.val().trim(),
                    password: pass.val().trim(),
                    send: true
                },
                dataType: "json",
                success: function (response) {
                    $('#feedback').html("Registration successful!").addClass("text-success");
                    setTimeout(() => { window.location.href = "login.php"; }, 2000);
                },
                error: function (xhr) {
                    let msg = xhr.responseJSON ? xhr.responseJSON.message : "Error occurred.";
                    $('#feedback').html(msg).addClass("text-danger");
                }
            });
        }
    });

    //LOGIN
    $(document).on('click', '#btnLogin', function (e) {
        e.preventDefault();
        let email = $('#email').val().trim();
        let pass = $('#password').val().trim();
        let feedback = $('#login-feedback');

        if (email == "" || pass == "") {
            feedback.html("Fields cannot be empty.").css("color", "red");
            return;
        }
        $.ajax({
            url: "logic/login.php",
            method: "POST",
            data: { email: email, password: pass, send: true },
            dataType: "json",
            success: function () {
                feedback.html("Login successful!").css("color", "green");
                setTimeout(() => { window.location.href = "index.php"; }, 1500);
            },
            error: function (xhr) {
                let msg = xhr.responseJSON ? (xhr.responseJSON[0] || xhr.responseJSON.message) : "Login failed.";
                feedback.html(msg).css("color", "red");
            }
        });
    });

    //POLL
    $(document).on('click', '#btnSubmitVote', function () {
        let selectedOpt = $('input[name="skinType"]:checked').val();
        let pollId = $('#pollId').val();

        if (!selectedOpt) {
            $('#poll-msg').html("Select an option.").css("color", "red");
            return;
        }
        $.ajax({
            url: "logic/vote.php",
            method: "POST",
            data: { option_id: selectedOpt, survey_id: pollId },
            dataType: "json",
            success: function (data) {
                $('#poll-msg').html(data.message).css("color", "green");
                $('#pollForm').fadeOut();
            },
            error: function (xhr) {
                let msg = (xhr.status === 409) ? "Already voted!" : "Error voting.";
                $('#poll-msg').html(msg).css("color", "orange");
            }
        });
    });

    //SHOP FILTERS
    function filterProducts() {
        let selectedSkins = [];
        $(".skin-filter:checked").each(function () { selectedSkins.push($(this).val()); });
        let selectedCats = [];
        $(".cat-filter:checked").each(function () { selectedCats.push($(this).val()); });

        $.ajax({
            url: "logic/filter_products.php",
            method: "POST",
            data: {
                search: $("#tbSearch").val(),
                skins: selectedSkins,
                cats: selectedCats,
                price: $("#priceRange").val(),
                sort: $("#sortPrice").val()
            },
            success: function (data) { $("#products-display").html(data); }
        });
    }
    let initialValue = $('#priceRange').val();
    $('#rangeValue').text(initialValue);

    $(document).on('input', '#priceRange', function() {
        let currentVal = $(this).val();
        $('#rangeValue').text(currentVal);
    });
    $(".skin-filter, .cat-filter, #sortPrice").on("change", filterProducts);
    $("#priceRange").on("input", filterProducts);
    $("#tbSearch").on("keyup", filterProducts);

    //CONTACT
   $(document).on('click', '#btnSendContact', function () {

    let fullName = $('#contactName').val().trim();
    let email = $('#contactEmail').val().trim();
    let message = $('#contactMessage').val().trim();
    
    let errors = 0;

    $('#errName, #errEmail, #errMessage').html("");
    $('#contact-feedback').html("");

    if (fullName.length < 3) { 
        $('#errName').html("Name is too short."); 
        errors++; 
    }
    let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if (!reEmail.test(email)) { 
        $('#errEmail').html("Invalid email format."); 
        errors++; 
    }
    if (message.length < 10) { 
        $('#errMessage').html("Message must be at least 10 characters."); 
        errors++; 
    }
    if (errors === 0) {
        $.ajax({
            url: 'logic/contact.php',
            method: 'POST',
            data: { 
                send: true, 
                fullName: fullName, 
                email: email, 
                message: message 
            },
            dataType: 'json',
            success: function (data) {
                $('#contact-feedback').html(`<p class="text-success">${data.message}</p>`);
                $('#contactForm')[0].reset();
            },
            error: function (xhr) {
                // Ako PHP vrati grešku (npr. 422 ili 500)
                let errorResponse = "An error occurred.";
                if(xhr.responseJSON && xhr.responseJSON.message) {
                    errorResponse = xhr.responseJSON.message;
                }
                $('#contact-feedback').html(`<p class="text-danger">${errorResponse}</p>`);
            }
        });
    }
});
    //ADMIN PANEL
$(document).on('click', '.delete-product', function() {
    let id = $(this).data('id');
    let confirmation = confirm("Are you sure you want to delete this product?");
    if(confirmation) {
        $.ajax({
            url: "logic/delete_products.php",
            method: "POST",
            data: { id_product: id },
            success: function(response) {
                $(`#product-row-${id}`).fadeOut(500);
            },
            error: function() {
                alert("Error deleting product.");
            }
        });
    }
});
$(document).on('click', '.delete-message', function() {
    let id = $(this).data('id');
    if(confirm("Delete this message?")) {
        $.ajax({
            url: "logic/delete_message.php",
            method: "POST",
            data: { id_message: id },
            success: function() {
                $(`#message-row-${id}`).fadeOut();
            }
        });
    }
});
$(document).on('click', '.edit-product', function() {
    // 1. Uzmi podatke iz dugmeta
    let id = $(this).data('id');
    let name = $(this).data('name');
    let price = $(this).data('price');
    let desc = $(this).data('desc');
    let cat = $(this).data('cat');
    let skin = $(this).data('skin');

    // 2. Ubaci ih u polja u modalu (addProductModal)
    $('#addProductModal .modal-title').text('Edit Product: ' + name);
    $('input[name="pName"]').val(name);
    $('input[name="pPrice"]').val(price);
    $('textarea[name="pDesc"]').val(desc);
    $('select[name="pCat"]').val(cat);
    $('select[name="pSkinType"]').val(skin);

    // 3. DODAJ SKRIVENO POLJE ZA ID (da PHP zna koji proizvod menja)
    if($('#editProductId').length == 0) {
        $('#addProductModal form').append(`<input type="hidden" name="id_product" id="editProductId" value="${id}">`);
    } else {
        $('#editProductId').val(id);
    }

    // 4. Promeni action forme na update_product.php
    $('#addProductModal form').attr('action', 'logic/update_product.php');

    // 5. Otvori modal
    var myModal = new bootstrap.Modal(document.getElementById('addProductModal'));
    myModal.show();
});
document.querySelectorAll('.btn-delete-user').forEach(btn => {
    btn.addEventListener('click', function() {
        const userId = this.dataset.id;
        const row = this.closest('tr');

        if(confirm('Are you sure you want to delete this user?')) {
            const formData = new FormData();
            formData.append('id_user', userId);

            fetch('logic/delete_user.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if(response.ok) {
                    row.style.transition = "0.3s";
                    row.style.opacity = "0";
                    setTimeout(() => row.remove(), 300);
                } else if(response.status === 403) {
                    alert("You cannot delete your own account!");
                } else {
                    alert("Error deleting user.");
                }
            });
        }
    });
});
document.querySelectorAll('.btn-add-ajax').forEach(button => {
    button.addEventListener('click', function() {
        const btn = this;
        const notification = btn.nextElementSibling;

        const formData = new FormData();
        formData.append('add_to_cart', true);
        formData.append('id', btn.dataset.id);
        formData.append('name', btn.dataset.name);
        formData.append('price', btn.dataset.price);
        formData.append('image', btn.dataset.image);

        fetch('logic/add_to_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(() => {
            notification.innerHTML = '<span class="cart-msg-success">Added!</span>';
            
            const cartCountSpan = document.getElementById('cart-count');
            if (cartCountSpan) {
                let currentCount = parseInt(cartCountSpan.innerText);
                cartCountSpan.innerText = currentCount + 1;
            }
            setTimeout(() => {
                notification.innerHTML = '';
            }, 2000);
        })
        .catch(err => console.error('Greška:', err));
    });
});
});
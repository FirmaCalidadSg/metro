<?php
@session_start();
$_SESSION['userData'] = $userData;
// echo "<pre>";
// var_dump($_SESSION['userData']);
// echo "</pre>";



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../App/Assets/css/globals.css" />
    <link rel="stylesheet" href="../App/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../App/Assets/css/style.css" />
</head>

<body>
    <div class="alianza-metro">
        <div class="logo-container">
            <div id="rotatingLogo" class="rotating-logo">
                <img src="../App/Assets/css/images/animate-logo.svg" alt="logo1" class="logo-img">
            </div>

            <div id="finalLogo" class="final-logo">
                <img src="../App/Assets/css/images/animate-logo11.svg" alt="logo11">
            </div>
        </div>

        <div class="log-in">
            <div class="animation-logo">
                <img class="image" src="../App/Assets/css/images/logo.png" />
                <p class="text-wrapper text-center"><?php echo $userData['name'] ?></p>
                <div class="divider"></div>
            </div>

        </div>
        <script src="../App/Assets/jquery/jquery.min.js"></script>
        <script src="../App/Assets/sweetalert2/sweetalert2@11.js"></script>
        <script src=""></script>
        <script>
            $(document).ready(function() {
                $('.buttom').on('click', function(e) {
                    e.preventDefault();

                    var email = $('input[type="email"]').val();
                    var password = $('input[type="password"]').val();

                    $.ajax({
                        url: '/metro/app/usuarios/auth', // Change this to your actual login endpoint
                        type: 'POST',
                        data: {
                            email: email,
                            password: password
                        },
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                title: response.success ? '¡Éxito!' : '¡Error!',
                                text: response.message,
                                icon: response.success ? 'success' : 'error'
                            }).then(function() {
                                if (response.success) {
                                    window.location.href = response.url;
                                }
                            });

                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(error);
                            // Show error message
                        }
                    });
                });
            });
        </script>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const finalLogo = document.getElementById("finalLogo");
            const logIn = document.querySelector(".alianza-metro .log-in");

            finalLogo.addEventListener("animationend", function(event) {
                if (event.animationName === "slideIn") {
                    logIn.style.display = "flex";
                    finalLogo.style.display = "none";

                    // Redirigir a usuarios/dashboard después de mostrar el log-in
                    setTimeout(() => {
                        window.location.href = "/Metro/App/usuarios/dashboard";
                    }, 2000); // Espera 2 segundos antes de redirigir
                }
            });
        });
    </script>
</body>

</html>
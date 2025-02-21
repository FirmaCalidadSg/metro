<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../app/Assets/css/style.css" />
</head>

<body>
    <div class="alianza-metro">
        <div class="logo-container">
            <div id="rotatingLogo" class="rotating-logo">
                <img src="../app/Assets/css/images/animate-logo.svg" alt="logo1" class="logo-img">
            </div>

            <div id="finalLogo" class="final-logo">
                <img src="../app/Assets/css/images/animate-logo11.svg" alt="logo11">
            </div>
        </div>


        <?php
        $tenantId = "7258c2e3-77e9-4639-b8c0-b0ce37f72218";
        $clientId = "a05de9cb-0cf4-4f44-9f89-94a5fd88f960";
        $redirectUri = "http://localhost/metro/app/redirect.php";
        $scope = "openid profile email";

        $loginUrl = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/authorize?"
            . "client_id=$clientId"
            . "&response_type=code"
            . "&redirect_uri=" . urlencode($redirectUri)
            . "&scope=" . urlencode($scope)
            . "&response_mode=query";

        header("Location: $loginUrl");
        exit();
        ?>




        <!-- <div class="log-in">
            <div class="animation-logo">
                <img class="image" src="../app/Assets/css/images/logo.png" />
            </div>
            <div class="divider"></div>
            <p class="text-wrapper">Ingresa tus credenciales para iniciar sesión</p>
            <div class="drops-downs">
                <div class="box-info">
                    <div class="textfield">
                        <div class="spacer">
                            <div class="div">Correo electrónico</div>
                            <input class="input-login" type="email">
                            <img class="under-line" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="box-info">
                    <div class="textfield">
                        <div class="spacer">
                            <div class="div">Contraseña</div>
                            <input class="input-login" type="password">
                            <img class="under-line" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
            </div>
            <button class="buttom">
                <div class="div-wrapper">
                    <div class="text-wrapper-2">Ingresar</div>
                </div>
            </button>
        </div> -->





        <!-- <script src="../app/Assets/jquery/jquery.min.js"></script>
        <script src="../app/Assets/sweetalert2/sweetalert2@11.js"></script>
        <script src=""></script>
        <script>
            $(document).ready(function () {
                $('.buttom').on('click', function (e) {
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
                        success: function (response) {
                            Swal.fire({
                                title: response.success ? '¡Éxito!' : '¡Error!',
                                text: response.message,
                                icon: response.success ? 'success' : 'error'
                            }).then(function () {
                                if (response.success) {
                                    window.location.href = response.url;
                                }
                            });

                        },
                        error: function (xhr, status, error) {
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
        document.addEventListener("DOMContentLoaded", function () {
            const finalLogo = document.getElementById("finalLogo");
            const logIn = document.querySelector(".alianza-metro .log-in");

            finalLogo.addEventListener("animationend", function (event) {
                if (event.animationName === "slideIn") {
                    logIn.style.display = "flex";
                    finalLogo.style.display = "none";
                }
            });
        });
    </script>
</body>

</html> -->
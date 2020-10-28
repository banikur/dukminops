<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIDUKOPS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="front_login/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="front_login/css/util.css">
    <link rel="stylesheet" type="text/css" href="front_login/css/main.css">

    <style>

        body, html {
            height: 100%;
            margin: 0;
        }

        .bg {
            /* The image used */
            background-image: url("assets/header.jpg");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
    <!--===============================================================================================-->
</head>
<body>

<div class="bg">
    <div class="limiter">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50" style="float: right; margin: 8%">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                    <span class="login100-form-title p-b-33">
                        <img width="100px" src="assets/logo.png" />
                    </span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input required class="input100" type="text" name="email" placeholder="Email" style="height: 40px">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>
                <br>
                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                    <input required class="input100" type="password" name="password" placeholder="Password" style="height: 40px">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>
                @if($errors->any())
                <br>
                <div style="text-align: center">
                    <span style="font-weight: bold; color: red">User tidak terdaftar silakan mendaftar di <a href="http://ems.minerba.go.id/">EMS Minerba</a></span>
                </div>
                @endif

                <div class="container-login100-form-btn m-t-20">
                    <button type="submit" class="login100-form-btn">
                        <strong>Masuk</strong>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="front_login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="front_login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="front_login/vendor/bootstrap/js/popper.js"></script>
<script src="front_login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="front_login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="front_login/vendor/daterangepicker/moment.min.js"></script>
<script src="front_login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="front_login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="front_login/js/main.js"></script>

</body>
</html>

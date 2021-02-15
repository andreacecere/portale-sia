<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/login_style/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/login_style/css/main.css">

    <link rel="stylesheet" type="text/css"
        href="<?php base_url() ?>assets/login_style/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php base_url() ?>assets/login_style/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/login_style/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php base_url() ?>assets/login_style/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php base_url() ?>assets/login_style/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/login_style/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?php base_url() ?>assets/login_style/vendor/daterangepicker/daterangepicker.css">

</head>

<body>

    <!-- <?php echo phpinfo(); ?> -->

    <div class="limiter">
        <div class="container-login100" style='background: linear-gradient(to right,#0060A6, #00ADE8);'>
            <div class="wrap-login100">
                <!-- <h1 class="animate__animated animate__bounce">An animated element</h1> -->
                <form class="login100-form validate-form" method="POST">
                    <span class="login100-form-title p-b-26">
                        <img src='assets/img/logo.png' class='img-fluid'>
                    </span>
                    <br>
                    <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <br>
                    <!-- <span class="login100-form-title p-b-48">
                        <i class="zmdi zmdi-font"></i>
                    </span> -->
                    <?php if (session()->get('errore_email')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->get('errore_email') ?>
                    </div>
                    <?php endif; ?>
                    <?php if (session()->get('ok_email')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('ok_email') ?>
                    </div>
                    <?php endif; ?>
                    <div class="wrap-input100 validate-input" data-validate="Inserisci la tua email">
                        <input class="input100" type="text" name="email">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                INVIA LA RICHIESTA&nbsp;<i class="far fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div id="dropDownSelect1"></div>


</html>

<!--===============================================================================================-->
<script src="<?php base_url() ?>assets/login_style/vendor/bootstrap/js/popper.js"></script>
<script src="<?php base_url() ?>assets/login_style/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url() ?>assets/login_style/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url() ?>assets/login_style/vendor/daterangepicker/moment.min.js"></script>
<script src="<?php base_url() ?>assets/login_style/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?php base_url() ?>assets/login_style/vendor/countdowntime/countdowntime.js"></script>

<script src="<?php base_url() ?>assets/login_style/js/main.js"></script>
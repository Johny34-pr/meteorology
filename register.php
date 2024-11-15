<?php 
include("core/init.php"); 
?>
<!DOCTYPE html>
<html lang="hu">

<head>
<meta charset="utf-8">
    <title>Országos Meteorológiai Szolgálat</title>
    <meta name="keywords" content="MBBE" />
    <meta name="description" content="OMSZ - Országos Meteorológiai Szolgálat">
    <meta name="author" content="OMSZ">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/main.css" rel="stylesheet" media="screen">
    <link rel="apple-touch-icon" sizes="120x120" href="img/icons/apple-touch-icon.png?v=2bBRvozOrO">
    <link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png?v=2bBRvozOrO">
    <link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png?v=2bBRvozOrO">
    <link rel="shortcut icon" href="img/icons/favicon.ico?v=2bBRvozOrO">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<body>

    <!-- layout-->
    <div id="layout">
        <?php include("components/header.php"); ?>

        <!-- End Section Title -->

        <!-- Section Area - Content Central -->
        <div class="section-title" style="background-image:url('/img/slide/2.jpg');background-attachment: fixed;">


            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Admin</h1>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Section Title -->

        <!-- Section Area - Content Central -->
        <section class="content-info">

            <!-- Dark Home -->

            <!-- Content Central -->
            <div class="container padding-top">
                <div class="row">

                    <!-- content Column Left -->
                    <div class="col-12">

                        <!-- End Recent Post -->

                        <!-- Experts -->
                        <div class="panel-box">
                            <div class="titles">
                                <h4>Regisztrálás</h4>
                            </div>

                            <div class="row">
                                <div class="col mb-5">
                                    <div class="row pt-2">
                                        <div class="col text-center">
                                            <span class="h1 fw-bold mb-0">Országos Meteorológiai Szolgálat</span>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-3 col-lg-3 p-1 d-flex align-items-center justify-content-center">
                                        <img src="/img/icons/favicon.ico" alt="Országos Meteorológiai Szolgálat" title="Országos Meteorológiai Szolgálat" class="rounded mx-auto d-block" style="max-height: 100%;">
                                        </div>
                                        <div class="col-md-6 col-lg-6 d-flex align-items-center">
                                            <div class="card-body p-2  text-black">
                                                <form method="POST" id="registerForm">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="sureName">Vezetéknév</label>
                                                            <input type="text" class="form-control" id="sureName" name="sureName" placeholder="Vezetéknév" autocomplete="family-name">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="firstName">Keresztnév</label>
                                                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Keresztnév" autocomplete="given-name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email cím</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Jelszó</label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Jelszó" autocomplete="off">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="confirm_password">Jelszó megerősítés</label>
                                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Jelszó megerősítés" autocomplete="off">
                                                    </div>
                                                    <div class="row align-items-center justify-content-center">
                                                        <button type="submit" class="btn btn-primary">Regisztrálás</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 p-1 d-flex align-items-center justify-content-center">
                                        <img src="/img/icons/spaceweather.ico" alt="Spaceweather" title="Spaceweather" class="rounded mx-auto d-block" style="max-height: 70%;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Experts -->
                        </div>
                        <!-- End content Left -->


                    </div>
                </div>
                <!-- End Content Central -->

        </section>
        <!-- End Section Area -  Content Central -->



        <?php include "components/footer.php"; ?>
    </div>
    <!-- End layout-->

    <!-- ======================= JQuery libs =========================== -->
    <!-- jQuery local-->
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <!-- popper.js-->
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <!-- bootstrap.min.js-->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <!-- required-scripts.js-->
    <script type="text/javascript" src="assets/js/theme-scripts.js"></script>
    <!-- theme-main.js-->
    <script type="text/javascript" src="assets/js/theme-main.js"></script>
    <!-- admin.js -->
    <script type="text/javascript" src="assets/js/admin.js"></script>
    <!-- register.js-->
    <script type="text/javascript" src="assets/js/register.js"></script>
    <!-- SwAlert.js-->
    <script type="text/javascript" src="assets/js/swalert.js"></script>
    <!-- ======================= End JQuery libs =========================== -->

</body>

</html>
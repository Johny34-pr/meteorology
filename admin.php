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
    <div id="layout">
        <?php include("components/header.php"); ?>

        <!-- End section-hero-posts-->

        <!-- Section Area - Content Central -->
        <section class="content-info">

            <div class="container paddings-mini">
                <div class="row">

                    <div class="col-lg-12">
                        <h3 class="clear-title">Kezelőfelület</h3>
                    </div>

                    <div class="col-lg-12">
                        <div class="row text-center justify-content-center pb-5">
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/felhasznalok">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class="bx bxs-user bx-md"></i>
                                        <br>
                                        Felhasználók
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/meresek">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class="bx bxs-user bx-md"></i>
                                        <br>
                                        Mérés rögzítése
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/allomasok">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class="bx bxs-user bx-md"></i>
                                        <br>
                                        Állomások
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/muszerek">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class="bx bxs-user bx-md"></i>
                                        <br>
                                        Mérőeszközök
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Section Area -  Content Central -->

        <!-- Footer -->
        <?php include "components/footer.php"; ?>
        <!-- End Footer -->
    </div>
    <!-- End layout-->

    <!-- ======================= JQuery libs =========================== -->
    <!-- jQuery local-->
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <!-- popper.js-->
    <script type="text/javascript" src="/assets/js/popper.min.js"></script>
    <!-- bootstrap.min.js-->
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <!-- required-scripts.js-->
    <script type="text/javascript" src="/assets/js/theme-scripts.js"></script>
    <!-- theme-main.js-->
    <script type="text/javascript" src="/assets/js/theme-main.js"></script>
    <!-- ======================= End JQuery libs =========================== -->

</body>

</html>
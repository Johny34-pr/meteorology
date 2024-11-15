<?php
include("core/init.php");
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <title>Magyar Bábus Biliárd Egyesület</title>
    <meta name="keywords" content="MBBE" />
    <meta name="description" content="MBBE - Magyar Bábus Biliárd Egyesület">
    <meta name="author" content="MBBE">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/assets/css/main.css" rel="stylesheet" media="screen">
    <link href="/assets/css/admin.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="/img/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/img/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/icons/apple-touch-icon-114x114.png">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>

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
                                <a href="/admin/user-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class="bx bxs-user bx-md"></i>
                                        <br>
                                        Felhasználókezelés
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/article-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class='bx bx-news bx-md'></i>
                                        <br>
                                        Cikkek-kezelése
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/game-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class='bx bx-compass bx-md'></i>
                                        <br>
                                        Versenykezelés
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/apply-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class='bx bx-briefcase bx-md'></i>
                                        <br>
                                        Jelentkezéskezelés
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/player-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class="bx bxs-user bx-md"></i>
                                        <br>
                                        Játékoskezelés
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/report-update">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class='bx bx-notepad bx-md'></i>
                                        <br>
                                        Jegyzőkönyvszerkesztő frissítés
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/gallery-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class='bx bx-images bx-md'></i>
                                        <br>
                                        Galéria kezelés
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/documents-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class='bx bx-file bx-md'></i>
                                        <br>
                                        Dokumentumok kezelése
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-3 p-4">
                                <a href="/admin/site-management">
                                    <button class="btn btn-primary w-100 py-5">
                                        <i class='bx bx-home bx-md'></i>
                                        <br>
                                        Főoldal kezelése
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
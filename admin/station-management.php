<?php
include("../core/init.php");


if ($_SESSION['loggedin']) {

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
        <link href="/assets/css/main.css" rel="stylesheet" media="screen">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/icons/apple-touch-icon.png?v=2bBRvozOrO">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/icons/favicon-32x32.png?v=2bBRvozOrO">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/icons/favicon-16x16.png?v=2bBRvozOrO">
        <link rel="shortcut icon" href="/img/icons/favicon.ico?v=2bBRvozOrO">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
    </head>

    <body>
        <div id="layout">
            <?php include("../components/header.php"); ?>

            <!-- End section-hero-posts-->

            <div class="section-title" style="background:url(/img/slide/1.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h1>Főoldal beállítások</h1>
                        </div>

                        <div class="col-md-4">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="/">Kezdőlap</a></li>
                                    <li><a href="/admin">Admin</a></li>
                                    <li>Főoldal beállítások</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Title -->

            <!-- Section Area - Content Central -->
            <section class="content-info">
                <div class="container paddings-mini">
                    <div class="row">
                        <div class="col-lg-5">
                            <h3 class="clear-title">Állomások</h3>
                        </div>
                        <div class="col-lg-2 offset-lg-5">
                            <a href="/admin/user-add" class="btn btn-primary" id="newUser"><i class='bx bxs-plus-circle'></i> <span>Új felhasználó</span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Név</th>
                                        <th class="text-center">E-mail cím</th>
                                        <th class="text-center">Regisztráció ideje</th>
                                        <th class="text-center">Rang</th>
                                        <th class="text-center">Státusz</th>
                                        <th class="text-center">Módosítás</th>
                                    </tr>
                                </thead>
                                <tbody id="users-panel">
                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="hint-text">
                                    <b>
                                        <span id="showedRows"></span>
                                    </b>
                                    felhasználó a(z)
                                    <b>
                                        <span id="allRows"></span>
                                    </b>-ből
                                </div>
                                <ul class="pagination">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal" id="confirm" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Biztosan törlöd a kiválasztott felhasználót?</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body row justify-content-center">
                            <div class="col-2">
                                <button type="button" class="btn btn-danger" id="delete" data-bs-dismiss="modal">Törlés</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Section Area -  Content Central -->

            <!-- Footer -->
            <?php include "../components/footer.php"; ?>
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
        <script type="text/javascript" src="/assets/js/user-management.js"></script>
        <script type="text/javascript" src="/assets/js/email.js"></script>
        <script type="text/javascript" src="/assets/js/classes.js"></script>
        <script type="text/javascript" src="/assets/js/pagination.js"></script>
        <script type="text/javascript" src="/assets/js/swalert.js"></script>
        <!-- ======================= End JQuery libs =========================== -->

    </body>

    </html>
<?php
} else {
    header("location: /page-404.html");
}
?>
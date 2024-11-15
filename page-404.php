<!DOCTYPE html>
<html lang="hu">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <title>Magyar Bábus Biliárd Egyesület</title>
    <meta name="keywords" content="MBBE" />
    <meta name="description" content="MBBE - Magyar Bábus Biliárd Egyesület">
    <meta name="author" content="MBBE">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Theme CSS -->
    <link href="/assets/css/main.css" rel="stylesheet" media="screen">
    <!-- Favicons -->
    <link rel="shortcut icon" href="/img/icons/magyar.png">
    <!-- <link rel="apple-touch-icon" href="img/icons/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114.png"> -->
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
</head>

<body>

    <!-- layout-->
    <div id="layout">
        <?php include("components/header.php"); ?>

        <!-- Section Title -->
        <div class="section-title" style="background:url(/img/slide/1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>404 - Oldal nem található</h1>
                    </div>

                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="/">Kezdőlap</a></li>
                                <li>404</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section Title -->

        <!-- Section Area - Content Central -->
        <section class="content-info">

            <!-- Content Central -->
            <section class="container">
                <div class="row">
                    <div class="page-error">
                        <h1>404 <i class="fa fa-unlink"></i></h1>
                        <hr class="tall">
                        <p class="lead">Sajnáljuk, a keresett oldal nem található.</p>
                        <a href="/" class="btn btn-lg btn-primary">Visszatérés a kezdőlapra</a>
                    </div>
                </div>
            </section>
            <!-- End Content Central -->

            <!-- Newsletter -->
            <?php include "components/newsletter.php"; ?>
            <!-- End newsletter -->
        </section>
        <!-- End Section Area -  Content Central -->

        <!-- Footer -->
        <?php include "components/footer.php"; ?>
        <!-- End Footer -->
    </div>
    <!-- End layout-->

    <!-- ======================= JQuery libs =========================== -->
    <!-- jQuery local old-->
    <script type="text/javascript" src="/assets/js/jquery_old.js"></script>
    <!-- jQuery local new-->
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script>
        var $j = jQuery.noConflict(true);
    </script>
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
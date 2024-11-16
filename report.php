<?php
include("core/init.php");

$report = $db->listMonthReport();
$report2 = $db->listSeasonReport();
// $report = $db->listYearReport();

// $jsonData = json_encode($report);

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="layout">
        <?php include("components/header.php"); ?>
        <div class="hero-header">
            <!-- Hero Slider-->
            <div id="hero-slider" class="hero-slider">
                <div class="item-slider" style="background:url('img/slide/1.jpg');">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="info-slider">
                                    <h1>Országos Meteorológiai Szolgálat</h1>
                                    <p>Az OMSZ időjárás-jelentéseket, országos előrejelzéseket, figyelmeztető előrejelzéseket készít. A hivatalos weboldalukon olvashatunk Magyarország éghajlatáról, időjárási visszatekintőben tájékozódhatunk az éghajlati változásokról, a külföldre utazóknak naprakész friss információk állnak rendelkezésre a célországok időjárásáról. </p>
                                    <a href="https://hu.wikipedia.org/wiki/HungaroMet" class="btn-iw outline">Olvass tovább <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-slider" style="background:url('img/slide/2.jpg');">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="info-slider">
                                    <h1>Országos Meteorológiai Szolgálat</h1>
                                    <p>Az OMSZ időjárás-jelentéseket, országos előrejelzéseket, figyelmeztető előrejelzéseket készít. A hivatalos weboldalukon olvashatunk Magyarország éghajlatáról, időjárási visszatekintőben tájékozódhatunk az éghajlati változásokról, a külföldre utazóknak naprakész friss információk állnak rendelkezésre a célországok időjárásáról. </p>
                                    <a href="https://hu.wikipedia.org/wiki/HungaroMet" class="btn-iw outline">Olvass tovább <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-slider" style="background:url('img/slide/3.jpg');">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="info-slider">
                                    <h1>Országos Meteorológiai Szolgálat</h1>
                                    <p>Az OMSZ időjárás-jelentéseket, országos előrejelzéseket, figyelmeztető előrejelzéseket készít. A hivatalos weboldalukon olvashatunk Magyarország éghajlatáról, időjárási visszatekintőben tájékozódhatunk az éghajlati változásokról, a külföldre utazóknak naprakész friss információk állnak rendelkezésre a célországok időjárásáról. </p>
                                    <a href="https://hu.wikipedia.org/wiki/HungaroMet" class="btn-iw outline">Olvass tovább <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Hero Slider-->
        </div>
        <!-- End section-hero-posts-->

        <!-- Section Area - Content Central -->
        <section class="content-info pb-5">
            <!-- Dark Home -->
            <div class="dark-home">
                <div class="container">

                </div>
            </div>
            <!-- Dark Home -->

            <!-- Content Central -->
            <div class="container padding-top pb-5">
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Év</th>
                                <th>Hónap</th>
                                <th>Átlagos érték</th>
                                <th>Mértékegység</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($report as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['year']) ?></td>
                                    <td><?= htmlspecialchars($row['month']) ?></td>
                                    <td><?= number_format($row['average_value'], 2) ?></td>
                                    <td><?= htmlspecialchars($row['unit']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="container" style="width: 70%">
                        <h2>Válassz idősávot</h2>
                        <select id="reportType" style="margin-bottom: 20px;">
                            <option value="month">Havi felbontás</option>
                            <option value="season">Évszakos felbontás</option>
                            <option value="year">Éves felbontás</option>
                        </select>

                        <canvas class="container" id="dynamicChart"></canvas>
                    </div>
                    <!-- content Column Left -->

                    <!-- End content Left -->

                    <!-- content Sidebar Center -->

                    <!-- End content Sidebar Center -->

                    <!-- content Sidebar Right -->

                    <!-- End content Sidebar Right -->

                </div>
            </div>
            <!-- End Content Central -->

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
    <script>
        let chart; // Referencia a Chart.js diagramhoz

        // Funkció a diagram frissítéséhez
        function updateChart(reportType) {
            $.ajax({
                url: 'api/chart.php',
                method: 'GET',
                data: {
                    type: reportType
                },
                success: function(data) {
                    // Adatok előkészítése
                    const labels = data.map(item => item.unit); // X tengely címkék
                    const values = data.map(item => item.average_value); // Adatértékek
                    const tooltips = data.map(item => `${item.average_value} ${item.unit}`); // Tooltip szövegek

                    // Ha a diagram már létezik, frissítsd
                    if (chart) {
                        chart.data.labels = labels;
                        chart.data.datasets[0].data = values;
                        chart.update();
                    } else {
                        // Új diagram létrehozása
                        const ctx = document.getElementById('dynamicChart').getContext('2d');
                        chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Átlagolt értékek',
                                    data: values,
                                    backgroundColor: ['blue', 'orange', 'green'],
                                    borderColor: ['darkblue', 'darkorange', 'darkgreen'],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltips[tooltipItem.dataIndex];
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                },
                error: function() {
                    alert('Error fetching data. Please try again.');
                }
            });
        }

        // Eseményfigyelő a legördülő menüre
        $('#reportType').on('change', function() {
            const selectedType = $(this).val();
            updateChart(selectedType);
        });

        // Alapértelmezett adatok betöltése (havi jelentés)
        $(document).ready(function() {
            updateChart('month');
        });
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
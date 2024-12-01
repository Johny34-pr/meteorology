<?php
include("core/init.php");

$report = $db->listMonthReport();
$measureCount = $db->getMeasureCount();
$instruments = $db->listInstrumentsStation();

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
            <!-- Content Central -->
            <div class="container padding-top pb-5">
                <div class="row justify-content-around">
                    <div class="card m-5">
                        <div class="text-center">
                            <h1 class="p-2">Mérési számok</h1>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Állomás</th>
                                    <th>Mérések száma</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($measureCount){
                                    foreach ($measureCount as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['Station']) ?></td>
                                        <td><?= htmlspecialchars($row['Measurement_Count']) ?></td>
                                    </tr>
                                <?php endforeach;}else{echo "<td colspan='2'>Nincs a lekérésnek megfelelő adat.</td>";} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card m-5">
                        <div class="text-center">
                            <h1 class="p-2">Mérési eredmények</h1>
                        </div>
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
                                <?php if($report){
                                    foreach ($report as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['year']) ?></td>
                                        <td><?= htmlspecialchars($row['month']) ?></td>
                                        <td><?= number_format($row['average_value'], 2) ?></td>
                                        <td><?= htmlspecialchars($row['unit']) ?></td>
                                    </tr>
                                <?php endforeach;}else{echo "<td colspan='4'>Nincs a az időszaknak megfelelő adat.</td>";} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card m-5">
                        <div class="text-center">
                            <h1 class="p-2">Aktív mérőműszerek száma</h1>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Állomás</th>
                                    <th>Müszerek</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($instruments as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['station']) ?></td>
                                        <td><?= htmlspecialchars($row['instruments_count']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="container pt-5" style="width: 70%">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <h2>Válassz idősávot</h2>
                            </div>
                            <div class="col-3">
                                <select class="form-control" id="reportType" style="margin-bottom: 20px;">
                                    <option value="month">Havi felbontás</option>
                                    <option value="season">Évszakos felbontás</option>
                                    <option value="year">Éves felbontás</option>
                                </select>
                            </div>
                        </div>
                        <canvas class="container pt-5" id="dynamicChart"></canvas>
                    </div>
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

        // Színgenerátor az egyedi unit típusokhoz
        function generateColor(seed) {
            const hash = Array.from(seed).reduce((acc, char) => acc + char.charCodeAt(0), 0);
            const r = (hash * 33) % 255;
            const g = (hash * 17) % 255;
            const b = (hash * 11) % 255;
            return `rgba(${r}, ${g}, ${b}, 0.8)`;
        }

        // Diagram inicializáló vagy frissítő funkció
        function initializeOrUpdateChart(data, reportType) {
            // Egyedi unit értékekhez színek hozzárendelése
            const uniqueUnits = [...new Set(data.map(item => item.unit))];
            const colorMap = uniqueUnits.reduce((map, unit) => {
                map[unit] = generateColor(unit);
                return map;
            }, {});

            // Címkék generálása az adott felbontás szerint
            let labels;
            if (reportType === 'month') {
                labels = [...new Set(data.map(item => `${item.year}-${item.month}`))]; // Egyedi hónap-címkék
            } else if (reportType === 'season') {
                labels = [...new Set(data.map(item => `${item.year}-${item.season || "Unknown Season"}`))]; // Évszak címkék
            } else if (reportType === 'year') {
                labels = [...new Set(data.map(item => `${item.year}`))]; // Évi címkék
            }

            // Datasetek létrehozása az egyes unit típusok alapján
            const datasets = uniqueUnits.map(unit => ({
                label: unit,
                data: labels.map(label => {
                    // A címkéhez tartozó adatértékek kigyűjtése
                    const dataPoint = data.find(item => {
                        const labelMatch =
                            (reportType === 'month' && label === `${item.year}-${item.month}`) ||
                            (reportType === 'season' && label === `${item.year}-${item.season}`) ||
                            (reportType === 'year' && label === `${item.year}`);
                        return labelMatch && item.unit === unit;
                    });
                    return dataPoint ? parseFloat(dataPoint.average_value) : 0;
                }),
                backgroundColor: colorMap[unit],
                borderColor: colorMap[unit],
                borderWidth: 1,
            }));

            // Ha a diagram már létezik, töröld
            if (chart) {
                chart.destroy();
            }

            // Új diagram létrehozása
            const ctx = document.getElementById('dynamicChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets,
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: reportType === 'month' ? 'Month' : reportType === 'season' ? 'Season' : 'Year',
                            },
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Average Value',
                            },
                        },
                    },
                },
            });
        }

        // Diagram frissítése vagy újra létrehozása
        function updateChart(reportType) {
            $.ajax({
                url: 'api/chart.php', // Állítsd be a megfelelő PHP fájl útvonalát
                method: 'GET',
                data: {
                    type: reportType,
                },
                success: function(data) {
                    // const parsedData = JSON.parse(data); // API válasz JSON formázása
                    initializeOrUpdateChart(data, reportType);
                },
                error: function() {
                    swAlert("error", "Hiba az adatok lekérdezése közben!");
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
    <!-- swalrt.js-->
    <script type="text/javascript" src="/assets/js/swalert.js"></script>
    <!-- ======================= End JQuery libs =========================== -->

</body>

</html>
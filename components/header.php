<?php

// Sample user session data
$user = isset($_SESSION["name"]) ? $_SESSION["name"] : false;
$avatar = "/api/getProfilePicture.php?id=" . (isset($_SESSION["id"]) ? $_SESSION["id"] : "0");
$rank = isset($_SESSION["rank"]) ? $_SESSION["rank"] : 0;

// Define the menu structure as an array
$menu = [
    [
        "title" => "Kezdőlap",
        "ref" => "/",
        "submenu" => []
    ],
    [
        "title" => "Hírek",
        "ref" => "/hirek",
        "submenu" => []
    ],
    [
        "title" => "Galéria",
        "ref" => "/galeria",
        "submenu" => []
    ],
    [
        "title" => "Bajnokság",
        "ref" => "#",
        "submenu" => [
            [
                "title" => "Bajnokság",
                "links" => [
                    ["name" => "Ranglista", "ref" => "table-point.html"],
                    ["name" => "Versenyek", "ref" => "fixtures.html"],
                    ["name" => "Osztályok", "ref" => "groups.html"],
                    ["name" => "Hírek", "ref" => "news-left-sidebar.html"],
                    ["name" => "Kapcsolat", "ref" => "contact.php"]
                ]
            ],
            [
                "title" => "Csapatok",
                "image" => "/img/blog/1.jpg",
                "ref" => "teams.html"
            ],
            [
                "title" => "Játékosok",
                "image" => "/img/blog/2.jpg",
                "ref" => "/php/subsites/players.php"
            ],
            [
                "title" => "Eredmények",
                "image" => "/img/blog/3.jpg",
                "ref" => "results.html"
            ]
        ]
    ],
    [
        "title" => "Klubok",
        "ref" => "/klubok",
        "submenu" => []
    ],
    [
        "title" => "Játékosok",
        "ref" => "/jatekosok",
        "submenu" => []
    ],
    [
        "title" => "Eredmények",
        "ref" => "#",
        "submenu" => [
            [
                "title" => "Eredmények",
                "links" => [
                    ["name" => "Eredmények", "ref" => "/eredmenyek"],
                    ["name" => "Versenynaptár", "ref" => "/naptar"],
                    ["name" => "Ranglista", "ref" => "/ranglista"],   
                    ["name" => "Nevezés", "ref" => "/nevezes"]   
                ]
            ]
        ]
    ],
    [
        "title" => "Dokumentumok",
        "ref" => "/dokumentumok",
        "submenu" => []
    ],
];

?>

<header>
    <div class="headerbox">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <div class="logo">
                        <a href="/" title="Vissza a kezdőlapra">
                            <img src="/img/logo.png" height="30" alt="Logo" class="logo_img">
                        </a>
                    </div>
                </div>

                <div class="col">
                    <div class="adds">
                        <h2 class="text-right text-capitalize">Magyar Bábus Biliárd Egyesület</h2>
                    </div>
                    <a class="mobile-nav" href="#mobile-nav"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>

<nav class='mainmenu'>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-11'>
                <ul class='sf-menu' id='menu'>
                    <?php
                    // Generate the regular menu
                    foreach ($menu as $item) {
                        if (!empty($item['submenu'])) {
                            echo "<li><a href='" . $item['ref'] . "'>" . $item['title'] . "</a>";
                            echo "<div class='sf-mega'><div class='row'>";

                            foreach ($item['submenu'] as $submenu) {
                                if (isset($submenu['links'])) {
                                    echo "<div class='col-md-3'><h5>" . $submenu['title'] . "</h5><ul>";
                                    foreach ($submenu['links'] as $link) {
                                        echo "<li><a href='" . $link['ref'] . "'>" . $link['name'] . "</a></li>";
                                    }
                                    echo "</ul></div>";
                                } elseif (isset($submenu['image'])) {
                                    echo "<div class='col-md-3'><h5>" . $submenu['title'] . "</h5>";
                                    echo "<div class='img-hover'><img src='" . $submenu['image'] . "' alt='' class='img-responsive'>";
                                    echo "<div class='overlay'><a href='" . $submenu['ref'] . "'>+</a></div></div></div>";
                                }
                            }

                            echo "</div></div></li>";
                        } else {
                            echo "<li class='current'><a href='" . $item['ref'] . "'>" . $item['title'] . "</a></li>";
                        }
                    }

                    // Fetch the user scores if the user is logged in

                    $userScores = [];
                    if (isset($_SESSION['id'])) {
                        $userId = $_SESSION['id'];
                        $userScores = $db->getUserScoresById($userId);
                    }

                    // User section based on session
                    if ($user) {
                        echo "<li class='float-right'>
            <a href='#'>
                <img src='$avatar' alt='Avatar' class='img-fluid rounded-circle' style='width: 30px; height: 30px;'> $user
            </a>
            <div class='sf-mega'>
                <ul>
                    <li><a href='/profilom'>Profil</a></li>";

                        // If user has admin rank (rank >= 2), show admin panel link
                        if ($rank >= 2) {
                            echo "<li><a href='/admin'>ADMIN PANEL</a></li>";
                        }

                        // Display the user's game scores if available
                        if (!empty($userScores)) {
                            // Check if each score is null, and if so, print 0 instead
                            $magyarScore = isset($userScores['magyar']) && $userScores['magyar'] !== null ? $userScores['magyar'] : 0;
                            $eurokegelScore = isset($userScores['eurokegel']) && $userScores['eurokegel'] !== null ? $userScores['eurokegel'] : 0;
                            $duplaBuzeraScore = isset($userScores['dupla_buzera']) && $userScores['dupla_buzera'] !== null ? $userScores['dupla_buzera'] : 0;
                            echo "<li class=''><a href='#'>Eredményeim: (Magyar: " . $magyarScore . "), (Eurokegel:" . $eurokegelScore . "), (Dupla Buzera: " . $duplaBuzeraScore . ")</a></li>";

                        }

                        echo "<li><a href='/kijelentkezes'>Kilépés</a></li>
                </ul>
            </div>
        </li>";
                    } else {
                        // If user is not logged in, show login link
                        echo "<li class='float-right'><a href='/bejelentkezes'>Bejelentkezés</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div id="mobile-nav">
    <ul>
        <?php
        // Generate the mobile menu (same as the main menu)
        foreach ($menu as $item) {
            echo "<li><a href='" . $item['ref'] . "'>" . $item['title'] . "</a>";

            if (!empty($item['submenu'])) {
                echo "<ul>";

                foreach ($item['submenu'] as $submenu) {
                    if (isset($submenu['links'])) {
                        foreach ($submenu['links'] as $link) {
                            echo "<li><a href='" . $link['ref'] . "'>" . $link['name'] . "</a></li>";
                        }
                    }
                }

                echo "</ul>";
            }

            echo "</li>";
        }

        // User section based on session for mobile nav
        if ($user) {
            echo "<li class='mobile-profile'>
                    <a href='#'>
                        <img src='$avatar' alt='Avatar' class='img-fluid rounded-circle' style='width: 30px; height: 30px;'> $user
                    </a>
                    <ul>
                        <li><a href='/profilom'>Profil</a></li>";

            // If user has admin rank (rank >= 2), show admin panel link in mobile menu
            if ($rank >= 2) {
                echo "<li><a href='/admin'>ADMIN PANEL</a></li>";
            }
            if (!empty($userScores)) {
                // Check if each score is null, and if so, print 0 instead
                $magyarScore = isset($userScores['magyar']) && $userScores['magyar'] !== null ? $userScores['magyar'] : 0;
                $eurokegelScore = isset($userScores['eurokegel']) && $userScores['eurokegel'] !== null ? $userScores['eurokegel'] : 0;
                $duplaBuzeraScore = isset($userScores['dupla_buzera']) && $userScores['dupla_buzera'] !== null ? $userScores['dupla_buzera'] : 0;

                echo "<li class=''><a href='#'>Eredményeim: <br> (Magyar: " . $magyarScore . "), <br>(Eurokegel:" . $eurokegelScore . "), <br>(Dupla Buzera: " . $duplaBuzeraScore . " )</a></li>";
            }
            echo "<li><a href='/kijelentkezes'>Kilépés</a></li>
                    </ul>
                </li>";
        } else {
            // If user is not logged in, show login link in mobile menu
            echo "<li class='mobile-login'><a href='/bejelentkezes'>Bejelentkezés</a></li>";
        }
        ?>
    </ul>
</div>
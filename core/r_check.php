<?php

function rcheck($rank = null){
    switch($rank){
        case 1:
            $rank = "Felhasználó";
            break;
        case 2:
            $rank = "Moderátor";
            break;
        case 3:
            $rank = "Adminisztrátor";
            break;
        case 4:
            $rank = "Webmester";
            break;
        default:
            $rank = "Vendég";
            break;
    }
    return $rank;
}

?>
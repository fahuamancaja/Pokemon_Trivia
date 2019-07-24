<?php

    if($totalpoint >= 0 && $totalpoint <= 17){
      $invbg = "images/badges/0badges.png";
      $bg = $invbg;
    } 
    elseif ( $totalpoint >= 18 && $totalpoint <= 35) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/1badges.png";

    }
    elseif ($totalpoint >= 36 && $totalpoint <= 53) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/3badges.png";
    }
    elseif ($totalpoint >= 54 && $totalpoint <= 71) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/4badges.png";
    }
    elseif ($totalpoint >= 72 && $totalpoint <= 89) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/5badges.png";
    }
    elseif ($totalpoint >= 90 && $totalpoint <= 107) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/6badges.png";
    }
    elseif ($totalpoint >= 108 && $totalpoint <= 125) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/7badges.png";
    }
    elseif ($totalpoint >= 126 && $totalpoint <= 149) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/7badges.png";
    }
    elseif ($totalpoint >= 150) {
        $invbg = "images/badges/0badges.png";
        $bg = "images/badges/8badges.png";
    }
echo $bg;
?>
<?php
    $num = (int)$number;
    if($num >= 0 && $num <= 9){
      $t = "images/00" . $num . ".png";
    }
    elseif ( $num >= 10 && $num <= 99) {
      $t = "images/0" . $num . ".png";
    }
    elseif ($num >= 100 && $num <= 151) {
      $t = "images/" . $num . ".png";
    }
    echo $t;
?>
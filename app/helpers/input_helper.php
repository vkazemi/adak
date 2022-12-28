<?php
function convert_to_price($number){
    // Add dollar sign and add cama to price
    $price = '$'.number_format($number, 0);
    return $price;
}

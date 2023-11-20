<?php
function myCalculator($num01, $oper, $num02){
    $sum= 0;
    switch ($oper){
        case "add":
            $sum = (double)$num01 + (double)$num02;
            break;
        case "sub":
            $sum = (double)$num01 - (double)$num02;
            break;
        default:
            $sum = "There was an error";
            break;
    }
    return $sum;
}

?>
<?php 

function countLowCase($string) 
{
    $upper_case = strtoupper($string);
    $similar = similar_text($string, $upper_case);
    $result = $string . ' mengandung ' . (strlen($string)-$similar) . ' buah huruf kecil <br> <br>';
    return $result;
}

echo countLowCase('TranSISI');

?>
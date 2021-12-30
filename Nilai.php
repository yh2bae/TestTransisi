<?php 

$nilai = array(72, 65, 73, 78, 75, 74, 90, 81, 87, 65, 55, 69, 72, 78, 79, 91, 100, 40, 67, 77, 86);

// Rata-Rata
$jumlah = array_sum($nilai);
$rata = $jumlah / count ( $nilai );
echo "Rata-Rata : ".$rata;
echo "<br>";

// 7 Nilai Tertinggi
rsort($nilai);
$top7 = array_slice($nilai, 0, 7 );

echo "7 Nilai Tertinggi : ";
print_r($top7);
echo "<br>";

// 7 Nilai Terendah
asort($nilai);
$low7 = array_slice($nilai, 0, 7 );

echo "7 Nilai Terendah : ";
print_r($low7);
echo "<br> <br>";

?>
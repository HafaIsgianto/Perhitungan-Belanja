<?php

function hitungBelanja($isMember, $totalBelanja) {
    if ($isMember) {
        
        $diskon = $totalBelanja >= 1000000 ? 15 : ($totalBelanja >= 500000 ? 10 : 10);
    } else {
        
        $diskon = $totalBelanja >= 1000000 ? 10 : ($totalBelanja >= 500000 ? 5 : 0);
    }

    $totalDiskon = ($diskon / 100) * $totalBelanja;
    $totalBayar = $totalBelanja - $totalDiskon;

    return [$diskon, $totalDiskon, $totalBayar];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isMember = $_POST['isMember'] === 'yes'; 
    $totalBelanja = (int) preg_replace('/\D/', '', $_POST['total_belanja']); 

    list($diskon, $totalDiskon, $totalBayar) = hitungBelanja($isMember, $totalBelanja);

    echo "Anda mendapat diskon: $diskon%<br>";
    echo "Total potongan: Rp " . number_format($totalDiskon, 0, ',', '.') . "<br>";
    echo "Total yang harus dibayar: Rp " . number_format($totalBayar, 0, ',', '.') . "<br>";
}
?>

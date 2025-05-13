<?php
$json = file_get_contents("http://localhost/User-Session-Estimation-System-Project/backend/api.php");
$data = json_decode($json, true);
$rows = $data["data"]["rows"];

foreach ($rows as $user) {
    $name = $user["name"];
    $logins = $user["logins"];

    echo "Kullanıcı: $name" . "<br>";

    $hours = [];
    $days = [];
    $intervals = [];

    $prevTime = null;

    foreach ($logins as $login) {
        $dt = new DateTime($login);

        // Saat ve gün analizleri
        $hours[] = $dt->format('H:i:s');
        $days[] = $dt->format('Y-m-d');

        // Girişler arası süre farkı (saniye)
        if ($prevTime) {
            $diff = $dt->getTimestamp() - $prevTime->getTimestamp();
            $intervals[] = $diff;
        }
        $prevTime = $dt;
    }

    // En sık login olunan saatler
    $hourFreq = array_count_values($hours);
    arsort($hourFreq);
    echo "En yoğun saat: " . array_key_first($hourFreq) . "<br>";

    // En aktif günler
    $dayFreq = array_count_values($days);
    arsort($dayFreq);
    echo "En aktif gün: " . array_key_first($dayFreq) . "<br>";

    // Ortalama giriş aralığı (saniye cinsinden)
    $avgInterval = count($intervals) ? array_sum($intervals) / count($intervals) : 0;
    echo "Ortalama tekrar süresi (dk): " . round($avgInterval / 60, 2) . "<br>";
    echo "<br>";
}

<?php
$json = file_get_contents("http://localhost/User-Session-Estimation-System-Project/backend/api.php");
$data = json_decode($json, true);
$rows = $data["data"]["rows"];

foreach ($rows as $user) {
    $name = $user["name"];
    $logins = $user["logins"];
    echo "<br>";
    echo "Kullanıcı: $name" . "<br>";

    $hours = []; //prediction için
    $days = [];
    $intervals = [];
    $loginWeekdays = []; //prediction için
    $activeHours = [];

    $prevTime = null;
    foreach ($logins as $login) {
        $dt = new DateTime($login);

        // Saat ve gün analizleri
        $hours[] = $dt->format('H'); //prediction için
        $activeHours[] = $dt->format('H:i');
        $days[] = $dt->format('Y-m-d');
        $loginWeekdays[] = $dt->format('l'); //prediction için


        // Girişler arası süre farkı (saniye)
        if ($prevTime) {
            $diff = $dt->getTimestamp() - $prevTime->getTimestamp();
            $intervals[] = $diff;
        }
        $prevTime = $dt;
    }

    // En sık login olunan saatler
    $hourFreq = array_count_values($activeHours);
    arsort($hourFreq);
    echo "En yoğun saat: " . array_key_first($hourFreq) . "<br>";

    // En aktif günler
    $dayFreq = array_count_values($days); //dizideki elemanların kaç kez tekrarlandığını say.
    arsort($dayFreq); //büyükten küçüğe sırala.
    echo "En aktif gün: " . array_key_first($dayFreq) . "<br>";

    // Ortalama giriş aralığı (saniye cinsinden)
    $avgInterval = array_sum($intervals) / count($intervals);
    echo "Ortalama tekrar süresi (dk): " . round($avgInterval / 60, 2) . "<br>";

    //📍Yaklaşımlar
    /*1️⃣. Ortalama Aralık Yöntemi:
    Kullanıcının iki login arasındaki ortalama süre hesaplanır. Son login'e bu süre eklenerek bir sonraki tahmini login zamanı elde edilir.*/
    $intervals = [];
    for ($i = 1; $i < count($logins); $i++) {
        $t1 = new DateTime($logins[$i - 1]);
        $t2 = new DateTime($logins[$i]);
        $intervals[] = $t2->getTimestamp() - $t1->getTimestamp();
    }

    $avgSeconds = array_sum($intervals) / count($intervals);
    $lastLogin = new DateTime(end($logins));
    $predictedNext1 = clone $lastLogin;
    $predictedNext1->modify("+$avgSeconds seconds");

    echo "Tahmini login zamanı (Ortalama Aralık): " . $predictedNext1->format("Y-m-d H:i:s");
    echo "<br>";

    /*2️⃣. Gün + Saat Patern Yöntemi: 
    Kullanıcı en çok hangi gün ve saatte giriş yapıyorsa, o gün + saat paterni tekrar eder varsayımıyla tahmin yapılır.*/
    $mostCommonHour = (int)array_key_first($hourFreq);
    $mostCommonDay = array_key_first(array_count_values($loginWeekdays));

    $today = new DateTime();
    while ($today->format('l') !== $mostCommonDay) {
        $today->modify('+1 day'); // Bugün en sık giriş günü değilse 1 gün ilerle
    }
    $predictedNext2 = $today->setTime($mostCommonHour, 0, 0); //tahmin edilen günün (saat,dk,sn) ayarlaması.
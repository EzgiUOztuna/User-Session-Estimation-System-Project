<?php
foreach ($rows as $user) {
    $logins = $user["logins"];
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
    echo $predictedNext1;
}

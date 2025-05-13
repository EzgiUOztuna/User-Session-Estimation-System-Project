<?php
// CORS başlıkları ekle
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//case-test-api.humanas.io adresinden JSON verisini alma
$jsonData = file_get_contents('https://case-test-api.humanas.io/');
//from JSON data to PHP string
$phpData = json_decode($jsonData, true);

//tarayıcıya JSON formatında geri gönder
header('Content-Type: application/json');
echo json_encode($phpData);

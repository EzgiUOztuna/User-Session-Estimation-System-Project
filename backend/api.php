<?php
// CORS hataları için başlıklar
header("Access-Control-Allow-Origin: *"); //Tüm domain'lerden gelen istekleri kabul et
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//belirtilen adresden JSON verisi al
$jsonData = file_get_contents('https://case-test-api.humanas.io/');
//from JSON data to PHP string
$phpData = json_decode($jsonData, true);

//tarayıcıya JSON formatında geri gönder
header('Content-Type: application/json');
echo json_encode($phpData);

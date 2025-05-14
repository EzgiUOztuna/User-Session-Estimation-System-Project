<?php
// CORS hataları için başlıklar
header("Access-Control-Allow-Origin: *"); //Tüm domain'lerden gelen istekleri kabul et
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

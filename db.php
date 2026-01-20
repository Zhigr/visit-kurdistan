<?php
// ئەڤە بۆ هندێ یە ئەگەر خەلەتی هەبیت ب درێژی نیشان بدەت
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$db   = "tourism-db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "کێشە د داتابەیسێ دا هەیە! ئەڤ نڤیسینە کۆپی بکە و بۆ من بنێرە: " . mysqli_connect_error();
    exit();
}

mysqli_set_charset($conn, "utf8");
?>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tourism-db"; // ناوی داتابەیسەکەت وەک لە وێنەکاندا هەیە

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("پەیوەندی سەرکەوتوو نەبوو: " . mysqli_connect_error());
}
?>
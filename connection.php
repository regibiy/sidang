<?php
$servername = "ftp.puskesmasalianyangpnk.my.id";
$username = "puskesma_admin";
$password = "lAA3=th_u4ah";
$database = "puskesma_skripsi";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die("Database gagal terhubung :" . $conn->connect_error);

<?php

// Pengaturan database

$host = "localhost";

$username = "root"; 

$password = ""; 

$database = "qrcode"; 

// Membuat koneksi ke database

$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal

if (!$conn) {

    die("Koneksi database gagal: " . mysqli_connect_error());

}

?>
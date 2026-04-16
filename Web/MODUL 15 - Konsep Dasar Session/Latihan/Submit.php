<?php
session_start();

$namauser = $_POST['username'];
$password = $_POST['password'];

if ('Login Sukses') {

    $_SESSION['namauser'] = $namauser;


    echo "<p>Selamat Datang, <b>" . $_SESSION['namauser'] . "</b></p>";
    echo "<p>Berikut ini menu navigasi anda</p>";
    echo "<a href='hal1.php'>Menu 1</a><br>
    <a href='hal2.php'>Menu 2</a><br>
    <a href='hal3.php'>Menu 3</a><br>";
}

<?php
session_start();

include "cek.php";

$namauser = $_SESSION['namauser'];

echo "<h1>Ini Halaman Ketiga</h1>";
echo "<p>Anda login sebagai <b>$namauser</b></p>";
echo "<p>Berikut ini menu navigasi anda:</p>";

echo "
<a href='hal1.php'>Menu 1</a><br>
<a href='hal2.php'>Menu 2</a><br>
<a href='hal3.php'>Menu 3</a>
<p><a href='logout.php'>Logout</a></p>
";

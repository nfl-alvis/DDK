<?php
if(isset($_POST['submit'])) {
    $nama1 = $_POST['nama1'];
    $nama2 = $_POST['nama2'];
    $nama3 = $_POST['nama3'];
    $nama4 = $_POST['nama4'];

    echo "Sahabat Dekatku : <br>";
    echo "1. " . $nama1 . "<br>";
    echo "2. " . $nama2 . "<br>";
    echo "3. " . $nama3 . "<br>";
    echo "4. " . $nama4 . "<br>";
}
?>
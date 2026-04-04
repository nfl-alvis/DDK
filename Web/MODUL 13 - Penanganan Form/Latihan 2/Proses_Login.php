<?php
    if (isset($_POST['login'])) {
        $user = $_POST['nama'];
        $pass = $_POST['password'];
    }

    if ($user == "smkn4malang" && $pass == "123") {
        echo "<h2>Login Berhasil</h2>";
    } else {
        echo "<h2>Login Gagal</h2>";
    }
?>
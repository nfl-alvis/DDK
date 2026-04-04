<?php
if (isset($_POST['submit'])) {
    $jurusan = $_POST['jurusan'];
    echo "Jurusan yang anda pilih adalah : <b><font color='red'>" . $jurusan . "</font></b>";
}

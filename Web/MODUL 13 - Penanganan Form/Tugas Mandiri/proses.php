<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Hobby (array)
    $hobby = isset($_POST['hobby']) ? $_POST['hobby'] : [];

    // Ekskul (multiple select → array)
    $ekskul = isset($_POST['ekskul']) ? $_POST['ekskul'] : [];

    echo "<h2>Hasil Pendaftaran</h2>";
    echo "NIS: $nis <br>";
    echo "Nama: $nama <br>";
    echo "Kelas: $kelas <br>";
    echo "Tanggal Lahir: $tgl_lahir <br>";
    echo "Alamat: $alamat <br>";
    echo "Kota: $kota <br>";
    echo "Jenis Kelamin: $jenis_kelamin <br>";

    // Hobby
    echo "Hobby: ";
    if (!empty($hobby)) {
        echo implode(", ", $hobby);
    } else {
        echo "Tidak ada";
    }
    echo "<br>";

    // Ekskul
    echo "Ekskul: ";
    if (!empty($ekskul)) {
        echo implode(", ", $ekskul);
    } else {
        echo "Tidak ada";
    }
}

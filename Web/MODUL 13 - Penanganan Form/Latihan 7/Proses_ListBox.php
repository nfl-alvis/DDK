<?php
if (isset($_POST['submit'])) {
    $color = $_POST['color'];
    echo "<h2>Warna Favorit Anda Adalah : </h2>";
    foreach ($color as $warna) {
        echo "<li>" . $warna . "</li>";
    }
}

<?php
if (isset($_POST['submit'])) {
    $saran = $_POST['saran'];
    echo "<h2>Kritik / Saran Anda Adalah : </h2> <br>";
    echo "<font color=blue><b>" . $saran . "</b></font>";
}

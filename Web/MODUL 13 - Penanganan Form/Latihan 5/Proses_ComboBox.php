<?php
if (isset($_POST['submit'])) {
    $film = $_POST['kartun'];
    echo "<h2>Film Kartun Favorit Anda Adalah : </h2>";
    echo "<p>" . $film . "</p>";
}

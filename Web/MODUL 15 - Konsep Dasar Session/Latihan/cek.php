<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Anda belum login.";
    exit();
}

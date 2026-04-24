<?php
session_start();
session_unset();
session_abort();
echo "Anda Sudah Logout <br>";
echo "<a href='login.php'>Login Kembali</a>";
exit();

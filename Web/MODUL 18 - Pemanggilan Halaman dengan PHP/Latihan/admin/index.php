<?php
include 'templates/header.php';
include 'templates/sidebar.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$allowed = ['dashboard', 'user', 'berita'];
if (!in_array($page, $allowed)) {
    $page = 'dashboard';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <div class="main">
        <div class="content">
            <?php include "pages/$page.php"; ?>
        </div>
        <?php include 'templates/footer.php'; ?>
    </div>
</body>

</html>
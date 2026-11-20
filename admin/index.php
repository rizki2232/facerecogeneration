<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Absen Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="index.php?page=dashboard">Dashboard</a>
        <a href="index.php?page=siswa">Siswa</a>
        <a href="index.php?page=absen">Absen</a>
    </div>
    <div class="content">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == "dashboard") {
                include "dashboard.php";
            } elseif ($page == "siswa") {
                include "siswa.php";
            } elseif ($page == "absen") {
                include "absen.php";
            } else {
                echo "<h1>Page not found</h1>";
            }
        } else {
            include "dashboard.php";
        }
        ?>
    </div>
</body>
</html>

<?php 
session_start();

if($_SESSION["level"] != "koordinator"){
     header("location:index.php");
}

include 'koneksi.php';
$id = $_SESSION['id'];
$data = mysqli_query($conn, "SELECT * FROM dosen WHERE user_id='$id'");
$dosen = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Sistem Informasi</h3>
            </div>
            <ul class="list-unstyled components"> 
                <li class="active">
                    <a href="dashboard-koor.php">Dashboard</a>
                </li>
                <li>
                    <a href="pendaftar-kp.php">Pendaftar KP</a>
                </li>
                <li>
                    <a href="pendaftar-ujian-kp.php">Pendaftar Ujian KP</a>
                </li>
                <li>
                    <a>Unggah</a>
                    <ul class="list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="unggah-surat-izin.php">Surat Izin</a>
                        </li>
                        <li>
                            <a href="unggah-jadwal-ujian.php">Jadwal Ujian</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <h5>Dashboard</h5>
                    <a href="logout.php" class="btn btn-dark">Keluar</a>
                </div>
            </nav>
            <div class="container">
                <h3 class="text-center">Selamat Datang di SIM Politeknik Negeri Banyuwangi</h3>
            </div>
        </div>
    </body>

</html>
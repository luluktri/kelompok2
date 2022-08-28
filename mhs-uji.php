<?php
session_start();

if (!isset($_SESSION["username"])) {

    header("location:index.php");
}

require 'koneksi.php';

$data = mysqli_query($conn, "SELECT mahasiswa.nim,nama,kelas,laporan_kp FROM mahasiswa join anggota_kelompok on mahasiswa.anggota_kelompok_id=anggota_kelompok.id join pendaftaran_kp on anggota_kelompok.id=pendaftaran_kp.anggota_kelompok_id join pendaftaran_ujian_kp on pendaftaran_kp.id=pendaftaran_ujian_kp.pendaftaran_kp_id join acc_ujian on acc_ujian.id=pendaftaran_ujian_kp.acc_ujian_id");
$datamhs = mysqli_fetch_array($data);
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
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Sistem Informasi</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="dashboard-dosen.php">Dashboard</a>
                </li>
                <li>
                    <a href="profil-dosen.php">Ubah Profil</a>
                </li>
                <li>
                    <a>Data Mahasiswa</a>
                    <ul class="list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="mhs-bimbingan.php">Mahasiswa Bimbingan</a>
                        </li>
                        <li class="active">
                            <a href="mhs-uji.php">Mahasiswa Diuji</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>Unggah Nilai</a>
                    <ul class="list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="nilai-bimbingan.php">Mahasiswa Bimbingan</a>
                        </li>
                        <li>
                            <a href="nilai-uji.php">Mahasiswa Diuji</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <h5>Mahasiswa Diuji</h5>
                    <a href="logout.php" class="btn btn-dark">Keluar</a>
            </nav>
            <div class="container-fluid">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIM</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">LAPORAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $mhs) { ?>
                        <tr>
                            <th scope="row"><?php echo $mhs['nim']; ?></th>
                            <td><?php echo $mhs['nama']; ?></td>
                            <td><?php echo $mhs['kelas']; ?></td>
                            <td><a href="file/<?php echo $mhs['laporan_kp']; ?>" class="btn btn-outline-primary"><?php echo $mhs['laporan_kp']; ?></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php
session_start();

if ($_SESSION["level"] != "dosen") {
    header("location:index.php");
}

include 'koneksi.php';

$id = $_SESSION['id'];
$data = mysqli_query($conn, "SELECT * FROM dosen WHERE user_id='$id'");
$dosen = mysqli_fetch_array($data);
$datamhs = mysqli_query($conn, "SELECT * FROM mahasiswa JOIN anggota_kelompok ON mahasiswa.anggota_kelompok_id=anggota_kelompok.id JOIN pendaftaran_kp on anggota_kelompok.id=pendaftaran_kp.anggota_kelompok_id WHERE dosen_id='$id' AND nama_anggota IS NOT NULL");
$mahasiswa = mysqli_fetch_array($datamhs);
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
                <li><a href="dashboard-dosen.php">Dashboard</a></li>
                <li><a href="profil-dosen.php">Ubah Profil</a></li>
                <li>
                    <a>Data Mahasiswa</a>
                    <ul class="list-unstyled" id="homeSubmenu">
                        <li class="active">
                            <a href="mhs-bimbingan.php">Mahasiswa Bimbingan</a>
                        </li>
                        <li>
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
                    <h5>Mahasiswa Bimbingan</h5>
                    <a href="logout.php" class="btn btn-dark">Keluar</a>
                </div>
            </nav>
            <div class="container">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIM</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">KELOMPOK</th>
                            <th scope="col">PROPOSAL</th>
                            <th scope="col">BIMBINGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datamhs as $mhs) { ?>
                        <tr>
                            <th scope="row"><?php echo $mhs['nim']; ?></th>
                            <td><?php echo $mhs['nama']; ?></td>
                            <td><?php echo $mhs['kelas']; ?></td>
                            <td>
                                <?php if(is_null($mhs['nama_anggota'])) {?>
                                    -
                                <?php } else { echo $mhs['nama_anggota']; }?>
                            </td>
                            <td>
                                <?php if($mhs['proposal'] != '') {?>
                                    <a href="file/<?php echo $mhs['proposal']; ?>" class="btn btn-outline-primary"><?php echo $mhs['proposal']; ?></a>
                                <?php } else { echo "-"; }?>
                            </td>
                            <td>
                                <a href="monitoring-mhs.php?id=<?php echo $mhs['anggota_kelompok_id']; ?>" class="btn btn-primary">Monitoring</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
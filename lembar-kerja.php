<?php 
session_start();

if($_SESSION["level"] != "mahasiswa"){
    header("location:index.php");
}

include 'koneksi.php';
$id = $_SESSION['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE user_id='$id'");
$mhs = mysqli_fetch_array($data);
$kelompok_id = $mhs['anggota_kelompok_id'];
$lembar_kerja = mysqli_query($conn, "SELECT * FROM anggota_kelompok JOIN mahasiswa ON anggota_kelompok.id=mahasiswa.anggota_kelompok_id JOIN lembar_kerja ON anggota_kelompok.id=lembar_kerja.anggota_kelompok_id WHERE anggota_kelompok.id='$kelompok_id'");
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
                <li>
                    <a href="dashboard-mhs.php">Dashboard</a>
                </li>
                <li>
                    <a href="pendaftaran-kp.php">Pendaftaran KP</a>
                </li>
                <li>
                    <a href="dashboard-mhs.php">Surat Izin KP</a>
                </li>
                <li class="active">
                    <a href="lembar-kerja.php">Lembar Kerja KP</a>
                </li>
                <li>
                    <a href="pendaftaran-ujian-kp.php">Pendaftaran Ujian KP</a>
                </li>
                <li>
                    <a href="dashboard-mhs.php">Jadwal Ujian KP</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <h5>Lembar Kerja</h5>
                    <a href="logout.php" class="btn btn-dark">Keluar</a>
                </div>
            </nav>
            <div class="container">
                <a href="lembar-kerja-tambah.php" class="btn btn-primary mb-2">Tambah</a>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIM</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">KELOMPOK</th>
                            <th scope="col">FILE</th>
                            <th scope="col">TANGGAL</th>
                            <th scope="col">REVISI</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <?php if (!is_null($lembar_kerja)) { ?>
                    <tbody>
                        <?php foreach ($lembar_kerja as $mhs) { ?>
                        <tr>
                            <th><?php echo $mhs['nim']; ?></th>
                            <td><?php echo $mhs['nama']; ?></td>
                            <td><?php echo $mhs['kelas']; ?></td>
                            <td><?php echo $mhs['nama_anggota']; ?></td>
                            <td><a href="file/<?php echo $mhs['file']; ?>" class="btn btn-outline-primary"><?php echo $mhs['file']; ?></a></td>
                            <td><?php echo $mhs['tanggal']; ?></td>
                            <td><?php echo $mhs['revisi']; ?></td>
                            <td><a href="lembar-kerja-edit.php?id=<?php echo $mhs['id']; ?>" class="btn btn-danger ml-3">Edit</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>

</html>
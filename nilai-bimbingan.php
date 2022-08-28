<?php
session_start();

if ($_SESSION["level"] != "dosen") {
    header("location:index.php");
}

include 'koneksi.php';

if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $nilai = $_POST['nilai'];
    mysqli_query($conn, "UPDATE nilai SET nilai_pembimbing_kp='$nilai' WHERE id='$id' ");
    header("location:nilai-bimbingan.php");

}

$id = $_SESSION['id'];
$data = mysqli_query($conn, "SELECT * FROM dosen WHERE user_id='$id'");
$dosen = mysqli_fetch_array($data);
// $datamhs = mysqli_query($conn, "SELECT * FROM mahasiswa JOIN anggota_kelompok ON mahasiswa.anggota_kelompok_id=anggota_kelompok.id JOIN pendaftaran_kp on anggota_kelompok.id=pendaftaran_kp.anggota_kelompok_id WHERE dosen_id='$id' AND nama_anggota IS NOT NULL");
// $mahasiswa = mysqli_fetch_array($datamhs);

$datamhs = mysqli_query($conn, "SELECT mahasiswa.nim,nama,kelas,mahasiswa.anggota_kelompok_id,nilai.id,nilai.nilai_pembimbing_kp FROM mahasiswa JOIN anggota_kelompok ON mahasiswa.anggota_kelompok_id=anggota_kelompok.id JOIN pendaftaran_kp on anggota_kelompok.id=pendaftaran_kp.anggota_kelompok_id JOIN pendaftaran_ujian_kp on pendaftaran_kp.id=pendaftaran_ujian_kp.pendaftaran_kp_id JOIN nilai on pendaftaran_ujian_kp.id=nilai.pendaftaran_ujian_kp_id WHERE dosen_id='$id' AND nama_anggota IS NOT NULL");
$mhsw = mysqli_fetch_array($datamhs);

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
                        <li>
                            <a href="mhs-uji.php">Mahasiswa Diuji</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>Unggah Nilai</a>
                    <ul class="list-unstyled" id="homeSubmenu">
                        <li class="active">
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
            </nav>
            <div class="container">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIM</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datamhs as $mhs) { ?>
                        <tr>
                            <th scope="row"><?php echo $mhs['nim']; ?></th>
                            <td><?php echo $mhs['nama']; ?></td>
                            <td><?php echo $mhs['kelas']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#nilai<?php echo $mhs["id"] ?>">Nilai</button>

                                <div class="modal fade" id="nilai<?php echo $mhs["id"] ?>" tabindex="-1" aria-labelledby="nilai<?php echo $mhs["id"] ?>label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pendaftaran KP</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="nilai-bimbingan.php?id=<?php echo $mhs['id']; ?>" method="post">
                                                    <div class="form-group">
                                                        <label for="nilai">Nilai</label>
                                                        <input type="text" class="form-control" id="nilai" name="nilai" value="<?php echo $mhs['nilai_pembimbing_kp']; ?>" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success" name="submit">Kirim</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.slim.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>
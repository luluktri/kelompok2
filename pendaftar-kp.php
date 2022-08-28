<?php
session_start();

include 'koneksi.php';

if ($_SESSION["level"] != "koordinator") {
    header("location:index.php");
}

if(isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama_anggota = $_POST['nama_anggota'];

    $anggota = mysqli_query($conn, "UPDATE anggota_kelompok SET nama_anggota='$nama_anggota' WHERE nim='$nim'");
}

$mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa JOIN anggota_kelompok ON mahasiswa.anggota_kelompok_id=anggota_kelompok.id JOIN pendaftaran_kp ON mahasiswa.anggota_kelompok_id=pendaftaran_kp.anggota_kelompok_id JOIN dosen ON pendaftaran_kp.dosen_id=dosen.id ORDER BY pendaftaran_kp.id DESC");
$maha = mysqli_fetch_array($mahasiswa);
// var_dump($maha);
// $dosen = mysqli_query($conn, "SELECT * FROM dosen");
// $pendkp = mysqli_query($conn, "SELECT nama, mahasiswa.nim, anggota_kelompok_id FROM mahasiswa INNER JOIN anggota_kelompok ON mahasiswa.nim=anggota_kelompok.nim WHERE user_id='$id'");
// $pendaftarankp = mysqli_num_rows($pendkp);
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
                    <a href="dashboard-koor.php">Dashboard</a>
                </li>
                <li class="active">
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
                    <h5>Pendaftar KP</h5>
                    <a href="logout.php" class="btn btn-dark">Keluar</a>
                </div>
            </nav>  
            <div class="container-fluid">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIM</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">Tempat KP</th>
                            <th scope="col">Alamat KP</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Selesai</th>
                            <th scope="col">Proposal</th>
                            <th scope="col">Dosen Pembimbing</th>
                            <th scope="col">Kelompok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $mhs) { ?>
                        <tr>
                            <th><?php echo $mhs['nim']; ?></th>
                            <td><?php echo $mhs['nama']; ?></td>
                            <td><?php echo $mhs['kelas']; ?></td>
                            <td><?php echo $mhs['tempat_kp']; ?></td>
                            <td><?php echo $mhs['alamat_kp']; ?></td>
                            <td><?php echo $mhs['tanggal_mulai']; ?></td>
                            <td><?php echo $mhs['tanggal_selesai']; ?></td>
                            <td>
                            <?php if($mhs['proposal'] != null) {?>
                                <a href="file/<?php echo $mhs['proposal']; ?>" class="btn btn-outline-primary"><?php echo $mhs['proposal']; ?></a>
                            <?php } else { echo "-"; }?>
                            </td>
                            <td><?php echo $mhs['nama_dosen']; ?></td>
                            <td>
                                <?php if(is_null($mhs['nama_anggota'])) {?>
                                    -
                                <?php } else { echo $mhs['nama_anggota']; }?>
                            </td>
                            <td>
                                <?php if(is_null($mhs['nama_anggota'])) {?>
                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#mhs<?php echo $mhs["id"] ?>">Setujui</button>

                                <div class="modal fade" id="mhs<?php echo $mhs["id"] ?>" tabindex="-1" aria-labelledby="mhs<?php echo $mhs["id"] ?>label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pendaftaran KP</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">
                                            <form action="pendaftar-kp.php" method="post">
                                                <div class="form-group">
                                                    <label for="nim">NIM</label>
                                                    <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $mhs['nim']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_anggota">Nomor Kelompok</label>
                                                    <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="submit">Setujui</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="tolak" class="btn btn-danger">Tolak</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-success">Verified</button>
                                <?php } ?>
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
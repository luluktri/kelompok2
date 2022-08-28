<?php
session_start();

include 'koneksi.php';

if ($_SESSION["level"] != "koordinator") {
    header("location:index.php");
}

if(isset($_POST['submit'])) {
    $id = $_GET['id'] ;
    $dosen = $_POST['dosen'];
    $tanggal = $_POST['tanggal'];
    $acc_ujian = mysqli_query($conn, "INSERT INTO acc_ujian(dosen_penguji,jadwal_ujian) VALUES('$dosen','$tanggal')");
    $id_acc = mysqli_insert_id($conn);
    $anggota = mysqli_query($conn, "UPDATE pendaftaran_ujian_kp SET jadwal_ujian='$tanggal',acc_ujian_id='$id_acc' WHERE id='$id'");
    mysqli_query($conn, "INSERT INTO nilai(pendaftaran_ujian_kp_id) VALUES('$id')");
}

$mahasiswa = mysqli_query($conn, "SELECT pendaftaran_ujian_kp.id,jadwal_ujian,mahasiswa.nim,nama,kelas,nama_anggota,laporan_kp,nama_dosen,acc_ujian_id FROM mahasiswa JOIN anggota_kelompok ON mahasiswa.anggota_kelompok_id=anggota_kelompok.id JOIN pendaftaran_kp ON mahasiswa.anggota_kelompok_id=pendaftaran_kp.anggota_kelompok_id JOIN dosen ON pendaftaran_kp.dosen_id=dosen.id JOIN pendaftaran_ujian_kp ON pendaftaran_kp.id=pendaftaran_ujian_kp.pendaftaran_kp_id ORDER BY pendaftaran_kp.id DESC");
$maha = mysqli_fetch_array($mahasiswa);
$dosen = mysqli_query($conn, "SELECT * FROM dosen");
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
                <li>
                    <a href="pendaftar-kp.php">Pendaftar KP</a>
                </li>
                <li class="active">
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
                            <th scope="col">KELOMPOK</th>
                            <th scope="col">LAPORAN</th>
                            <th scope="col">Dosen Pembimbing</th>
                            <th scope="col">Dosen Penguji</th>
                            <th scope="col">Tanggal Ujian</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $mhs) { ?>
                        <tr>
                            <th><?php echo $mhs['nim']; ?></th>
                            <td><?php echo $mhs['nama']; ?></td>
                            <td><?php echo $mhs['kelas']; ?></td>
                            <td><?php echo $mhs['nama_anggota']; ?></td>
                            <td><a href="file/<?php echo $mhs['laporan_kp']; ?>" class="btn btn-outline-primary"><?php echo $mhs['laporan_kp']; ?></a></td>
                            <td><?php echo $mhs['nama_dosen']; ?></td>
                            <td>
                            <?php if(is_null($mhs['acc_ujian_id'])) { echo "-"; } else { ?>
                            <?php 
                                $id_uji = $mhs['acc_ujian_id'];
                                $qpenguji = mysqli_query($conn, "SELECT * FROM acc_ujian JOIN dosen ON acc_ujian.dosen_penguji=dosen.id WHERE acc_ujian.id='$id_uji'");
                                $datapenguji = mysqli_fetch_array($qpenguji);
                                echo $datapenguji['nama_dosen'];
                            ?>
                            <?php } ?>
                            </td>
                            <td>
                                <?php if(is_null($mhs['jadwal_ujian'])) { echo "-"; } else { echo $mhs['jadwal_ujian']; } ?>
                            </td>
                            <td>
                                <?php if(is_null($mhs['acc_ujian_id'])) {?>
                                <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#mhs<?php echo $mhs["id"] ?>">Setujui</button>

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
                                                <form action="pendaftar-ujian-kp.php?id=<?php echo $mhs['id']; ?>" method="post">
                                                    <div class="form-group">
                                                        <label for="nim">NIM</label>
                                                        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $mhs['nim']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dosen">Dosen Penguji</label>
                                                        <select class="form-control" id="dosen" name="dosen" required>
                                                            <option disabled selected value> -- Pilih Dosen Penguji -- </option>
                                                            <?php foreach ($dosen as $dsn) { ?>
                                                            <option value="<?php echo $dsn['id']; ?>"><?php echo $dsn['nama_dosen']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Ujian</label>
                                                        <input type="date" class="form-control" name="tanggal" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success" name="submit">Setujui</button>
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
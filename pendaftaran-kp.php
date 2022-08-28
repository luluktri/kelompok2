<?php
session_start();

include 'koneksi.php';

if ($_SESSION["level"] != "mahasiswa") {
    header("location:index.php");
}

if(isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $instansi = $_POST['instansi'];
    $alamat = $_POST['alamat'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];
    $dosbim = $_POST['dosen'];

    $anggota = mysqli_query($conn, "INSERT INTO anggota_kelompok(nim) VALUES('$nim')");
    $id_anggota = mysqli_insert_id($conn);
    mysqli_query($conn, "UPDATE mahasiswa SET anggota_kelompok_id='$id_anggota' WHERE nim='$nim'");

    if(isset($_FILES)) {
        $proposal = $_FILES['proposal']['name'];
        $file_tmp = $_FILES['proposal']['tmp_name'];
        move_uploaded_file($file_tmp, 'file/'.$proposal);
        mysqli_query($conn, "INSERT INTO pendaftaran_kp(tempat_kp,alamat_kp,tanggal_mulai,tanggal_selesai,proposal,anggota_kelompok_id,dosen_id) VALUES('$instansi','$alamat','$mulai','$selesai','$proposal','$id_anggota','$dosbim')");
    } else {
        mysqli_query($conn, "INSERT INTO pendaftaran_kp(tempat_kp,alamat_kp,tanggal_mulai,tanggal_selesai,anggota_kelompok_id,dosen_id) VALUES('$instansi','$alamat','$mulai','$selesai','$id_anggota','$dosbim')");
    }

}

$id = $_SESSION['id'];
$mahasiswa = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE user_id='$id'");
$mhs = mysqli_fetch_array($mahasiswa);
$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$pendkp = mysqli_query($conn, "SELECT nama, mahasiswa.nim, anggota_kelompok_id FROM mahasiswa INNER JOIN anggota_kelompok ON mahasiswa.nim=anggota_kelompok.nim WHERE user_id='$id'");
$pendaftarankp = mysqli_num_rows($pendkp);
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
                <li class="active">
                    <a href="pendaftaran-kp.php">Pendaftaran KP</a>
                </li>
                <li>
                    <a href="dashboard-mhs.php">Surat Izin KP</a>
                </li>
                <li>
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
                    <h5>Pendaftaran KP</h5>
                    <a href="logout.php" class="btn btn-dark">Keluar</a>
                </div>
            </nav>  
            <div class="container">
                <?php if ($pendaftarankp == 0) {?>
                <form action="pendaftaran-kp.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $mhs['nim']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Nama Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="instansi" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Instansi</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="alamat">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="mulai">
                            </div>
                            <div class="col">
                                <label for="alamat">Tanggal Selesai</label> 
                                <input type="date" class="form-control" name="selesai">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen Pembimbing</label>
                        <select class="form-control" id="dosen" name="dosen" required>
                            <option disabled selected value> -- Pilih Dosen Pembimbing -- </option>
                            <?php foreach ($dosen as $dsn) { ?>
                            <option value="<?php echo $dsn['id']; ?>"><?php echo $dsn['nama_dosen']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="proposal">File Proposal</label>
                        <input type="file" class="form-control-file" id="proposal" name="proposal">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
                </form>
                <?php } else { ?>
                    <h5 class="mb-4">Anda sudah mendaftar.</h5>
                <?php } ?>
            </div>
        </div>
</body>

</html>
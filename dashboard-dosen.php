<?php 
session_start();

if($_SESSION["level"] != "dosen"){
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
                    <h5>Dashboard</h5>
                    <a href="logout.php" class="btn btn-dark">Keluar</a>
                </div>
            </nav>
            <div class="container">
            <h3 class="text-center">Selamat Datang di SIM Politeknik Negeri Banyuwangi</h3>
                <div class="form-group mt-4 mb-4">
                    <div class="form-row">
                        <div class="col-lg-3">
                            <img src="assets/img/<?php echo $dosen['foto']; ?>" width="100%" height="100%">
                        </div>
                        <div class="col-lg-9">
                            
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">NIP</div>
                                    <div class="col-md-8">: <?php echo $dosen['nik']; ?></div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">Nama</div>
                                    <div class="col-md-8">: <?php echo $dosen['nama_dosen']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
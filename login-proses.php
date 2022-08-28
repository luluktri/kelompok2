<?php 
    session_start();

    include 'koneksi.php';

    $username = $_POST['username'];
    $pass = $_POST['password'];

    $login = mysqli_query($conn, "SELECT * FROM user INNER JOIN user_role on user.id_role=user_role.id_user WHERE username='$username' AND password='$pass'");
    $check = mysqli_num_rows($login);

    // Cek apakah users ada di dalam database
    if($check > 0){
        $data = mysqli_fetch_assoc($login);

        // Cek ketika user login sebagai dosen
        if($data['role'] == "dosen"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "dosen";
            $_SESSION['id'] = $data['id'];

            // Alihkan ke halaman dosen
            header("location:dashboard-dosen.php");

        } 
        // Cek ketika user login sebagai mahasiswa
        else if($data['role'] == "mahasiswa"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "mahasiswa";
            $_SESSION['id'] = $data['id'];

            // Alihkan ke halaman mahasiswa
            header("location:dashboard-mhs.php");
        }
        // Cek ketika user login sebagai koordinator
        else if($data['role'] == "koordinator"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "koordinator";
            $_SESSION['id'] = $data['id'];

            // Alihkan ke halaman koordinator
            header("location:dashboard-koor.php");
        }
        else{
            echo "
                <script>
                    alert ('Gagal login!')
                    document.location.href = 'login.php';
                </script>
        ";
        }
    } else{
        echo "
                <script>
                    alert ('Gagal login!')
                    document.location.href = 'login.php';
                </script>
        ";
    }


?>
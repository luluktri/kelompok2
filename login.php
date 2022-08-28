<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Informasi</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <!-- Login Form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4 shadow-lg p-3 mb-5 bg-body rounded">
                <h5 class="text-center">LOGIN</h5>
                <form action="login-proses.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-outline-success rounded-pill">Login</button>
                        <p class="my-3">
                            <a href="index.php">Back</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Login Form -->
</body>

</html>
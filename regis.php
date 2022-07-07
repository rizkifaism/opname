<?php
    require 'function.php';

    if(isset($_POST["register"])) {
        if(registrasi($_POST) > 0) {
            echo "<script>
                alert('User baru berhasil ditambahkan');
                document.location.href = 'login.php';
            </script>";
        } else {
            echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
    <style>
        body {
            background-color: #0DCAF0;
        }

        .container {
            background: rgba(255, 255, 255, 0.5);
            width: 400px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 180px;
        }

        table {
            margin: auto;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        h1 {
            text-align: center;
            padding-top: 20px;
        }

        span, a {
            font-size: 0.8em;
        }

        @media screen and (max-width: 576px) {
            .container {
                width: 350px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Halaman Daftar Akun</h1>

        <table>
            <form action="" method="post">
                <tr>
                    <td><label for="username">Nama pengguna :</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="username" id="username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Kata sandi :</label></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" id="password" required></td>
                </tr>
                <tr>
                    <td><label for="password2">Konfirmasi password :</label></td>
                </tr>
                <tr>
                    <td><input type="password" name="password2" id="password2" required></td>
                </tr>
                <tr>
                    <td><span>Sudah punya akun? <a href="login.php">Masuk</a></span></td>
                </tr>
                <tr>
                    <td><button type="submit" name="register">Daftar</button></td>
                </tr>
            </form>
        </table>
    </div>
</body>
</html>
<?php
    session_start();
    require 'function.php';

    if(isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    };

    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                $_SESSION["login"] = $row["username"];

                header("Location: index.php");
                exit;
            }
        }

        $error = true;

        if(isset($error)) {
            echo "<script>
                alert('Username / password salah!');
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Masuk</title>
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
            border-radius: 10px;
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
        <h1>Halaman Masuk</h1>

        <table>
            <form action="" method="post">
                <tr>
                    <td><label for="username">Nama pengguna</label></td>
                    <td>:</td>
                    <td><input type="text" name="username" id="username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Kata sandi</label></td>
                    <td>:</td>
                    <td><input type="password" name="password" id="password" required></td>
                </tr>
                <tr>
                    <td><span>Belum punya akun</span></td>
                    <td><span>?</span></td>
                    <td><a href="regis.php">Daftar</a></td>
                </tr>
                <tr>
                    <td><button type="submit" name="login">Masuk</button></td>
                </tr>
            </form>
        </table>
    </div>
</body>
</html>
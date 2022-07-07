<?php 
  session_start();
  require 'function.php';

  if(!isset($_SESSION["login"])) {
      header("Location: login.php");
      exit;
  }

  $km = $_GET["km"];

  if(hapus_keluar($km) > 0) {
    echo "<script>
                alert('Data Barang Keluar berhasil dihapus!');
                document.location.href = 'tampil-barang-keluar.php';
            </script>";
  } else {
    echo "<script>
                alert('Data Barang Keluar gagal dihapus!');
                document.location.href = 'tampil-barang-keluar.php';
            </script>";
  }
?>
<?php 
  session_start();
  require 'function.php';

  if(!isset($_SESSION["login"])) {
      header("Location: login.php");
      exit;
  }

  $kd = $_GET["kd"];

  if(hapus($kd) > 0) {
    echo "<script>
                alert('Data Barang berhasil dihapus!');
                document.location.href = 'tampil-barang.php';
            </script>";
  } else {
    echo "<script>
                alert('Data Barang gagal dihapus!');
                document.location.href = 'tampil-barang.php';
            </script>";
  }
?>
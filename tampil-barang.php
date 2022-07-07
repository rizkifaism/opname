<?php 
  require 'function.php';

  $barang = masukkan("SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Barang</title>
</head>
<body>
  <h1>Tampilan Barang</h1>

  <table border="1" cellspacing="0" cellpadding="10">
    <tr>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Jenis Barang</th>
      <th>Stok Barang</th>
      <th>Aksi</th>
    </tr>
    
    <?php $i = 1?>
    <?php foreach ($barang as $br) : ?>
    <tr>
      <td><?= $i; ?></td>
      <td><?= $br["kd_barang"] ?></td>
      <td><?= $br["nama_barang"] ?></td>
      <td><?= $br["jenis_barang"] ?></td>
      <td><?= $br["stok"] ?></td>
      <td>
        <a href="ubah-barang.php?kd=<?= $br["kd_barang"]; ?>">Ubah</a> |
        <a href="hapus-barang.php?kd=<?= $br["kd_barang"]; ?>">Hapus</a>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
  </table>

  <br> <br>
  <a href="input-barang.php">Tambah Barang</a>
</body>
</html>
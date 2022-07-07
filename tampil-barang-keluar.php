<?php 
  session_start();
  require 'function.php';

  if(!isset($_SESSION["login"])) {
      header("Location: login.php");
      exit;
  }

  $jumlahDataPerhalaman = 2;
  $jumlahData = count(masukkan("SELECT * FROM brng_keluar"));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
  $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
  $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
  
  $barangKeluar = masukkan("SELECT * FROM brng_keluar LIMIT $awalData, $jumlahDataPerhalaman");

  if(isset($_POST["cari"])) {
    $barangKeluar = cariKeluar($_POST["keyword"]);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Barang Keluar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-info mb-3 sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">Hai, <?= $_SESSION["login"]; ?>!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tampil-barang-masuk.php">Barang Masuk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="relasi.php">Relasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" title="Keluar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section>
    <div class="container">
      <h1 class="mb-3">Tampilan Barang Keluar</h1>

      <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus autocomplete="off" placeholder="Masukkan kode atau nama barang">
        <button type="submit" name="cari" class="btn btn-info">Cari!</button>
      </form>
          
          <?php if($halamanAktif > 1) :?>
            <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
          <?php endif;?>

          <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
              <?php if($i == $halamanAktif) :?>
                  <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color:red;"><?= $i; ?></a>
              <?php else :?>
                  <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
              <?php endif;?>
          <?php endfor;?>

          <?php if($halamanAktif < $jumlahHalaman) :?>
              <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
          <?php endif;?>

      <table class="table table-bordered">
        <tr>
          <th>No</th>
          <th>Kode Barang Keluar</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Jenis Barang</th>
          <th>Jumlah Barang</th>
          <th>Tanggal Keluar</th>
          <th>Aksi</th>
        </tr>
        
        <?php $i = 1?>
        <?php foreach ($barangKeluar as $br) : ?>
        <tr>
          <td><?= $i; ?></td>
          <td><?= $br["kd_brng_keluar"] ?></td>
          <td><?= $br["kd_barang"] ?></td>
          <td><?= $br["nama_barang"] ?></td>
          <td><?= $br["jenis_barang"] ?></td>
          <td><?= $br["jumlah"] ?></td>
          <td><?= $br["tgl_keluar"] ?></td>
          <td>
            <a href="ubah-barang-keluar.php?km=<?= $br["kd_brng_keluar"]; ?>">Ubah</a> |
            <a href="hapus-barang-keluar.php?km=<?= $br["kd_brng_keluar"]; ?>">Hapus</a>
          </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
      </table>

      <br> <br>
      <a href="input-barang-keluar.php">Tambah Barang Keluar</a>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0dcaf0" fill-opacity="1" d="M0,224L80,208C160,192,320,160,480,170.7C640,181,800,235,960,240C1120,245,1280,203,1360,181.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
  </section>

  <footer class="bg-info text-white text-center pb-3" >
    <p>Created with <i class="bi bi-heart-fill text-danger"></i> by <a href="https://www.instagram.com/rizkifais.m/" target="_blank" rel="noopener noreferrer" class="text-white fw-bold" style="text-decoration: none;">Rizki Fais Mubarok</a></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
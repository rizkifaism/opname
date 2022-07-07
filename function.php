<?php 
  $conn = mysqli_connect("localhost", "root", "", "dbopname");

  function masukkan($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }
  
  function barang($data) {
    global $conn;
    $kd = htmlspecialchars($data["kd_barang"]);
    $nama = htmlspecialchars($data["nama_barang"]);
    $jenis = htmlspecialchars($data["jenis_barang"]);
    $stok = htmlspecialchars($data["stok"]);

    $query = "INSERT INTO barang VALUES ('$kd', '$nama', '$jenis', '$stok')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function barang_masuk($data) {
    global $conn;
    $kd_masuk = htmlspecialchars($data["kd_brng_masuk"]);
    $kd = htmlspecialchars($data["kd_barang"]);
    $nama = htmlspecialchars($data["nama_barang"]);
    $jenis = htmlspecialchars($data["jenis_barang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $tgl = htmlspecialchars($data["tgl_masuk"]);

    $query = "INSERT INTO brng_masuk VALUES ('$kd_masuk', '$kd', '$nama', '$jenis', '$jumlah', '$tgl')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function barang_keluar($data) {
    global $conn;
    $kd_masuk = htmlspecialchars($data["kd_brng_keluar"]);
    $kd = htmlspecialchars($data["kd_barang"]);
    $nama = htmlspecialchars($data["nama_barang"]);
    $jenis = htmlspecialchars($data["jenis_barang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $tgl = htmlspecialchars($data["tgl_masuk"]);

    $query = "INSERT INTO brng_keluar VALUES ('$kd_masuk', '$kd', '$nama', '$jenis', '$jumlah', '$tgl')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function ubah($data) {
    global $conn;
    $kd = htmlspecialchars($data["kd_barang"]);
    $nama = htmlspecialchars($data["nama_barang"]);
    $jenis = htmlspecialchars($data["jenis_barang"]);
    $stok = htmlspecialchars($data["stok"]);

    $query = "UPDATE barang SET nama_barang = '$nama', jenis_barang = '$jenis', stok = $stok WHERE kd_barang = '$kd'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function ubah_masuk($data) {
    global $conn;
    $kd_masuk = htmlspecialchars($data["kd_brng_masuk"]);
    $kd = htmlspecialchars($data["kd_barang"]);
    $nama = htmlspecialchars($data["nama_barang"]);
    $jenis = htmlspecialchars($data["jenis_barang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $tgl = htmlspecialchars($data["tgl_masuk"]);

    $query = "UPDATE brng_masuk SET kd_barang = '$kd', nama_barang = '$nama', jenis_barang = '$jenis', jumlah = $jumlah, tgl_masuk = '$tgl' WHERE kd_brng_masuk = '$kd_masuk'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function ubah_keluar($data) {
    global $conn;
    $kd_keluar = htmlspecialchars($data["kd_brng_keluar"]);
    $kd = htmlspecialchars($data["kd_barang"]);
    $nama = htmlspecialchars($data["nama_barang"]);
    $jenis = htmlspecialchars($data["jenis_barang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $tgl = htmlspecialchars($data["tgl_keluar"]);

    $query = "UPDATE brng_keluar SET kd_barang = '$kd', nama_barang = '$nama', jenis_barang = '$jenis', jumlah = $jumlah, tgl_keluar = '$tgl' WHERE kd_brng_keluar = '$kd_keluar'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  function hapus($kd) {
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE kd_barang = '$kd'");

    return mysqli_affected_rows($conn);
  }

  function hapus_masuk($km) {
    global $conn;
    mysqli_query($conn, "DELETE FROM brng_masuk WHERE kd_brng_masuk = '$km'");

    return mysqli_affected_rows($conn);
  }

  function hapus_keluar($km) {
    global $conn;
    mysqli_query($conn, "DELETE FROM brng_keluar WHERE kd_brng_keluar = '$km'");

    return mysqli_affected_rows($conn);
  }

  function cari($keyword) {
    $ambil = "SELECT * FROM barang WHERE kd_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%'";

    return masukkan($ambil);
  }

  function cariMasuk($keyword) {
    $ambil = "SELECT * FROM brng_masuk WHERE kd_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%'";

    return masukkan($ambil);
  }

  function cariKeluar($keyword) {
    $ambil = "SELECT * FROM brng_masuk WHERE kd_keluar LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%'";

    return masukkan($ambil);
  }

  function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username sudah terdaftar');
        </script>";
        return false;
    }

    if($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
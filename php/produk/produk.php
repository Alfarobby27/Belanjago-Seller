<?php
//jalankan session
session_start();

//cek apakah user berhasil login atau belum
if( !isset($_SESSION["login"]) ) {
    header("Location: ../loginReg/login.php");
    exit;
}

//panggil file functions
require '../functions/functions.php';

$marketplace = query("SELECT * FROM marketplace");

// tombol cari diklik
if ( isset($_POST["cari"]) ) {
    $marketplace = cari($_POST["keyword"]);
}

//format Rupiah
function formatRupiah($harga) {
  return 'Rp ' . number_format($harga, 0, ',', '.');
}

//pagination
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM marketplace"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["p"]) ) ? $_GET["p"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;
$marketplace = query("SELECT * FROM marketplace LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produk Saya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- My Styles -->
    <link rel="stylesheet" href="../../css/style_produk.css" />

  </head>
  <body>
    <!-- NavBar Start-->
    <nav class="navbar">
      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"
          ><img src="../../asset/hamburgerlight.png"
        /></a>
      </div>

      <a href="#" class="navbar-logo">Belanjago<span> seller</span></a>

      <div class="navbar-nav">
        <a href="../../index.php">Home</a>
        <div class="dropdown">
          <a href="#">Produk</a>
          <div class="dropdown-content">
            <a href="../tambah/tambah.php">Tambah Produk</a>
            <a href="#">Produk saya</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- NavBar End-->

    <!--Produk saya Begin-->
      <div class="wrapper">
          <h1 class="title">Produk saya</h1>
          <form action="" method="post" class="myForm">
               <input type="text" name="keyword" class="cari" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off"/>
               <button type="submit" name="cari" class="btn-cari btn">Cari produk</button>
          </form>
          <table class="myTable">
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th></th>
            </tr>
            
            <?php $i = 1; ?>
            <?php foreach( $marketplace as $row ) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><img src="../../img/<?= $row["gambar"]; ?>" width="50"></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= formatRupiah($row["harga"]); ?></td>
                <td><?= $row["stok"]; ?></td>
                <td>
                  <div class="atur">
                    <div class="btn-atur btn">Atur   </div>
                    <div class="atur-content">
                      <button class="btn-ubah ubah"><a href="../ubah/ubah.php?id=<?= $row["id"]; ?>">Ubah</a></button>
                      <button class="btn-hapus hapus"><a href="../hapus/hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ?');">Hapus</a></button>
                    </div>
                  </div>
                </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
          </table>
      </div>
      <!--Produk saya End-->
      <!-- Pagination Begin -->
      <div class="pagination">
          <?php if( $halamanAktif > 1 ) : ?>
            <div class="page">
                <a href="?p=<?= $halamanAktif - 1; ?>"  class="page-link" >&laquo;</a>
            </div>
          <?php endif; ?>

          <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
              <?php if( $i == $halamanAktif ) : ?>
                <div class="page">
                   <a href="?p=<?= $i; ?>" class="page-link" style="background-color: #8c623f;"><?= $i; ?></a>
                </div>
              <?php else : ?>
                <div class="page">
                    <a href="?p=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                </div>
              <?php endif; ?>
          <?php endfor; ?>
          
          <?php if( $halamanAktif < $jumlahHalaman ) : ?>
              <div class="page">
                  <a href="?p=<?= $halamanAktif + 1; ?>"  class="page-link" >&raquo;</a>
              </div>
          <?php endif; ?>
      </div>        
      <!-- Pagination End -->


      <!--Footer Begin-->
      <div class="footer">
          <h1 class="h1-footer"><span class="span1">&copy;</span> Alfarobby27<span> 2023<span></span></h1>
          <h2 id="clock"></h2>
      </div>
    <!--Footer End-->

    <!-- My Javascript-->
    <script src="../../js/script.js"></script>
    <script src="../../js/clock.js"></script>
  </body>
</html>

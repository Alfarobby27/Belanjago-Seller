<?php
    //jalankan session
    session_start();

    //cek apakah user berhasil login atau belum
    if( !isset($_SESSION["login"]) ) {
        header("Location: ./php/loginReg/login.php");
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Belanjago Seller</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- My Styles -->
    <link rel="stylesheet" href="css/style.css" />

    <style></style>
  </head>
  <body>
    <!-- NavBar Begin -->
    <nav class="navbar">
      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"
          ><img src="./asset/hamburgerlight.png"
        /></a>
      </div>

      <a href="#" class="navbar-logo">Belanjago<span> seller</span></a>
      <button class="btn-logout logout"><a href="./php/logout/logout.php">Logout</a></button>


      <div class="navbar-nav">
        <a href="#home">Home</a>
        <div class="dropdown">
          <a href="#">Produk</a>
          <div class="dropdown-content">
            <a href="./php/tambah/tambah.php">Tambah Produk</a>
            <a href="./php/produk/produk.php">Produk saya</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- NavBar End-->

    <!-- Home Begin -->
    <div class="wrapper">
      <h1 class="judul">Selamat Datang di Belanjago seller</h1>
      <p class="deskripsi">Ini adalah e-commerce sederhana</p>
      <img src="./asset/Data Base.jpg" alt="DATA BASE" class="database" />
    </div>
    <!-- Home End -->

    <!-- Footer Begin -->
    <div class="footer">
      <h1 class="h1-footer">
        <span class="span1">&copy;</span> Alfarobby27<span> 2023</span>
      </h1>
      <h2 id="clock"></h2>
    </div>
    <!-- Footer End -->

    <!-- My Javascript -->
    <script src="js/script.js"></script>
    <script src="js/clock.js"></script>
  </body>
</html>

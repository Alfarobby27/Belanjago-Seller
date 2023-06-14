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

//ambil data di URL
$id = $_GET["id"];

//query data marketplace berdasarkan id
$mp = query("SELECT * FROM marketplace WHERE id = $id")[0];

//cek apakah tombol submit sudah diklik atau belum
if ( isset($_POST["submit"]) ) {

    //cek apakah data berhasil diubah atau tidak
    if ( ubah($_POST) > 0 ) {
        echo "
        <script>
            alert('Data berhasil diubah!');
            document.location.href= '../produk/produk.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href= '../produk/produk.php';
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
    <title>Ubah data marketplace</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- My Styles -->
    <link rel="stylesheet" href="../../css/style_form.css" />
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
            <a href="../produk/produk.php">Produk saya</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- NavBar End-->

    <!-- Ubah Begin -->
    <div class="wrapper">
        <h1>Ubah Produk</h1>
        <form action="" method="post" enctype="multipart/form-data" class="myForm">
            <input type="hidden" name="id" value="<?= $mp["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $mp["gambar"]; ?>">
            <table class="myTable">
                <tr>
                    <td>
                        <label for="gambar"> Gambar Produk<span class="tab">:</span></label> <br>
                        <img src="../../img/<?= $mp["gambar"]; ?>"  width="80"><br>
                        <input type="file" name="gambar" id="gambar" autocomplete="off"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nama">Nama Produk<span> :</span></label>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama produk..." class="custom-input" value="<?= $mp["nama"]; ?>" autocomplete="off"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="harga">Harga Produk<span>:</span></label>
                        <input type="text" name="harga" id="harga" placeholder="Masukkan harga produk..." class="custom-input" required value="<?= $mp["harga"]; ?>" autocomplete="off"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="stok">Stok Produk<span class="tab2">  :</span></label>
                        <input type="text" name="stok" id="stok" placeholder="Masukkan stok produk..." class="custom-input" required value="<?= $mp["stok"]; ?>" autocomplete="off"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" name="submit" class="btn-save btn" onclick="confirm('Anda yakin ingin mengubah data ?');">Save</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- Ubah End -->

    <!--Footer Begin-->
    <div class="footer">
      <h1 class="h1-footer">
        <span class="span1">&copy;</span> Alfarobby27<span> 2023</span>
      </h1>
      <h2 id="clock"></h2>
    </div>
    <!--Footer End-->

    <!-- My Javascript-->
    <script src="../../js/script.js"></script>
    <script src="../../js/clock.js"></script>
</body>
</html>
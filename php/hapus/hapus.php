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

$id = $_GET["id"];

if ( hapus($id) > 0 ) {
    echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href= '../produk/produk.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href= '../produk/produk.php';
        </script>
    ";
}

?>
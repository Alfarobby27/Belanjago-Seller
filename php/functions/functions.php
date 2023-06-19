<?php
//koneksi ke database
//parameternya nama localhostnya, usernamenya, password, nama databasenya
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


//tampil data
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

//tambah data
function tambah($data) {
    global $conn;

    $gambar = htmlspecialchars($data["gambar"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    //upload gambar
    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO marketplace
                VALUES
              ('', '$gambar', '$nama', '$harga', '$stok')
             ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {

    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    //cek apakah tidak ada gambar yang diupload
    if ( $error === 4 ) {
        echo "<script>
                    alert('Pilih gambar terlebih dahulu');
              </script>
             ";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('Yang anda upload bukan gambar');
              </script>
            ";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ( $ukuranFile === 1000000 ) {
        echo "<script>
                alert('Ukuran gambar terlalu besar');
              </script>
             ";
        return false;
    }

    // lolos pengecekan, gambar siap diupload

    //generate  nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../../img/' . $namaFileBaru);

    return $namaFileBaru;
}

//hapus data
function hapus($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM marketplace WHERE id = $id");

    return mysqli_affected_rows($conn);
}

//ubah data
function ubah($data) {
    global $conn;

    $id = $data["id"];
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);


    //cek apakah user pilih gambar baru atau tidak
    if ( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    //query insert data
    $query = "UPDATE marketplace SET
                gambar = '$gambar',
                nama = '$nama',
                harga = '$harga',
                stok = '$stok'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//cari data
function cari($keyword) {
    $query = "SELECT * FROM marketplace
                 WHERE
               nama LIKE '%$keyword%'
             ";

    return query($query);
}

//registrasi
function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                 alert('Username sudah terdaftar! Silahkan buat user yang berbeda!');
              </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                 alert('Konfirmasi password tidak sesuai');
              </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);

}


?>
<?php
    //jalankan session
    session_start();

    //memanggil file functions untuk koneksi
    require '../functions/functions.php';

    //jika tombol register diklik
    if( isset($_POST["register"]) ) {
        if( registrasi($_POST) > 0 ) {
            echo "<script>
                    alert('User baru berhasil ditambahkan!');
                </script>";
        } else {
            echo mysqli_error($conn);
        }
    }

    //cek cookie
    if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        //ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username
        if($key === hash('sha256', $row['username']) ) {
            $_SESSION['login'] = true;
        }
    }

    //cek apakah user berhasil login atau belum
    if( isset($_SESSION["login"]) ) {
        header("Location: ../../index.php");
        exit;
    }

    //cek apakah tombol login sudah diklik atau belum
    if( isset($_POST["login"]) ) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        //cek username
        if( mysqli_num_rows($result) === 1 ) {
            //cek password
            $row =  mysqli_fetch_assoc($result);
            if( password_verify($password, $row["password"]) ) {
                //set session
                $_SESSION["login"] = true;
                
                // cek remember me
                if( isset($_POST['remember'])) {
                    //buat cookie
                    setcookie('id', $row['id'], time()+60);
                    setcookie('key', hash('sha256', $row['username']), time()+60);
                    
                }

                header("Location: ../../index.php");
                exit;
            }
        }

        echo "<script>
                alert('User tidak terdaftar! Silahkan daftar terlebih dahulu!');
            </script>";
        $error = true;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../../css/style_login.css" />
</head>
<body>
    <!-- Navbar Begin -->
    <div class="navbar">
        <h1>Beranda</h1>
        <div class="navbar-nav">
            <a href="">Belanjago Mall</a>
        </div>

    </div>
    <!-- Navbar End -->

    <!-- Content Begin  -->
    <div class="wrapper">
        <div class="row">
            <div class="col-1">
                <h1 class="judul">Jago jadi reseller, Maksimalkan untung!</h1>
                <p class="deskripsi">Jualan lewat online dengan menggunakan</p>
                <p class="deskripsi">Belanjago Seller Centre</p>
                <img src="../../asset/content.png" alt="e-commerce" class="e-commerce"/>
            </div>
            <div class="col-2">
                <!-- Form Begin -->
                <div class="form-container">
                    <div class="slide-controls">
                        <input type="radio" name="slide" id="login" checked>
                        <input type="radio" name="slide" id="signup">
                        <label for="login" class="slide login">Login</label>
                        <label for="signup" class="slide signup">Daftar</label>
                        <div class="slider-tab"></div>
                    </div>
                    <div class="form-inner">
                        <!-- Form Login -->
                        <form action="" method="post" class="login">
                            <pre></pre>
                            <div class="field">
                                <input type="text" name="username" id="username" placeholder="Masukkan Username" autofocus required autocomplete="off"/>              
                            </div>
                            <div class="field">
                                <input type="password" name="password" id="password" placeholder="Masukkan Password" required autocomplete="off"/>
                            </div>
                            <div class="Remember">
                                <input type="checkbox" name="remember" id="remember" />
                                <label for="remember">Remember me</label>
                            </div>
                            <div class="field btn">
                                <div class="btn-show">
                                    <button type="submit" name="login" class="btn-layer">Login</button>
                                    <p class="title">Login</p>
                                </div>
                            </div>
                            <div class="pass-link"><a href="#">Lupa password?</a></div>
                            <div class="signup-link"><span>Buat akun?</span> <a href="">Daftar sekarang</a></div>
                        </form>

                        <!-- Form Register -->
                        <form action="" method="post" class="signup">
                            <div class="field">
                                <input type="text" name="username" id="username" placeholder="Masukkan Username" autofocus required autocomplete="off"/>
                            </div>
                            <div class="field">
                                <input type="password" name="password" id="password" placeholder="Masukkan Password" required autocomplete="off"/>
                            </div>
                            <div class="field">
                                <input type="password" name="password2" id="password2" placeholder="Konfirmasi Password" required autocomplete="off"/>
                            </div>
                            <div class="field btn">
                                <div class="btn-show">
                                    <button type="submit" name="register" class="btn-layer">Register</button>
                                    <p class="title">Register</p>
                                </div>
                                
                            </div>
                            <div class="signup-link"><span>Sudah punya akun?</span> <a href="">Login</a></div>
                        </form>
                    </div>    
                </div>   
                <!-- Form End -->
            </div>
        </div>
    </div>
    <!-- Content End -->

    <!-- js toggle form -->
    <script src="../../js/form.js"></script>
</body>
</html>
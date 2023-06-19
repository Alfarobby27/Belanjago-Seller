<?php
//jalankan session
session_start();

//hilangkan session
$_SESSION = [];
session_unset();
session_destroy();

//menghapus cookie
setcookie('id', '', time()-3600);
setcookie('key', '', time()-3600);

header("Location: ../loginReg/login.php");
exit;

?>
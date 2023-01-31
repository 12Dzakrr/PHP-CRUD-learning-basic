<?php
session_start();

session_destroy();
session_unset(); //menghapus lbh bersih
setcookie('id','',time() - 3600);
setcookie('ussername','',time() - 3600); //menghapusnya panggil keys nya tapi value dikosongi dan timenya kasih -
    header("location: login.php");
    exit;

?>
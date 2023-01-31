<?php
session_start();

session_destroy();
session_unset(); //menghapus lbh bersih
    header("location: login.php");
    exit;

?>
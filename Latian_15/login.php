<?php
require "functions.php";

  if (isset($_POST["submit"])){

    $ussername_login = $_POST["ussername-login"];
    $password_login = $_POST["password-login"];

    // cek apakah ussername sama

    $DataUsername = mysqli_query($db,"SELECT * FROM users_tamu WHERE Email = '$ussername_login'");

    // Cek ussername
    $row2 = mysqli_fetch_assoc($DataUsername);

    if(mysqli_num_rows($DataUsername)){
      if(password_verify($password_login,$row2["Password"])){
        header("Location: index.php");
        echo "<script> 
                alert('yaay, Berhasil masuk')
             </script>";
        exit;
      } 
    } 
    $salah = true;

  }




?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="container-fluid">
            <form class="w-50 mt-5 mx-auto" action="" method="POST">
            <h3>Login</h3>
            <?php if(isset($salah)): ?>
              <p class="text-danger">Password atau ussername anda salah</p>
            <?php endif;?>
            <div class="mb-3">
                <label for="ussername" class="form-label">Email address</label>
                <input type="email" name="ussername-login" class="form-control" id="ussername" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password-login" id="password">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
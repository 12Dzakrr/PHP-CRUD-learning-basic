<?php
// kirim data
require "functions.php";

if(isset($_POST["submit"])){
    if (registrasi($_POST) > 0) {
      echo "<script> 
                alert('data anda berhasil ditambahkan')
             </script>";
      header("location: login.php");
      exit;
    } else{
      echo mysqli_error($db);
    }

}
  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rgistrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="container-fluid">
            <form class="w-50 mt-5 mx-auto" action="" method="POST">
              <h3>Sign up</h3>
            <div class="mb-3">
                <label for="ussername" class="form-label">Email address</label>
                <input type="email" name="ussername-signup" class="form-control" id="ussername" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password-signup" id="password">
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">konfirmasi Password</label>
                <input type="password2" class="form-control" name="password2-signup" id="pasword2">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="submit">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
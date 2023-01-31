<?php
require "functions.php";

$datatamuu = data_query("SELECT * FROM datatamu");

// jika tombol search diklik maka jalankan fungsi cari("sesuai input search user")
if( isset($_POST['search'])){
    $datatamuu = cari($_POST['keyword']);
} 


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tamu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    
  </head>
  <body>
    <div class="judul shadow-sm py-3  position-relative text-center">
            <h2 class="">DATA TAMU</h2>
            <p class="">Latian memuat data tamu dengan php dan database mysql</p>
    </div>

    <div class="container-flui">
        <div class="containe bg-light p-5">
        <div class="fitur d-flex ">
            <a href="tambah.php" class="text-decoration-none fw-bold text-light me-4 "><button class="btn btn-success fw-bold">Create data</button></a>
            <form class="d-flex w-25  ms-auto" method="POST">
                <input class="form-control me-2" type="text" placeholder="Search Data"  autocomplete="off" name="keyword">
                <button class="btn btn-outline-success" name="search">Search</button>
            </form>
        </div>
        <hr>
        <table class=" table-hover table-borderless table px-5 table-striped">
            <thead class="border-bottom fw-bold">
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Telephone</td>
                    <td>Asal</td>
                    <td>Kebutuhan</td>
                    <td>Profil</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody class="isi bg-light ">

                <?php $i = 1 ?>
                <?php foreach($datatamuu as $tamuu):?>
                <tr class="">
                    <td><?= $i?></td>
                    <td><?= $tamuu["Nama"]?></td>
                    <td><?= $tamuu["Telephone"]?></td>
                    <td><?= $tamuu["Asal"]?></td>
                    <td><?= $tamuu["Kebutuhan"]?></td>
                    <td><img src="img/<?= $tamuu["Profil"]?>" alt="" class="foto"></td>
                    <td><a class="btn btn-secondary dropdown-toggle btn-custom" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-danger fw-bold" href="hapus.php?id=<?= $tamuu["id"]?>" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">DELETE</a></li>
                            <li><a class="dropdown-item text-success fw-bold" href="ubah.php?id=<?= $tamuu["id"]?>">EDIT</a></li>
                        </ul>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach;?>
                
            </tbody>
        </table>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
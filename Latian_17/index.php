<?php
session_start();
require "functions.php";

if(!isset($_SESSION['login'])){
    header("location: login.php");
    exit;
}

// Membuat pagination
$jumlahDataPerPage = 3; //setiap pagination berisi 2 data
$jumlahData = count(data_query("SELECT * FROM datatamu")); //jumlah data dalam database datatamu
$TotalPagination = ceil($jumlahData / $jumlahDataPerPage);  //ada 6 data, dan 2 data dalam setiap page (otomatis ada 3 pagination)
//ceil membulatikan ke atas(1.2 dibulatkan ke 2(agar jika ada 3 data nantinya ada 2 pagination bukan 1.5 pagination))

//get buat url halaman
if(isset($_GET["halaman"])){
    $urlHalamanAktif = $_GET["halaman"];
} else{
    $urlHalamanAktif = 1;
}
//var_dump($urlHalamanAktif);

//menentukan a pada limit
  $indexAwalData = ($jumlahDataPerPage * $urlHalamanAktif) - $jumlahDataPerPage;


$datatamuu = data_query("SELECT * FROM datatamu LIMIT $indexAwalData,$jumlahDataPerPage");
//LIMIT a,b
//==limit untuk batas data yang ditampilkan 
//=(a untuk index ke berapa yang dimunculkan awal (jika 2 berarti dimulai dari index ke 2))
//=(b total data yang ditampilkan(jika 3 maka yang dimunculkan 3 data yakni data di index ke 2,3,4))

// jika tombol search diklik maka jalankan fungsi cari("sesuai input search user")
if( isset($_POST['search'])){
    $jumlahData = count(cari($_POST['keyword']));
    $datatamuu =  cari2($_POST['keyword'],$indexAwalData,$jumlahDataPerPage);
    $TotalPagination = ceil($jumlahData / $jumlahDataPerPage);

    //get buat url halaman
    if(isset($_GET["halaman"])){
        $urlHalamanAktif = $_GET["halaman"];
    } else{
        $urlHalamanAktif = 1;
    }

   

    $indexAwalData = ($jumlahDataPerPage * $urlHalamanAktif) - $jumlahDataPerPage;
} 
 var_dump($urlHalamanAktif);
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
            <a href="logout.php" class="text-decoration-none fw-bold text-light me-4 "><button class="btn btn-danger fw-bold">logout</button></a>
            <form class="d-flex w-25  ms-auto" method="POST">
                <input class="form-control me-2" type="text" placeholder="Search Data"  autocomplete="off" name="keyword">
                <button class="btn btn-outline-success" name="search"  >Search</button>
            </form>
        </div>
        <?php if(isset($_POST['search'])) : ?>
            <h4 class="mb-0 mt-3 text-center">Mencari data: <?= $_POST['keyword'];?></h4> 
            <a href="" class="mt-0 text-center d-block">clear</a>
        <?php endif; ?>
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
         <!-- Jika data yang dicari tidak  -->
        <?php if(isset($_POST['search'])) : ?>
            <?php if($jumlahData == 0) : ?>
                <div class="Tidak-ada w-100 m-auto text-center">
                    <img src="img/nothing.png" alt="" style="width: 20%; display:block; margin:auto;">
                    <h5 class="fw-bold m-0 p-0">Kata yang anda cari tidak ditemukan</h5>
                    <p class="m-0 p-0">Pastikan menulis dengan benar</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- back pagination -->
            <?php if($urlHalamanAktif > 1): ?>
                <li class="page-item display-none"><a class="page-link" href="?halaman=<?= $urlHalamanAktif - 1 ?>">Previous</a></li>
            <?php endif?>

            <!-- ANGKA PAGINATION -->
            <?php for($i = 1; $i <= $TotalPagination;$i++ ):  ?>
                <?php if($i == $urlHalamanAktif): ?>
                    <li class="page-item"><a class="page-link active" href="?halaman=<?= $i?>"><?php echo $i ?></a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i?>"><?php echo $i ?></a></li>
                <?php endif?>
            <?php endfor; ?>


            <?php if($urlHalamanAktif < $TotalPagination): ?>
                <li class="page-item display-none"><a class="page-link" href="?halaman=<?= $urlHalamanAktif + 1 ?>">Next</a></li>
            <?php endif?>
        </nav>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
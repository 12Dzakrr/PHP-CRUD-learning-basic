<?php
// req ke function

session_start();
require "functions.php";

if(!isset($_SESSION['login'])){
    header("location: login.php");
    exit;
}

// ambil semua data
// a) di url
$id = $_GET['id'];

// b) di querry (file function)
$tamu = data_query("SELECT * FROM datatamu WHERE id = $id")[0];
//ada 0 karena data_query berisi angka numerik baru didalam angka numerik ada isi data
// sama saja dengan $tamu[0]['Nama']

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <?php if (isset($_POST['submit'])):?>
        <?php if (ubah_data($_POST) > 0): ?>
            <div class="fill position-absolute top-50 start-50 translate-middle w-100 h-100" style="z-index: 99; background: rgba(25, 23, 23, 1);">
                <div class="kotak bg-light position-absolute top-50 start-50 translate-middle w-25 rounded-5 p-5 shadow-lg text-center" style="z-index: 100;">
                    <h5>Berhasil</h5>
                    <p>Data anda berhasil diubah</p>
                    <div class="button fw-bold">
                        <a href="index.php " class="fw-bold text-light text-decoration-none"><button class="btn btn-primary fw-bold">Kembali</button></a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="fill position-absolute top-50 start-50 translate-middle w-100 h-100" style="z-index: 99; background: rgba(25, 23, 23, 1);">
                <div class="kotak bg-light position-absolute top-50 start-50 translate-middle w-25 rounded-5 p-5 shadow-lg text-center" style="z-index: 100;">
                    <h5>Gagal</h5>
                    <p>Mohon Maaf!, Data anda gagal atau belum diubah</p>
                    <div class="button fw-bold">
                        <a href="index.php " class="fw-bold text-light text-decoration-none"><button class="btn btn-primary fw-bold">Kembali</button></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container-fluid bg-dark ">
        <div class="container position-absolute top-50 start-50 translate-middle w-50 bg-glass p-5 text-light rounded-5">
            <div class="form-isian">
            <div class="pembukaan text-center">
                <h2>Edit Data </h2>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $tamu['id'] ?>">
                <input type="hidden" name="Profil_old" value="<?= $tamu['Profil'] ?>">
                <div class="Nama">
                    <label for="Nama" class="form-label mt-1 mb-0">Nama Lengkap: </label>
                    <input type="text" name="Nama" class="form-control mt-0" id="Nama" placeholder="masukkan nama dengan benar" required value="<?= $tamu['Nama'] ?>">
                </div>
                <div class="Telp_Email row" >
                    <div class="Email col-6">
                        <label for="Email" class="form-label mt-1 mb-0">Email: </label>
                        <input type="Email" name="Email" id="Email" class="form-control mt-0"  placeholder="example @gmail.com" required value="<?= $tamu['Email'] ?>">
                    </div>
                    <div class="Telp col-6">
                        <label for="Telephone" class="form-label mt-1 mb-0">Nomor Telephone: </label>
                        <input type="number" name="Telephone" id="Telephone" class="form-control mt-0"  placeholder="081234567" required value="<?= $tamu['Telephone'] ?>">
                    </div>
                </div>
                <div class="Asal">
                    <label for="Asal" class="form-label mt-1 mb-0">Asal kota: </label>
                    <input type="text" name="Asal" id="Asal" class="form-control mt-0" placeholder="cth: Jakarta" required value="<?= $tamu['Asal'] ?>">
                </div>
                <div class="Kebutuhan">
                    <label for="Kebutuhan" class="form-label mt-1 mb-0">Kebutuhan: </label>
                    <input type="text" name="Kebutuhan" id="Kebutuhan" class="form-control mt-0"  placeholder="Cth: bekerja, bermain, membaca" required value="<?= $tamu['Kebutuhan'] ?>">
                </div>
                <div class="Profil">
                    <label for="formFile" class="form-label mt-1 mb-0">Profil: </label>
                    <br>
                    <img src="img/<?= $tamu['Profil']?>" alt="" style="width:10%; display:inline-block;" class="m-1">
                    <input class="form-control mt-0" type="file" id="formFile" name="Profil" >
                </div>
                <div class="d-grid gap-3 mt-4 ">
                    <button type="submit" name="submit" class="btn btn-primary fw-bold">Ubah Data</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
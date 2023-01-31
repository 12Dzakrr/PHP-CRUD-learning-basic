<?php
// req ke function

require 'functions.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php if (isset($_POST['submit'])):?>

        <!-- TEST FIELS DAN POST -->
        <?php //var_dump($_POST);
        //var_dump($_FILES);
        //die; ?>


        <?php if (tambah_data($_POST) > 0): ?>
            <div class="fill position-absolute top-50 start-50 translate-middle w-100 h-100" style="z-index: 99; background: rgba(39, 38, 38, 0.521);">
                <div class="kotak bg-light position-absolute top-50 start-50 translate-middle w-25 rounded-5 p-5 shadow-lg text-center" style="z-index: 100;">
                    <h5>Berhasil</h5>
                    <p>Data anda berhasil dibuat</p>
                    <div class="button fw-bold">
                        <a href="index.php " class="fw-bold text-light text-decoration-none"><button class="btn btn-danger fw-bold">Kembali</button></a>
                        <a href="index.php " class="fw-bold text-light text-decoration-none"><button class="btn btn-outline-success fw-bold">Tambah</button></a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="fill position-absolute top-50 start-50 translate-middle w-100 h-100" style="z-index: 99; background: rgba(39, 38, 38, 0.521);">
                <div class="kotak bg-light position-absolute top-50 start-50 translate-middle w-25 rounded-5 p-5 shadow-lg text-center" style="z-index: 100;">
                    <h5>Gagal</h5>
                    <p>Mohon Maaf!, Data anda Gagal</p>
                    <div class="button fw-bold">
                        <a href="index.php " class="fw-bold text-light text-decoration-none"><button class="btn btn-danger fw-bold">Kembali</button></a>
                        <a href="index.php " class="fw-bold text-light text-decoration-none"><button class="btn btn-outline-success fw-bold">Ulangi</button></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    
    <div class="container-fluid bg-dark ">
        <div class="container position-absolute top-50 start-50 translate-middle w-50 bg-glass p-5 text-light rounded-5">
            <div class="form-isian">
            <div class="pembukaan text-center">
                <h2>Create New Data</h2>
                <p>Membuat data tamu baru untuk latihan crud pada php dan mysql</p>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- enctype berguna agar nantinya type text masuk ke subglobal post dan type file masuk ke subglobal file -->
                <!-- jika tidak nanti filenya masuk ke post (tidak ada file, hanya nama filenya) -->
                <div class="Nama">
                    <label for="Nama" class="form-label mt-1 mb-0">Nama Lengkap: </label>
                    <input type="text" name="Nama" class="form-control mt-0" id="Nama" placeholder="masukkan nama dengan benar" required>
                </div>
                <div class="Telp_Email row" >
                    <div class="Email col-6">
                        <label for="Email" class="form-label mt-1 mb-0">Email: </label>
                        <input type="Email" name="Email" id="Email" class="form-control mt-0"  placeholder="example @gmail.com" required>
                    </div>
                    <div class="Telp col-6">
                        <label for="Telephone" class="form-label mt-1 mb-0">Nomor Telephone: </label>
                        <input type="number" name="Telephone" id="Telephone" class="form-control mt-0"  placeholder="081234567" required>
                    </div>
                </div>
                <div class="Asal">
                    <label for="Asal" class="form-label mt-1 mb-0">Asal kota: </label>
                    <input type="text" name="Asal" id="Asal" class="form-control mt-0" placeholder="cth: Jakarta" required>
                </div>
                <div class="Kebutuhan">
                    <label for="Kebutuhan" class="form-label mt-1 mb-0">Kebutuhan: </label>
                    <input type="text" name="Kebutuhan" id="Kebutuhan" class="form-control mt-0"  placeholder="Cth: bekerja, bermain, membaca" required>
                </div>
                <div class="Profil">
                    <label for="formFile" class="form-label mt-1 mb-0">Profil: </label>
                    <input class="form-control mt-0" type="file" id="formFile" name="Profil"  placeholder="example.jpg">
                </div>
                <div class="d-grid gap-3 mt-4 ">
                    <button type="submit" name="submit" class="btn btn-success fw-bold">Buat Data</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
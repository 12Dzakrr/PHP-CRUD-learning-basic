<?php

// konek mysql to php
$db = mysqli_connect("localhost", "root", "", "phpdatabase_dasar");

//1) ambil data 
function data_query($query){
    global $db;
    $result = mysqli_query($db, $query);
    $data_tamu = [];
    while ($data = mysqli_fetch_assoc($result)){
        $data_tamu[] = $data;
    };

    return $data_tamu;
}

// File Tambah

function tambah_data($data){
    global $db;

    // ambil data dari gfrom
    $Nama = htmlspecialchars($data['Nama']);
    $Telephone = htmlspecialchars($data['Telephone']);
    $Email = htmlspecialchars($data['Email']);
    $Asal = htmlspecialchars($data['Asal']);
    $Kebutuhan = htmlspecialchars($data['Kebutuhan']);
    
    // NEW: MEMBUAT UPLOAD

    $gambar = upload();

    if (!$gambar){
        return false;
        // jika file gambar terdapat eror, nantinya query insert data tidak akan dijalankan
    }

    // querry insert data
    $sql = "INSERT INTO datatamu 
                VALUES 
                    ('', '$Nama','$Email','$Telephone','$Asal','$Kebutuhan', '$gambar') 
            ";
    
    $query = mysqli_query($db,$sql);

    // cek data udah ditambah atau belum
    return mysqli_affected_rows($db);

}

// File Upload

function upload(){
    // mengapa ada profil karena bentuk array $_FILE[profil[name=>...,size=>...,error=>...]]
    $NamaGambar = $_FILES["Profil"]["name"];
    $UkuranFile = $_FILES["Profil"]["size"];
    $errorfile = $_FILES["Profil"]["error"];
    $penyimpananfile = $_FILES["Profil"]["tmp_name"];


    // CEK APAKAH FILE TIDAK DIUPLOAD (cara mengetauhi file tidak diupload jika errornya ada 4 (kalo yang ndak ada itu 0))
    if ($errorfile == 4){
        echo "
        <script>
        alert('File Profil Belum Ada isinya')
        </script>
        ";
        return false;
        // agar tidak dilanjutkan
    }

    //PILIAN FORMAT GAMBAR
    $format_pilihan = ['jpg','png','jpeg'];
    $pisah_format_gambar = explode('.',$NamaGambar); //jika ada namagambar fauzan.jpg nanti explode akan memisahkan array . menjadi 
    $pilih_format_gambar = strtolower(end($pisah_format_gambar)); //dipilih array yang terakhir(tidak memakai $..[1] karena jika ada file fauzan.dzakir.jpg nanti yang dipilih dzakir)
    
    if ( !in_array($pilih_format_gambar, $format_pilihan)){
        echo "
        <script>
        alert('Pastikan format berbentuk jpg, png dan jpeg')
        </script>
        ";
        return false;
    }
    // in_array konsepnya: ada ndak str data $pilih_format_gambar yang sama dengan salah satu str array  $format_pilihan
    // menghasilkan true jika ada , dan kebalikannya


    // BATASAN UKURAN
    if ($UkuranFile > 5242880){
        echo "
        <script>
        alert('Ukuran File Terlalu Besar! <br> pastikan ukuran gambar dibawah 5 mb')
        </script>
        ";

        
    }

    // lolos pengecekan, memindahkan tempat upload (dari default ke tempat yang diinginkan)
    $NamaGambarBaru = uniqid(); //nama file akan dibuat secara acak agar jika ada nama file yang sama tidak error
    $NamaGambarBaru .= '.';
    $NamaGambarBaru .= $pilih_format_gambar;


    move_uploaded_file($penyimpananfile,'img/'. $NamaGambarBaru);
    // m_u_f (var data yang dipindak, lokasi mindah dengan nama file nya)

    return $NamaGambarBaru; // agar nama gambar masuk ke database (code 32)

}


//2) Hapus data

function hapus_data($data){
    global $db;
    mysqli_query($db, "DELETE FROM datatamu WHERE id = $data");

    return mysqli_affected_rows($db);
};


//3) ubah data
function ubah_data($data){
    global $db;

    // ambil data dari gfrom
    $id = $data['id'];
    $Nama = htmlspecialchars($data['Nama']);
    $Telephone = htmlspecialchars($data['Telephone']);
    $Email = htmlspecialchars($data['Email']);
    $Asal = htmlspecialchars($data['Asal']);
    $Kebutuhan = htmlspecialchars($data['Kebutuhan']);
    $Profillama = htmlspecialchars($data['Profil_old']);

    //cek apakah user Update gambar
    if($_FILES["Profil"]["error"] == 4){
        $Profil = $Profillama;
    } else{
        $Profil = upload();
    }
    // querry insert data
    $sql = "UPDATE datatamu  SET
            Nama = '$Nama',
            Telephone = '$Telephone',
            Email = '$Email',
            Asal = '$Asal',
            Kebutuhan = '$Kebutuhan',
            Profil = '$Profil'
            WHERE id = '$id'
            ";
    
    $query = mysqli_query($db,$sql);

    // cek data udah ditambah atau belum
    return mysqli_affected_rows($db);
}

// 4) search

function cari($cari){
    // pilih semua datatamu dimana nama seperti input atau telephon seperti input ...
    $query_search = "SELECT * FROM datatamu WHERE 
    Nama LIKE '%$cari%' OR
    Telephone LIKE '%$cari%' OR
    Asal LIKE '%$cari%' OR
    Kebutuhan LIKE '%$cari%'
    ";
    // LIKE dan = bedanya ijia LIKE tidak harus sama plek tapi kalau = harus sama plek
    // % pada $cari% berguna kalau misalkan ada 4 data yang nama depan muhammad disini % berfungsi sebagai apapun data yang depannya nama muhammad
    //  kalau %$cari berguna contoh: jika user input fauzan, nantinya % bertujuan apapun nama fauzan tetapi depan terserah
    //  kalau dua duanya berati jika kita tulis a nanti semua yang ada a akan di tampilkan (data a tetapi data depan dan belakang boleh terserah)

    return Data_query($query_search);
    
};

// Registrasi

function registrasi($register){ //var dalam function registrasi akan diisi $_post pada registrasi
    global $db;

    //masukkan data ke database
    $ussername = strtolower(stripslashes($register["ussername-signup"]));
    $password = mysqli_real_escape_string($db,$register["password-signup"]);
    $password2 = mysqli_real_escape_string($db,$register["password2-signup"]);

    // konfirmasi username
    $cek_ussername = mysqli_query($db, "SELECT * FROM users_tamu WHERE Email = '$ussername'");

    if(mysqli_fetch_assoc($cek_ussername)){
        echo "<script>
        alert('ussername anda s terdaftar')
        </script>
        ";

        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2){
        echo "<script> 
                alert('konfirmasi password anda tidak sesuai')
             </script>
        ";
        return false;
    } 
    // enkripsi
    $password_enkripsi = password_hash($password,PASSWORD_DEFAULT);

    $password_tdkaman = md5($password);

    //var_dump($password_enkripsi);
    //var_dump($password_tdkaman);


    // tambahkan user ke dalam database
    mysqli_query($db, "INSERT INTO users_tamu VALUES('','$ussername','$password_enkripsi')");

    // return (angka 1 jika tada masuk, dan angka 0 jika data tidak masuk)
    return mysqli_affected_rows($db);

};















?>



<!-- Note -->
<!-- 
1) stripslashes = untuk membersihkan karakter tertentu seperti backslash
2) mysqli_real_escape_string()  = masukin password ada tanda kutip(dimasukkan secara database dengan aman)
 -->

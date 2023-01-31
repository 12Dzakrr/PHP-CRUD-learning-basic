<?php 
require 'functions.php';

$id = $_GET['id'];

if (hapus_data($id) > 0){
     echo "
     <script>
        document.location.href = 'index.php';
         alert('data berhasil dihapus');    
     </script>
     ";
        
} else {
     echo "
     <script>
         alert('data gagal untuk dihapus');
         document.location.href = 'index.php';
     </script>
     ";
}

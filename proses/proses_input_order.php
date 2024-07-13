<?php
include "connect.php";
session_start();
$kode_order = (isset ($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "" ;
$pelanggan = (isset ($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "" ;
$catatan = (isset ($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "" ;



if(!empty($_POST['input_order_validate'])){
    // Periksa apakah order sudah ada
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order='$kode_order'");
    if(mysqli_num_rows($select) > 0){
        $message = '<script>alert("Order yang ingin dimasukkan telah ada");
        window.location="../order"</script>';
    } else {
        // Masukkan data ke database
        $query = mysqli_query($conn, "INSERT INTO tb_order (id_order, pelanggan, catatan) VALUES ('$kode_order', '$pelanggan', '$catatan')");
        
        if(!$query){
            // Debug: menampilkan pesan kesalahan dari MySQL
            $error_message = mysqli_error($conn);
            $message = '<script>alert("Data gagal dimasukkan: ' . $error_message . '");
            window.location="../order"</script>';
        } else {
            $message = '<script>alert("Data berhasil dimasukkan");
            window.location="../?x=orderitem&order='.$kode_order.'&pelanggan='.$pelanggan.'"</script>';
        }
    }
    echo $message;
}
?>
?>
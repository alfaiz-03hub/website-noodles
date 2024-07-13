<?php
include "connect.php";
$id = (isset ($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kategori = (isset($_POST['kategori'])) ? htmlentities($_POST['kategori']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";

$kode_rand = rand(10000, 999999)."-" ;
$target_dir = "../assets/img/".$kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_menu_validate'])) {
    //cek gambar 
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = 'ini bukan file gambar';
        $statusupload = 0;
    } else {
        $statusupload = 1;
        if (file_exists($target_file)) {
            $message = "mohon maaf, file yang dimasukan sudah ada";
            $statusupload = 0;
        } else {
            if ($_FILES['foto']['size'] > 500000) {
                $message = "urukan file foto yang di upload terlalu besar";
                $statusupload = 0;
            } else {
                if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                    $message = "mohon maaf, format gambar yang di perbolehkan itu antara jpg,png,jpeg,gif";
                    $statusupload = 0;
                }
            }
        }
    }

    if ($statusupload == 0) {
        $message = '<script>alert("' . $message . ',gambar tidak berhasil di upload");
    window.location="../menu"</script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_menu WHERE nama_menu='$nama_menu'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("nama menu yang ingin di masukkan telah ada");
        window.location="../menu" </script>';
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, " UPDATE tb_menu SET foto='".$kode_rand . $_FILES['foto']['name'] . "', nama_menu='$nama_menu' , keterangan ='$keterangan ', kategori='$kategori', harga='$harga', stok='$stok' where id='$id' ");
                if ($query) {
                    $message = '<script>alert("data berhasil di masukkan");
                 window.location="../menu" </script>';
                } else {
                    $message = '<script>alert("data gagal di masukkan");
                 window.location="../menu" </script>';
                }
            } else {
                $message = '<script>alert("file gagal di upload");
                 window.location="../menu" </script>';
            }
        }
    }


}
echo $message;
?>
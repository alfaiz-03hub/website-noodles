<?php
include "connect.php";
$id = (isset ($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$foto = (isset ($_POST['foto'])) ? htmlentities($_POST['foto']) : "" ;


if(!empty($_POST['input_menu_validate'])){
    $query = mysqli_query($conn,"DELETE from tb_menu where id='$id'");
    if(!$query){
        unlink("../assets/img/$foto");
        $message = '<script>alert("data gagal di Delete");
       window.location="../menu" </script>';
    }else{
        $message = '<script>alert("data berhasil di Delete");
        window.location="../menu"</script>
        </script>';
    }
} echo $message;
?>
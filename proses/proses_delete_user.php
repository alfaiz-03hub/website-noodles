<?php
include "connect.php";
$id = (isset ($_POST['id'])) ? htmlentities($_POST['id']) : "" ;


if(!empty($_POST['input_user_validate'])){
    $query = mysqli_query($conn,"DELETE from tb_user where id='$id'");
    if(!$query){
        $message = '<script>alert("data gagal di Delete");
       window.location="../user" </script>';
    }else{
        $message = '<script>alert("data berhasil di Delete");
        window.location="../user"</script>
        </script>';
    }
} echo $message;
?>
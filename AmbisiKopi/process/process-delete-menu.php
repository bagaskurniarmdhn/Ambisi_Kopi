<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$photo = (isset($_POST['photo'])) ? htmlentities($_POST['photo']) : "";

if (!empty($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_menulist WHERE id = '$id'");
    if ($query) {
        unlink("../assets/img/$photo");
        $message = '<script>alert("Data Berhasil Diupdate");
                    window.location="../menu"
                    </script>';
    } else {
        $message = '<script>alert("Data Gagal Diupdate")
                    window.location="../menu"
                    </script>';
    }
}
echo $message;
?>
<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['name'])) ? htmlentities($_POST['name']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$notlpn = (isset($_POST['notlpn'])) ? htmlentities($_POST['notlpn']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";

if (!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang dimasukkan telah terdaftar");
                    window.location="../user"
                    </script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_user SET name='$name', username='$username', notlpn='$notlpn', level='$level' 
        WHERE id='$id'");
        if ($query) {
            $message = '<script>alert("Data Berhasil Diupdate");
                    window.location="../user"
                    </script>';
        } else {
            $message = '<script>alert("Data Gagal Diupdate")</script>';
        }
    }
}
echo $message;
?>
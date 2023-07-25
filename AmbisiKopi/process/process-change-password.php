<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$oldpassword = (isset($_POST['oldpassword'])) ? md5(htmlentities($_POST['oldpassword'])) : "";
$newpassword = (isset($_POST['newpassword'])) ? md5(htmlentities($_POST['newpassword'])) : "";
$repasswordnew = (isset($_POST['repasswordnew'])) ? md5(htmlentities($_POST['repasswordnew'])) : "";

if (!empty($_POST['change_password_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_ambisikopi]' && password = '$oldpassword'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        if ($newpassword == $repasswordnew) {
            $query = mysqli_query($conn, "UPDATE tb_user SET password='$newpassword' WHERE username = '$_SESSION[username_ambisikopi]'");
            if ($query) {
                $message = '<script>alert("Password Berhasil Diupdate");
                            window.history.back()
                            </script>';
            } else {
                $message = '<script>alert("Password Gagal Diupdate")
                            window.history.back()
                            </script>';
            }
        } else {
            $message = '<script>alert("Password tidak sama")
                        window.history.back()
                        </script>';
        }
    } else {
        $message = '<script>alert("Password lama tidak sesuai")
                    window.history.back()
                    </script>';
    }
} else {
    header('location:../home');
}
echo $message;
?>
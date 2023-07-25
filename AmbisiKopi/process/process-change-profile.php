<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['name'])) ? (htmlentities($_POST['name'])) : "";
$notlpn = (isset($_POST['notlpn'])) ? (htmlentities($_POST['notlpn'])) : "";

if (!empty($_POST['change_profile_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET name='$name', notlpn='$notlpn' WHERE username = '$_SESSION[username_ambisikopi]'");
    if ($query) {
        $message = '<script>alert("Profile Berhasil Diupdate");
                    window.history.back()
                    </script>';
    } else {
        $message = '<script>alert("Profile Gagal Diupdate")
                    window.history.back()
                    </script>';
    }
} else {
    $message = '<script>alert("Gagal Diupdate")
                window.history.back()
                </script>';
}
echo $message;
?>
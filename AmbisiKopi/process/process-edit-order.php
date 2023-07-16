<?php
include "connect.php";
session_start();
$kode_order = (isset($_POST['ordercode'])) ? htmlentities($_POST['ordercode']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$customer = (isset($_POST['customer'])) ? htmlentities($_POST['customer']) : "";
$note = (isset($_POST['note'])) ? htmlentities($_POST['note']) : "";

if (!empty($_POST['edit_order_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order='$kode_order' ");
    $query = mysqli_query($conn, "UPDATE tb_order SET meja='$meja',customer='$customer',note='$note'
        WHERE id_order = '$kode_order'");
    if ($query) {
        $message = '<script>alert("Data berhasil dimasukkan");
            window.location="../order"</script>';
    } else {
        $message = '<script>alert("Data gagal dimasukkan")
            window.location="../order"</script>';
    }
}
echo $message;
?>
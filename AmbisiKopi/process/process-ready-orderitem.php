<?php
include "connect.php";
session_start();
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$note = (isset($_POST['note'])) ? htmlentities($_POST['note']) : "";


if (!empty($_POST['ready_orderitem_validate'])) {
    $query = mysqli_query($conn, "UPDATE  tb_list_order SET note='$note', status=2 WHERE id_list_order='$id' ");
    if ($query) {
        $message = '<script>alert("Pesanan Siap Disajikan");
            window.location="../kitchen" </script>';
    } else {
        $message = '<script>alert("Pesanan Gagal Disajikan");
        window.location="../kitchen" </script>';
    }

}
echo $message;
?>
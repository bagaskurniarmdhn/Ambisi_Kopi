<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['ordercode'])) ? htmlentities($_POST['ordercode']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$customer = (isset($_POST['customer'])) ? htmlentities($_POST['customer']) : "";
$note = (isset($_POST['note'])) ? htmlentities($_POST['note']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";

if (!empty($_POST['edit_orderitem_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_list_order SET menu='$menu',total='$total',note='$note' 
    WHERE id_list_order='$id'");
    if ($query) {
        $message = '<script>alert("Data Berhasil Diupdate");
        window.location="../?x=orderitem&order='.$kode_order. '&meja='. $meja.'&customer='.$customer.'"</script>';
    } else {
        $message = '<script>alert("Data Gagal Diupdate")</script>';
    }
}
echo $message;
?>
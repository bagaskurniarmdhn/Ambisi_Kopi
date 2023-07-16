<?php
include "connect.php";
session_start();
$kode_order = (isset($_POST['ordercode'])) ? htmlentities($_POST['ordercode']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$customer = (isset($_POST['customer'])) ? htmlentities($_POST['customer']) : "";
$note = (isset($_POST['note'])) ? htmlentities($_POST['note']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";

if (!empty($_POST['input_orderitem_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu='$menu' && ordercode='$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Item yang dimasukkan telah ada");
                     window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&customer=' . $customer . '"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_list_order (menu,ordercode,total,note) 
        values ('$menu','$kode_order','$total','$note')");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan")
            window.location="../?x=orderitem&order='.$kode_order. '&meja='. $meja.'&customer='.$customer.'"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")</script>';
        }
    }
}
echo $message;
?>
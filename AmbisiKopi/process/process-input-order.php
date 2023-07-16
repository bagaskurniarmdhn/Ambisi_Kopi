<?php
include "connect.php";
session_start();
$kode_order = (isset($_POST['ordercode'])) ? htmlentities($_POST['ordercode']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$customer = (isset($_POST['customer'])) ? htmlentities($_POST['customer']) : "";

if (!empty($_POST['input_order_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order='$kode_order' ");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Pesanan ataupun yang dimasukkan telah ada");
            window.location="../order" </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_order (id_order,meja,customer,waiter) 
        values ('$kode_order','$meja','$customer','$_SESSION[id_ambisikopi]')");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan");
            window.location="../?x=orderitem&order='.$kode_order. '&meja='. $meja.'&customer='.$customer.'"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan")</script>';
        }
    }
}
echo $message;
?>
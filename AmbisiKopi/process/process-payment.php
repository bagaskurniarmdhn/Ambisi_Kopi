<?php
include "connect.php";
session_start();
$kode_order = (isset($_POST['ordercode'])) ? htmlentities($_POST['ordercode']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$customer = (isset($_POST['customer'])) ? htmlentities($_POST['customer']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$money = (isset($_POST['money'])) ? htmlentities($_POST['money']) : "";
$customer = (isset($_POST['customer'])) ? htmlentities($_POST['customer']) : "";
$kembalian = $money - $total;

if (!empty($_POST['payment_validate'])) {
    if ($kembalian < 0) {
        $message = '<script>alert("Nominal Uang Tidak Mencukupi")
            window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&customer=' . $customer . '"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_payment (id_payment,pay_amount,total_payment) 
            values ('$kode_order','$money','$total')");
        if ($query) {
            $message = '<script>alert("Pembayaran Berhasil")
                window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&customer=' . $customer . '"</script>';
        } else {
            $message = '<script>alert("Pembayaran Berhasil")</script>';
        }
    }
}
echo $message;
?>
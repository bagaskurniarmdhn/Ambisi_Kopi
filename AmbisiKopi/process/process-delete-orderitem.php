<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['ordercode'])) ? htmlentities($_POST['ordercode']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$customer = (isset($_POST['customer'])) ? htmlentities($_POST['customer']) : "";

if (!empty($_POST['delete_orderitem_validate'])) {
        $query = mysqli_query($conn, "DELETE FROM tb_list_order WHERE id_list_order = '$id'");
        if ($query) {
            $message = '<script>alert("Data Berhasil Dihapus");
            window.location="../?x=orderitem&order='.$kode_order. '&meja='. $meja.'&customer='.$customer.'"</script>';
        } else {
            $message = '<script>alert("Data Gagal Dihapus")
                    window.location="../order"
                    </script>';
        }
    }
echo $message;
?>
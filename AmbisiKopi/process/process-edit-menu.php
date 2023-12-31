<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$menu_name = (isset($_POST['menu_name'])) ? htmlentities($_POST['menu_name']) : "";
$information = (isset($_POST['information'])) ? htmlentities($_POST['information']) : "";
$menu_category = (isset($_POST['menu_category'])) ? htmlentities($_POST['menu_category']) : "";
$price = (isset($_POST['price'])) ? htmlentities($_POST['price']) : "";
$stock = (isset($_POST['stock'])) ? htmlentities($_POST['stock']) : "";

$kode_rand = rand(10000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES['photo']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['edit_menu_validate'])) {
    //cek apakah gambar or bkn
    $cek = getimagesize($_FILES['photo']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "File yang dimasukkan telah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['photo']['size'] > 500000) { //500kb
                $message = "foto yang diupload terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg") {
                    $message = "Maaf, hanya diperbolehkan gambar yang memiliki format JPG, JPEG, PNG";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', Gambar tidak dapat diuplad");
                                    window.location="../menu" </script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_menulist WHERE menu_name ='$menu_name' ");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("Nama menu yang dimasukkan telah ada");
                                                window.location="../menu" </script>';
        } else {

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, "UPDATE tb_menulist SET photo='" . $kode_rand . $_FILES['photo']['name'] . "', 
                                                            menu_name='$menu_name', information='$information', 
                                                            category='$menu_category', price='$price', stock='$stock' 
                                                            WHERE id='$id'");
                if ($query) {
                    $message = '<script>alert("Data berhasil dimasukkan");
                                                                    window.location="../menu" </script>';
                } else {
                    $message = '<script>alert("Data gagal dimasukkan");
                                                                        window.location="../menu" </script>';
                }
            } else {
                $message = '<script>alert("Maaf, terjadi kesalahan file tidak dapat diupload");
                                                                        </script>';
            }
        }

    }

}
echo $message;

?>
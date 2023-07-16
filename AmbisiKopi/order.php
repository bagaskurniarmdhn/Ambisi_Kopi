<?php
include "process/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.*,name, SUM(price*total) AS theprice FROM tb_order
LEFT JOIN tb_user ON tb_user.id = tb_order.waiter
LEFT JOIN tb_list_order ON tb_list_order.ordercode = tb_order.id_order
LEFT JOIN tb_menulist ON tb_menulist.id = tb_list_order.menu
LEFT JOIN tb_payment ON tb_payment.id_payment = tb_order.id_order
GROUP BY id_order");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

//$select_menu_category = mysqli_query($conn, "SELECT id_category,menu_category FROM tb_menu_category");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Order
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalNewMenu">Tambah
                        Pesanan</button>
                </div>
            </div>

            <!-- Modal New Order-->
            <div class="modal fade" id="ModalNewMenu" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan Makanan atau Minuman</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="process/process-input-order.php"
                                method="POST">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="upload" name="ordercode"
                                                value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                                            <label for="upload">Kode Pemesanan</label>
                                            <div class="invalid-feedback">Masukkan Kode Pemesanan</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Nomor Meja" name="meja" required>
                                            <label for="floatingInput">Meja</label>
                                            <div class="invalid-feedback">Masukkan Meja</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Nama Pelanggan" name="customer" required>
                                            <label for="floatingInput">Nama Pelanggan</label>
                                            <div class="invalid-feedback">Masukkan Nama Pelanggan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_order_validate"
                                        value="1234">Buat Pemesanan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal New Order-->

            <?php
            if (empty($result)) {
                echo "Data order makanan atau minuman tidak ada";
            } else {
                foreach ($result as $row) {
                    ?>

                    <!-- Modal Edit-->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="process/process-edit-order.php"
                                        method="POST">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="upload" name="ordercode"
                                                        value="<?php echo $row['id_order'] ?>" readonly>
                                                    <label for="upload">Kode Pemesanan</label>
                                                    <div class="invalid-feedback">Masukkan Kode Pemesanan</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput"
                                                        placeholder="Nomor Meja" name="meja" required
                                                        value="<?php echo $row['meja'] ?>">
                                                    <label for="floatingInput">Meja</label>
                                                    <div class="invalid-feedback">Masukkan Meja</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput"
                                                        placeholder="Nama Pelanggan" name="customer" required
                                                        value="<?php echo $row['customer'] ?>">
                                                    <label for="floatingInput">Nama Pelanggan</label>
                                                    <div class="invalid-feedback">Masukkan Nama Pelanggan</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_order_validate"
                                                value="1234">Edit Pemesanan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit-->

                    <!-- Modal Delete-->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="process/process-delete-order.php"
                                        method="POST">
                                        <input type="hidden" value="<?php echo $row['id_order'] ?>" name="ordercode">
                                        <div class="col-lg-12">
                                            Apakah anda ingin order atas nama <b>
                                                <?php echo $row['customer'] ?>
                                            </b> dengan kode order <b>
                                                <?php echo $row['id_order'] ?>
                                            </b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_order_validate"
                                                value="1234">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete-->

                    <?php
                }   
                ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Meja</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Pelayan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Waktu Order</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $no++ ?>
                                </th>
                                <td>
                                    <?php echo $row['id_order'] ?>
                                </td>
                                <td>
                                    <?php echo $row['customer'] ?>
                                </td>
                                <td>
                                    <?php echo $row['meja'] ?>
                                </td>
                                <td>
                                    <?php echo number_format((int) $row['theprice'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['status'] ?>
                                </td>
                                <td>
                                    <?php echo $row['order_time'] ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-info btn-sm me-1"
                                            href="./?x=orderitem&order=<?php
                                            echo $row['id_order'] . "&meja=" . $row['meja'] . "&customer=" . $row['customer'] ?>">
                                            <i class="bi bi-eye"></i></a>
                                        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                            data-bs-target="#ModalEdit<?php echo $row['id_order'] ?>"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#ModalDelete<?php echo $row['id_order'] ?>"><i
                                                class="bi bi-trash3"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
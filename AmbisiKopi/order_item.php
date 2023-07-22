<?php
include "process/connect.php";
$query = mysqli_query($conn, "SELECT *, SUM(price*total) AS theprice FROM tb_list_order
LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.ordercode
LEFT JOIN tb_menulist ON tb_menulist.id = tb_list_order.menu
LEFT JOIN tb_payment ON tb_payment.id_payment = tb_order.id_order
GROUP BY id_list_order
HAVING tb_list_order.ordercode = $_GET[order]");
$kode_order = $_GET['order'];
$meja = $_GET['meja'];
$customer = $_GET['customer'];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id,menu_name FROM tb_menulist");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Order Item
        </div>
        <div class="card-body">
            <a href="order" class="btn btn-primary mb-3"><i class="bi bi-arrow-left"></i> Back</a>
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="ordercode"
                            value="<?php echo $kode_order; ?>">
                        <label for="upload">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="meja" value="<?php echo $meja; ?>">
                        <label for="floatingInput">Meja</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="customer" value="<?php echo $customer; ?>">
                        <label for="floatingInput">Pelanggan</label>
                    </div>
                </div>
            </div>

            <!-- Modal Add New Item-->
            <div class="modal fade" id="additem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="process/process-input-orderitem.php"
                                method="POST">
                                <input type="hidden" name="ordercode" value="<?php echo $kode_order ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="customer" value="<?php echo $customer ?>">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="menu" id="">
                                                <option selected value="">Pilih Menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id]>$value[menu_name]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="menu">Menu Makanan/Minuman</label>
                                            <div class="invalid-feedback">Pilih Menu</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Jumlah Porsi" name="total" required>
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">Masukkan Jumlah Porsi</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingPassword"
                                                placeholder="Catatan" name="note">
                                            <label for="floatingPassword">Catatan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_orderitem_validate"
                                        value="1234">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Add New Item-->

            <?php
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
                foreach ($result as $row) {
                    ?>

                    <!-- Modal Edit-->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="process/process-edit-orderitem.php"
                                        method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="ordercode" value="<?php echo $kode_order ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="customer" value="<?php echo $customer ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="">
                                                        <option selected value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=$value[id]>$value[menu_name]</option>";
                                                            } else {
                                                                echo "<option value=$value[id]>$value[menu_name]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu Makanan/Minuman</label>
                                                    <div class="invalid-feedback">Pilih Menu</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput"
                                                        placeholder="Jumlah Porsi" name="total" required
                                                        value="<?php echo $row['total'] ?>">
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">Masukkan Jumlah Porsi</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingPassword"
                                                        placeholder="Catatan" name="note" value="<?php echo $row['note'] ?>">
                                                    <label for="floatingPassword">Catatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_orderitem_validate"
                                                value="1234">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit-->

                    <!-- Modal Delete-->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_list_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="process/process-delete-orderitem.php"
                                        method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="ordercode" value="<?php echo $kode_order ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="customer" value="<?php echo $customer ?>">
                                        <div class="col-lg-12">
                                            Apakah anda ingin menghapus menu <b>
                                                <?php echo $row['menu_name'] ?>
                                            </b> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_orderitem_validate"
                                                value="1234">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Delete-->

                    <?php
                }
                ?>

                <!-- Modal Pay Item-->
                <div class="modal fade" id="payitem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">Menu</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Catatan</th>
                                                <th scope="col">Total Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($result as $row) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['menu_name'] ?>
                                                </td>
                                                <td>
                                                    Rp.
                                                    <?php echo number_format($row['price'], 0, ',', '.') ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['total'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['status'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['note'] ?>
                                                </td>
                                                <td>
                                                    Rp.
                                                    <?php echo number_format($row['theprice'], 0, ',', '.') ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $total += $row['theprice'];
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="5" class="fw-bold">
                                                Total Harga
                                            </td>
                                            <td class="fw-bold">
                                                Rp.
                                                <?php echo number_format($total, 0, ',', '.') ?>
                                            </td>
                                    </tbody>
                                </table>
                            </div>
                            <span class="text-danger fs-5 fw-semibold">Lanjutkan Pembayaran?</span>
                            <form class="needs-validation" novalidate action="process/process-payment.php"
                                method="POST">
                                <input type="hidden" name="ordercode" value="<?php echo $kode_order ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="customer" value="<?php echo $customer ?>">
                                <input type="hidden" name="total" value="<?php echo $total ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="Jumlah Uang" name="money" required>
                                            <label for="floatingInput">Nominal Uang</label>
                                            <div class="invalid-feedback">Masukkan Nominal Uang</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="payment_validate"
                                        value="1234">Bayar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Pay Item-->

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">Menu</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Status</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Total Pembayaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['menu_name'] ?>
                                </td>
                                <td>
                                    Rp.
                                    <?php echo number_format($row['price'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?php echo $row['total'] ?>
                                </td>
                                <td>
                                    <?php echo $row['status'] ?>
                                </td>
                                <td>
                                    <?php echo $row['note'] ?>
                                </td>
                                <td>
                                    Rp.
                                    <?php echo number_format($row['theprice'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="<?php echo(!empty($row['id_payment'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-warning btn-sm me-1"; ?>" data-bs-toggle="modal"
                                            data-bs-target="#ModalEdit<?php echo $row['id_list_order'] ?>"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button class="<?php echo(!empty($row['id_payment'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-danger btn-sm me-1"; ?>" data-bs-toggle="modal"
                                            data-bs-target="#ModalDelete<?php echo $row['id_list_order'] ?>"><i
                                                class="bi bi-trash3"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $total += $row['theprice'];
                        }
                        ?>
                        <tr>
                            <td colspan="5" class="fw-bold">
                                Total Harga
                            </td>
                            <td class="fw-bold">
                                Rp.
                                <?php echo number_format($total, 0, ',', '.') ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
            }
            ?>
            <div>
                <button class="<?php echo(!empty($row['id_payment'])) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#additem"><i
                        class="bi bi-plus-circle"></i> Tambah Item</button>
                <button class="<?php echo(!empty($row['id_payment'])) ? "btn btn-secondary disabled" : "btn btn-primary"; ?>" data-bs-toggle="modal" data-bs-target="#payitem"><i
                        class="bi bi-cash-coin"></i> Bayar</button>
            </div>
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
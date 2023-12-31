<?php
include "process/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_list_order
LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.ordercode
LEFT JOIN tb_menulist ON tb_menulist.id = tb_list_order.menu
LEFT JOIN tb_payment ON tb_payment.id_payment = tb_order.id_order
ORDER BY order_time ASC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id,menu_name FROM tb_menulist");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Dapur
        </div>
        <div class="card-body">

            <?php
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
                foreach ($result as $row) {
                    ?>

                    <!-- Modal Accept-->
                    <div class="modal fade" id="ModalAcc<?php echo $row['id_list_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Pesanan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="process/process-acc-orderitem.php"
                                        method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" name="menu" id="">
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
                                                    <input disabled type="number" class="form-control" id="floatingInput"
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
                                            <button type="submit" class="btn btn-primary" name="acc_orderitem_validate"
                                                value="1234">Terima Pesanan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Accept-->

                    <!-- Modal Ready-->
                    <div class="modal fade" id="ModalReady<?php echo $row['id_list_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siap Disajikan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="process/process-ready-orderitem.php"
                                        method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" name="menu" id="">
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
                                                    <input disabled type="number" class="form-control" id="floatingInput"
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
                                            <button type="submit" class="btn btn-primary" name="ready_orderitem_validate"
                                                value="1234">Siap Disajikan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Ready-->

                    <?php
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $no++ ?>
                                </td>
                                <td>
                                    <?php echo $row['ordercode'] ?>
                                </td>
                                <td>
                                    <?php echo $row['order_time'] ?>
                                </td>
                                <td>
                                    <?php echo $row['menu_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['total'] ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['status'] == 1) {
                                        echo "<span class='badge text-bg-warning'>Masuk ke dapur</span> ";
                                    } elseif ($row['status'] == 2) {
                                        echo "<span class='badge text-bg-primary'>Siap disajikan</span> ";
                                    } 
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row['note'] ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button
                                            class="<?php echo (!empty($row['status'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-primary btn-sm me-1"; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalAcc<?php echo $row['id_list_order'] ?>">Terima</button>
                                        <button
                                            class="<?php echo (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-success btn-sm me-1"; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalReady<?php echo $row['id_list_order'] ?>">Siap
                                            Saji</button>
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
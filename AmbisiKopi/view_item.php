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
            View Item
        </div>
        <div class="card-body">
            <a href="report" class="btn btn-primary mb-3"><i class="bi bi-arrow-left"></i> Back</a>
            <div class="row">
            <div class="col-lg-3">
          <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" id="ordercode" value="<?php echo $kode_order ?>">
            <label for="floatingInput">Kode Order</label>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" id="meja" value="<?php echo $meja ?>">
            <label for="floatingInput">Meja </label>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" id="customer" value="<?php echo $customer ?>">
            <label for="floatingInput">Pelanggan </label>
          </div>
        </div>
      </div>

    
      <?php
      if (empty($result)) {
          echo "Data menu tidak ada";
      } else {
          foreach ($result as $row) {
              ?>
              <?php
          }

          ?>


          <div class="table-responsive">
            <table class="table table-hover" table>
              <thead>
                <tr class="text-nowrap">
                  <th scope="col">Menu</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Status</th>
                  <th scope="col">Catatan</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
            <?php

            $total = 0;
            foreach ($result as $row) {
                ?>

                    <tr>
                      <td><?php echo $row['menu_name'] ?></td>
                      <td><?php echo number_format($row['price'], 0, ',', '.') ?></td>
                      <td><?php echo $row['total'] ?></td>
                      <td><?php if ($row['status'] == 1) {
                          echo "<span class='badge text-bg-warning'>Masuk ke dapur</span> ";
                      } elseif ($row['status'] == 2) {
                          echo "<span class='badge text-bg-primary'>Siap disajikan</span> ";
                      }
                      ?></td>
                      <td><?php echo $row['note'] ?></td>
                      <td><?php echo number_format($row['theprice'], 0, ',', '.') ?></td>
                    </tr>
                    <?php
                    $total += $row['theprice'];
            } ?>
            <tr>
              <td colspan="5" class="fw-bold">
                Total Harga
              </td>
              <td class="fw-bold">
                <?php echo number_format($total, 0, ',', '.') ?>

                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>
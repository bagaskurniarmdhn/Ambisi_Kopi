<?php
include "process/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.*, tb_payment.*,name, SUM(price*total) AS theprice FROM tb_order
LEFT JOIN tb_user ON tb_user.id = tb_order.waiter
LEFT JOIN tb_list_order ON tb_list_order.ordercode = tb_order.id_order
LEFT JOIN tb_menulist ON tb_menulist.id = tb_list_order.menu
JOIN tb_payment ON tb_payment.id_payment = tb_order.id_order
GROUP BY id_order ORDER BY time_payment ASC");
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}

?>

<div class="col-lg-9 mt-2">
  <div class="card">
    <div class="card-header">
      Halaman Report
    </div>
    <div class="card-body">
      <div class="row">
       
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
                <th scope="col">No</th>
                <th scope="col">Kode Order</th>
                <th scope="col">Waktu Order</th>
                <th scope="col">Waktu Bayar</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Meja</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Pelayan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php

          $no = 1;
          foreach ($result as $row) {
              ?>

              <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo $row['id_order'] ?></td>
                <td><?php echo $row['order_time'] ?></td>
                <td><?php echo $row['time_payment'] ?></td>
                <td><?php echo $row['customer'] ?></td>
                <td><?php echo $row['meja'] ?></td>
                <td><?php echo number_format($row['theprice'], 0, ',', '.') ?></td>
                <td><?php echo $row['name'] ?></td>
                <td>
                  <div class="d-flex">
                    <a class="btn btn-info btn-sm me-1"
                      href="./?x=viewitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&customer=" . $row['customer'] ?>"><i
                        class="bi bi-eye"></i></a>
                       
                  </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
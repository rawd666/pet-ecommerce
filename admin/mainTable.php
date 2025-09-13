<?php
    require_once '../config.php';

    $q = "select o.orderId, o.orderTotal, o.timestamp, u.username
        from orders o left join users u 
        on u.userId = o.userId order by o.orderId desc";
    $result = mysqli_query($conn, $q);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Orders Summary</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Order-ID</th>
                        <th>Amount</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>User</th>
                        <th>Order-ID</th>
                        <th>Amount</th>
                        <th>Timestamp</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)){
                        $user = $row['username'];
                        $orderId = $row['orderId'];
                        $orderTotal = $row['orderTotal'];
                        $timestamp = $row['timestamp']; ?>
                            <tr>
                                <td><?= $user ?></td>
                                <td>#<?= $orderId ?></td>
                                <td>$<?= $orderTotal ?></td>
                                <td><?= $timestamp ?></td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
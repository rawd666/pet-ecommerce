<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
    header('Location: /waggy-1.0.0/login.php?error=Please+log+in');
    exit;
    }
?>

<?php
    require_once '../config.php';

    $q = "
        SELECT DATE(`timestamp`) AS day, 
                COALESCE(SUM(orderTotal),0) AS revenue
        FROM orders
            WHERE `timestamp` >= CURDATE() - INTERVAL 90 DAY
        GROUP BY DATE(`timestamp`)
        ORDER BY day ASC";
    $result = mysqli_query($conn, $q);

    $x = []; $y = []; $dates = [];
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $x[] = $i;
        $y[] = (float)$row['revenue'];
        $dates[] = $row['day'];
    }

    $n = count($y);
    if ($n < 2) {
        $avg = $n ? array_sum($y)/$n : 0.0;
        $forecasts = [];
        for ($k=1; $k<=14; $k++) {
            $date = date('Y-m-d', strtotime('+'.$k.' day'));
            $forecasts[] = ['date' => $date, 'forecast' => $avg];
        }
    } else {
        
        $sumx = array_sum($x);
        $sumy = array_sum($y);
        $sumxx = 0.0; $sumxy = 0.0;
        for ($j=0; $j<$n; $j++) {
            $sumxx += $x[$j]*$x[$j];
            $sumxy += $x[$j]*$y[$j];
        }
        $den = $n*$sumxx - $sumx*$sumx;
        if ($den == 0) {
            $avg = $sumy / $n;
            $a = $avg; $b = 0.0;
        } else {
            $b = ($n*$sumxy - $sumx*$sumy) / $den;
            $a = ($sumy - $b*$sumx) / $n;
        }

        $forecasts = [];
        for ($k=1; $k<=14; $k++) {
            $futureX = $n + $k;
            $pred = $a + $b*$futureX;
            if ($pred < 0) $pred = 0; 
            $date = date('Y-m-d', strtotime('+'.$k.' day'));
            $forecasts[] = ['date' => $date, 'forecast' => $pred];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Waggy - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sales Forecast</h1>
                        <button onclick="window.print()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <section id='report'>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Sales Forecast</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Revenue</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Revenue</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($forecasts as $f){
                                                $date = $f['date'];
                                                $revenue = $f['forecast']; ?>
                                                    <tr>
                                                        <td><?= $date ?></td>
                                                        <td>$<?= $revenue ?></td>
                                                    </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    </section>

            </div>
            <!-- End of Main Content -->

            <?php include 'footer.php'; ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include 'logoutModal.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>
    <style>
        @media print {
        body * { visibility: hidden !important; }
        #report, #report * { visibility: visible !important; }
        #report {
            position: absolute; 
            left: 0; top: 0; width: 100%;
        }

        @page { margin: 12mm; }
        thead { display: table-header-group; }
        tfoot { display: table-footer-group; }
        }
    </style>
</html>
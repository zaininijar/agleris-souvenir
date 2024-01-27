<?php require_once 'layouts/header.php' ?>
<?php require_once 'utils/format.php' ?>
<?php

$sql_transaction_count_by_status = "SELECT COUNT(transactions.id) AS transaction_count, transactions.status AS transaction_status FROM transactions GROUP BY transactions.status";
$result_transaction_count_by_status = $conn->query($sql_transaction_count_by_status)->fetch_all();

$sql_report = "SELECT
                  SUM(transactions.price_total) AS purchase_count,
                  COUNT(transactions.id) AS transaction_count
                  FROM transactions
                  WHERE transactions.status = 2";

$sql_report_transaction_rejected = "SELECT
                  COUNT(transactions.id) AS transaction_rejected_count
                  FROM transactions
                  WHERE transactions.status = 1";

$sql_customer_report = "SELECT
                        COUNT(users.id) AS customer_count
                        FROM users";

$sql_souvenir_report = "SELECT
                        COUNT(souvenirs.id) AS souvenir_count
                        FROM souvenirs";

$sql = "SELECT transactions.*,
        souvenirs.name, 
        souvenirs.description, 
        souvenirs.picture_path 
        FROM transactions JOIN souvenirs 
        ON transactions.souvenir_id = souvenirs.id 
        WHERE transactions.status != 3 
        ORDER BY transactions.created_at DESC LIMIT 10";

$result = $conn->query($sql);
$result_report = $conn->query($sql_report);
$result_customer_report = $conn->query($sql_customer_report);
$result_souvenir_report = $conn->query($sql_souvenir_report);
$result_report_transaction_rejected = $conn->query($sql_report_transaction_rejected);

$report = $result_report->fetch_assoc();
$customer_report = $result_customer_report->fetch_assoc();
$souvenir_report = $result_souvenir_report->fetch_assoc();
$report_transaction_rejected = $result_report_transaction_rejected->fetch_assoc();

$purchase_count = $report['purchase_count'];
$transaction_count = $report['transaction_count'];
$customer_count = $customer_report['customer_count'];
$souvenir_count = $souvenir_report['souvenir_count'];
$transaction_rejected_count = $report_transaction_rejected['transaction_rejected_count'];

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Welcome back,</h2>
                        <p class="mb-md-0">Your analytics dashboard
                            <strong class="text-primary">agleris souvenir</strong>.
                        </p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analytics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                                role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transaksi-tab" data-bs-toggle="tab" href="#transaksi" role="tab"
                                aria-controls="transaksi" aria-selected="true">Detail Transaksi</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account-multiple me-3 icon-lg text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Customer</small>
                                        <h5 class="me-2 mb-0"><?= $customer_count ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-table me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Product</small>
                                        <h5 class="me-2 mb-0"><?= $souvenir_count ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-chair-school me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Transaksi Berhasil</small>
                                        <h5 class="me-2 mb-0"><?= $transaction_count ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Transaksi di tolak</small>
                                        <h5 class="me-2 mb-0"><?= $transaction_rejected_count ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-chair-school me-3 icon-lg text-secondary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">

                                            <?= $result_transaction_count_by_status[0][1] ?>
                                        </small>
                                        <h5 class="me-2 mb-0"><?= $result_transaction_count_by_status[0][0] ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-chair-school me-3 icon-lg text-info"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">

                                            <?= $result_transaction_count_by_status[4][1] ?>
                                        </small>
                                        <h5 class="me-2 mb-0"><?= $result_transaction_count_by_status[4][0] ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-chair-school me-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">
                                            <?= $result_transaction_count_by_status[3][1] ?>
                                        </small>
                                        <h5 class="me-2 mb-0"><?= $result_transaction_count_by_status[3][0] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Total sales</p>
                    <h1><?= idr_format($purchase_count) ?></h1>
                    <h4>Gross sales over all</h4>
                    <p class="text-muted">Today, many people rely on computers to do homework, work, and
                        create or store useful information. Therefore, it is important </p>
                    <div id="total-sales-chart-legend"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Recent Purchases</p>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Purchase At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0) : ?>
                                <?php $no = 1; ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td style="white-space: nowrap;"><?= $row['name'] ?></td>
                                    <td><?= $row['unit'] ?></td>
                                    <td><?= idr_format($row['price_total']) ?></td>
                                    </td>
                                    <td><?= time_sice($row['created_at']) ?></td>
                                </tr>
                                <?php $no++; ?>

                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'layouts/footer.php' ?>
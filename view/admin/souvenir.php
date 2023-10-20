<?php require_once 'layouts/header.php' ?>
<?php

$sql = "SELECT * FROM souvenirs";
$result = $conn->query($sql);

?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Souvenir</h2>
                        <p class="mb-md-0">List product souvenir</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Souvenir</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                        <i class="mdi mdi-clock-outline text-muted"></i>
                    </button>
                    <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                        <i class="mdi mdi-plus text-muted"></i>
                    </button>
                    <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Recent Purchases</p>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Picture</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0) : ?>
                                    <?php $no = 1; ?>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><?= $row['unit'] ?></td>
                                            <td>Rp<?= $row['price'] ?></td>
                                            <td><img src="<?= $base_url . 'images/souvenir/' . $row['picture_path'] ?>" alt="">
                                            </td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><?= $row['updated_at'] ?></td>
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
<?php $conn->close(); ?>

<?php require_once 'layouts/footer.php' ?>
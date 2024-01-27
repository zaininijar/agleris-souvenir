<?php require_once 'view/admin/layouts/header.php' ?>
<?php require_once 'utils/format.php' ?>
<?php

$sql = "SELECT transactions.*, 
        souvenirs.name, 
        souvenirs.description, 
        souvenirs.picture_path 
        FROM transactions JOIN souvenirs 
        ON transactions.souvenir_id = souvenirs.id 
        WHERE transactions.status != 3 
        ORDER BY transactions.created_at DESC";

$result = $conn->query($sql);

?>

<div class="content-wrapper">
    <input type="hidden" id="baseUrl" value="<?= $base_url; ?>">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Transaction</h2>
                        <p class="mb-md-0">List Product Transaction</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Transaction</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                        <i class="mdi mdi-clock-outline text-muted"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="hasil"></div>
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Recent Purchases</p>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Act</th>
                                    <th>Nama</th>
                                    <th style="max-width: 20%;">Deskripsi</th>
                                    <th>Unit</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Picture</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0) : ?>
                                <?php $no = 1; ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr id="<?= 'delete-' . $row['id']; ?>">
                                    <td><?= $no; ?></td>
                                    <td>
                                        <summary>
                                            <details class="d-flex flex-column">
                                                <span style="font-size: 10px; margin: 20px 0px 5px 0px;">Update
                                                    Status</span>
                                                <span
                                                    onclick="confirmUpdate('you sure to PROCESS <?= $row['name']; ?>?', <?= $row['id']; ?>, 'PROCESS')"
                                                    type="button" class="badge badge-outline-info"
                                                    style="border-radius: 8px; margin-top: 5px; text-decoration: none;">PROCESS</span>
                                                <span
                                                    onclick="confirmUpdate('you sure to SHIPPING <?= $row['name']; ?>?', <?= $row['id']; ?>, 'SHIPPING')"
                                                    type="button" class="badge badge-outline-info"
                                                    style="border-radius: 8px; margin-top: 5px; text-decoration: none;">SHIPPING</span>
                                                <span
                                                    onclick="confirmUpdate('you sure to SUCCESS <?= $row['name']; ?>?', <?= $row['id']; ?>, 'SUCCESS')"
                                                    type="button" class="badge badge-outline-info"
                                                    style="border-radius: 8px; margin-top: 5px; text-decoration: none;">SUCCESS</span>
                                                <span
                                                    onclick="confirmUpdate('you sure to REJECT <?= $row['name']; ?>?', <?= $row['id']; ?>, 'REJECT')"
                                                    type="button" class="badge badge-outline-info"
                                                    style="border-radius: 8px; margin-top: 5px; text-decoration: none;">REJECT</span>

                                                <span style="font-size: 10px; margin: 20px 0px 5px 0px;">Other</span>
                                                <span
                                                    onclick="confirmDelete('you sure delete <?= $row['name']; ?>?', <?= $row['id']; ?>)"
                                                    type="button" class="badge badge-outline-danger"
                                                    style="border-radius: 8px; margin-top: 5px; text-decoration: none;">Delete</span>
                                            </details>
                                        </summary>
                                    </td>
                                    <td><?= $row['name'] ?></td>
                                    <td>
                                        <summary>
                                            <details style="white-space: pre-wrap;">
                                                <?= $row['description'] ?>
                                            </details>
                                        </summary>
                                    </td>
                                    <td><?= $row['unit'] ?></td>
                                    <td><?= idr_format($row['price_total']) ?></td>
                                    <td id="<?= $row['id'] ?>">
                                        <?php switch ($row['status']) {
                                            case 'SUCCESS':
                                                echo "<span class='badge bg-primary'style='border-radius: 8px;'>" . $row['status'] . "</span>";
                                                break;
                                            case 'PROCESS':
                                                echo "<span class='badge bg-warning'style='border-radius: 8px;'>" . $row['status'] . "</span>";
                                                break;
                                            case 'SHIPPING':
                                                echo "<span class='badge bg-info'style='border-radius: 8px;'>" . $row['status'] . "</span>";
                                                break;

                                            default:
                                                echo "<span class='badge bg-dark'style='border-radius: 8px;'>" . $row['status'] . "</span>";
                                                break;
                                        } ?>
                                    </td>
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


<script>
const baseUrl = document.getElementById('baseUrl').value

function confirmUpdate(mess, id, status) {
    const isConfirm = confirm(mess)
    const parent = $(`#${id}`)
    if (isConfirm) {
        $.ajax({
            url: `${baseUrl}admin/transaction/update`,
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                console.log(response);
                var message = "";
                switch (status) {
                    case 'SUCCESS':
                        message = "<span id=" + id +
                            " class='badge bg-primary'style='border-radius: 8px;'>" + status + "</span>"
                        break;
                    case 'PROCESS':
                        message = "<span id=" + id +
                            " class='badge bg-warning'style='border-radius: 8px;'>" + status + "</span>"
                        break;
                    case 'SHIPPING':
                        message = "<span id=" + id + " class='badge bg-info'style='border-radius: 8px;'>" +
                            status + "</span>"
                        break;

                    default:
                        message = "<span id=" + id + " class='badge bg-dark'style='border-radius: 8px;'>" +
                            status + "</span>"
                        break;
                }

                parent.html(message)
                $('#hasil').html(`<div class="alert alert-primary" role="alert">${response}</div>`)
            },
            error: (error) => {
                console.log(error);
                $('#hasil').html(`<div class="alert alert-danger" role="alert">${error.responseText}</div>`)
            }
        });
    }

}

function confirmDelete(mess, id) {
    const isConfirm = confirm(mess)
    const parent = $(`#delete-${id}`)
    if (isConfirm) {
        $.ajax({
            url: `${baseUrl}admin/transaction/delete`,
            type: 'POST',
            data: {
                id: id,
            },
            success: function(response) {
                console.log(response);
                parent.hide()
                $('#hasil').html(`<div class="alert alert-primary" role="alert">${response}</div>`)
            },
            error: (error) => {
                console.log(error);
                $('#hasil').html(`<div class="alert alert-danger" role="alert">${error.responseText}</div>`)
            }
        });
    }

}
</script>

<?php $conn->close(); ?>

<?php require_once 'view/admin/layouts/footer.php' ?>
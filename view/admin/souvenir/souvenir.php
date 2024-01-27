<?php

$sql = "SELECT * FROM souvenirs ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<div class="content-wrapper">
    <input type="hidden" id="baseUrl" value="<?= $base_url; ?>">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Souvenir</h2>
                        <p class="mb-md-0">List Souvenir</p>
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
                    <a href="<?= $base_url ?>admin/souvenir/add"
                        class="btn btn-primary mt-2 mt-xl-0 d-flex justify-content-between align-items-center">
                        <i class="mdi mdi-plus" style="font-size: 10px; padding-right: 10px;"></i>
                        <span>Add Souvenir</span>
                    </a>
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
                                <tr id="<?= $row['id']; ?>">
                                    <td><?= $no; ?></td>
                                    <td>
                                        <summary>
                                            <details class="d-flex flex-column">
                                                <a class="badge badge-outline-info"
                                                    style="border-radius: 8px; margin-top: 5px; text-decoration: none;"
                                                    href="<?= $base_url ?>admin/souvenir/edit/<?= $row['id'] ?>">Edit</a>
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
                                    <td><?= idr_format($row['price']) ?></td>
                                    <td>
                                        <img src="<?= $base_url . 'images/souvenir/' . $row['picture_path'] ?>" alt="">
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

function confirmDelete(mess, id) {
    const isConfirm = confirm(mess)
    const parent = $(`#${id}`)
    if (isConfirm) {
        $.ajax({
            url: `${baseUrl}admin/souvenir/delete`,
            type: 'POST',
            data: {
                id: id
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
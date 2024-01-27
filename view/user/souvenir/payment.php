<?php
require_once 'utils/format.php';

$sql = "SELECT transactions.*, souvenirs.name, souvenirs.description, souvenirs.picture_path FROM transactions JOIN souvenirs ON transactions.souvenir_id = souvenirs.id WHERE transactions.id = $id";
$result = $conn->query($sql);

?>

<link rel="stylesheet" href="<?= $base_url ?>view/user/assets/css/souvenir-detail.css">

<?php if ($result->num_rows > 0) : ?>
<?php $data = $result->fetch_assoc() ?>
<div class="card-detail">
    <div class="image-card-wrapper">
        <img src="<?= $base_url ?>/images/souvenir/<?= $data['picture_path']?>" alt="" />
    </div>
    <div class="card-detail-body">
        <div class="title-container">
            <h1 class="card-detail-title">
                <span
                    style="background-color: var(--color-success-500); color: white; padding: 0px 10px; border-radius: 4px;"><?= $data['unit'] ?>
                    Unit</span>
                <?= $data['name']?>
            </h1>
            <p class="card-detail-text">
                <?= $data['description']?>
            </p>
        </div>
        <div class="rekening">
            <table style="width: 100%;">
                <tr>
                    <td>BRI</td>
                    <td>: 757998116929536</td>
                    <td> A.N - AGLERIS SOUVENIR </td>
                </tr>
                <tr>
                    <td>BNI</td>
                    <td>
                        : 2625289272164352
                    </td>
                    <td> A.N - AGLERIS SOUVENIR </td>
                </tr>
                <tr>
                    <td>BCA</td>
                    <td>
                        : 6327450703233024
                    </td>
                    <td> A.N - AGLERIS SOUVENIR </td>
                </tr>
                <tr>
                    <td>Mandiri</td>
                    <td>
                        : 462241134333132
                    </td>
                    <td> A.N - AGLERIS SOUVENIR </td>
                </tr>
                <tr>
                    <td>Dana</td>
                    <td>
                        : 082286947001
                    </td>
                    <td> A.N - AGLERIS SOUVENIR </td>
                </tr>
                <tr>
                    <td>Ovo</td>
                    <td>
                        : 082286947001
                    </td>
                    <td> A.N - AGLERIS SOUVENIR </td>
                </tr>
                <tr>
                    <td>Gopay</td>
                    <td>
                        : 082286947001
                    </td>
                    <td> A.N - AGLERIS SOUVENIR </td>
                </tr>
            </table>
        </div>
        <div class="unit-container">
            <div class="input-unit" style="margin-bottom: 10px;">
                <i style="font-size: 12px;">
                    Note : Setelah melakukan transaksi pembayaran ke nomor rekening di atas, mohon segera langsung
                    chat
                    admin dengan mengirimkan screenshoot bukti pembayaran.
                </i>
            </div>
            <div class="amout-unit">
                <div class="button">
                    <a href="wa.me" class="btn btn-primary">Chat Admin Sekarang</a>
                </div>
                <h3 class="card-detail-title">
                    Total tagihan : <?= idr_format($data['price_total']) ?>
                </h3>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
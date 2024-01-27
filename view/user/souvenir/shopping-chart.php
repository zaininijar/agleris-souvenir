<?php
require_once 'utils/format.php';

$sql = "SELECT transactions.*, souvenirs.name, souvenirs.description, souvenirs.picture_path FROM transactions JOIN souvenirs ON transactions.souvenir_id = souvenirs.id WHERE transactions.user_id = " . $_SESSION['auth']['id'] . " AND transactions.status = 3 ORDER BY transactions.created_at DESC";
$result = $conn->query($sql);

?>

<?php

if (isset($_POST['checkout'])) {

    $sql_checkout = "UPDATE transactions SET status = 5 WHERE id = " . $_POST['id'];
    $result_checkout = $conn->query($sql_checkout);

    if ($conn->affected_rows > 0) {
        echo "<script>alert('Berhasil Checkout')</script>";
        echo '<meta http-equiv="refresh" content="2">';
        $_SESSION['is_transaction_buy_now'] = true;

    } else {
        echo "<script>alert('Gagal Checkout')</script>";
    }

}

?>


<link rel="stylesheet" href="<?= $base_url ?>view/user/assets/css/souvenir-detail.css">

<style>
.card-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.card-detail {
    margin-top: 0px;
}

.card-detail .image-card-wrapper {
    height: 300px;
}

.badge {
    padding: 3px 5px;
    color: aliceblue;
    font-size: 12px;
    border-radius: 4px;
}

.badge.badge-success {
    background-color: green;
}

.badge.badge-danger {
    background-color: red;
}
</style>

<?php if ($result->num_rows > 0) : ?>
<div class="card-container">

    <?php if(isset($_SESSION['is_transaction_buy_now'])): ?>

    <?php if($_SESSION['is_transaction_buy_now']): ?>
    <div class="alert alert-success buy">
        <div>Behasil melakukan pemesanan, silahkan cek detail pembayaran</div> <a
            href="<?= $base_url . 'souvenir/payment/' . $transaction_id ?>">Bayar
            Sekarang</a>
    </div>
    <?php else: ?>
    <div class="alert alert-success buy">
        <div>GAGAL melakukan pemesanan, silahkan cek detail pembayaran</div> <a
            href="<?= $base_url . 'souvenir/payment/' . $transaction_id ?>">Bayar
            Sekarang</a>
    </div>
    <?php endif; ?>
    <?php unset($_SESSION['is_transaction_buy_now']); ?>
    <?php endif; ?>
    <?php while($data = $result->fetch_assoc()): ?>
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
            <div>
                STATUS :
                <span><?php print($data['status'] == 'REJECT') ? '<span class="badge badge-danger">' . $data['status'] . '</span>' : '<span class="badge badge-success">' . $data['status'] . '</span>'; ?></span>
            </div>
            <div>
                di buat
                <span><?= time_sice($data['created_at']) ?></span>
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
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                            <button name="checkout" type="submit" class="btn btn-primary">Checkout Sekarang</button>
                        </form>
                    </div>
                    <h3 class="card-detail-title">
                        Total tagihan : <?= idr_format($data['price_total']) ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>
<?php endif; ?>
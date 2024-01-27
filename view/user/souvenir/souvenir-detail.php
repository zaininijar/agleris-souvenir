<?php
require_once 'utils/format.php';

$sql = "SELECT * FROM souvenirs WHERE id = $id";
$result = $conn->query($sql);

$transaction_id = mt_rand(00000000, 99999999);

if (isset($_POST['add_to_chart'])) {

    $transations_result = transations(3, $id);

    if ($transations_result !== false) {
        $new_chart_count = $chart_count + $_POST['unit'];
        $_SESSION['is_transaction_add_to_chart'] = true;
    } else {
        $_SESSION['is_transaction_add_to_chart'] = false;
    }
}

if (isset($_POST['buy_now'])) {

    $transations_result_buy_now = transations(5, $id);

    if ($transations_result_buy_now !== false) {
        $unit_now = $_POST['unit_old'] - $_POST['unit'];
        $sql_c = "UPDATE souvenirs SET unit = $unit_now WHERE id = $id";
        $result_c = $conn->query($sql_c);
        $_SESSION['is_transaction_buy_now'] = true;
    } else {
        $_SESSION['is_transaction_buy_now'] = false;
    }

}

function transations($status, $id)
{
    global $conn, $transaction_id;
    $souvenir_id = $id;
    $user_id = $_SESSION['auth']['id'];
    $unit = $_POST['unit'];
    $price_total = $_POST['price_total'];

    $sql_c = "INSERT INTO transactions (id, souvenir_id, user_id, unit, price_total, status) VALUES ($transaction_id, '$souvenir_id', '$user_id', '$unit', '$price_total', '$status')";
    $result_c = $conn->query($sql_c);

    return $result_c;
}

?>

<link rel="stylesheet" href="<?= $base_url ?>view/user/assets/css/souvenir-detail.css">

<section>
    <?php if ($result->num_rows > 0) : ?>
    <?php $data = $result->fetch_assoc() ?>

    <div class="card-detail">
        <div class="image-card-wrapper">
            <img src="<?= $base_url ?>/images/souvenir/<?= $data['picture_path']?>" alt="" />
        </div>
        <div class="card-detail-body">
            <div class="title-container">
                <h1 class="card-detail-title">
                    <?= $data['name']?>
                </h1>
                <h3 class="card-detail-title">
                    <?= idr_format($data['price']) ?>
                    <input id="price" type="hidden" value="<?= $data['price'] ?>">
                </h3>
                <p class="card-detail-text">
                    <?= $data['description']?>
                </p>
            </div>
            <form action="<?= $base_url . 'souvenir/detail/' . $id ?>" method="post">
                <div class="unit-container">
                    <div class="input-unit">
                        <input oninvalid="this.setCustomValidity('Stok kosong ya kk...')" class="input-unit"
                            id="input-unit" type="number" name="unit" value="1" min="1"
                            max="<?php print(isset($unit_now)) ? $unit_now : $data['unit']; ?>">
                        <strong>Unit total <?php print(isset($unit_now)) ? $unit_now : $data['unit']; ?></strong>
                        <input type="hidden" value="<?php print(isset($unit_now)) ? $unit_now : $data['unit']; ?>"
                            name="unit_old">
                    </div>
                    <div class="amout-unit">
                        <div class="button">
                            <button type="submit" name="add_to_chart" class="btn btn-primary">Add
                                to
                                chart</button>
                            <button type="submit" name="buy_now" class="btn btn-outline-primary">Buy Now</button>
                        </div>
                        <div class="price-total">
                            Total Harga : <h2 id="price-total-text"></h2>
                            <input id="price-total" name="price_total" type="hidden" value="<?= $data['price']?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if(isset($_SESSION['is_transaction_add_to_chart'])): ?>
    <?php if($_SESSION['is_transaction_add_to_chart']): ?>
    <div class="alert alert-success">
        <div>Behasil menambahkan ke keranjang</div>
        <a href="<?= $base_url . 'souvenir/shopping-chart'?>">Cek Keranjang</a>
    </div>
    <?php else: ?>
    <div class="alert alert-success">
        <div>GAGAL menambahkan ke keranjang</div>
        <a href="<?= $base_url . 'souvenir/shopping-chart'?>">Cek Keranjang</a>
    </div>
    <?php endif; ?>
    <?php unset($_SESSION['is_transaction_add_to_chart']); ?>
    <?php endif; ?>

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

    <?php endif; ?>
    <script>
    price = document.getElementById('price');
    priceTotalText = document.getElementById('price-total-text');
    priceTotal = document.getElementById('price-total');
    inputUnit = document.getElementById('input-unit');

    const formattedAmount = (amount) => {
        formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);

        return formatted;
    }

    priceTotalText.innerText = formattedAmount(price.value);

    inputUnit.addEventListener('input', function(e) {
        unit = e.target.value;
        total = parseInt(unit) * parseInt(price.value);
        priceTotal.value = total;
        priceTotalText.innerText = formattedAmount(total);
    });
    </script>
</section>
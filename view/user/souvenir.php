<?php require_once 'layouts/header.php' ?>

<?php


if (!isset($_SESSION['auth'])  && $_SERVER['REQUEST_URI'] !== "/souvenir") {
    echo "<meta http-equiv='Refresh' content='0; url=$base_url" . "'home'>";
} else {
    if (isset($is_detail) && $is_detail == true) {
        require_once 'souvenir/souvenir-detail.php';
    } elseif (isset($is_payment) && $is_payment == true) {
        require_once 'souvenir/payment.php';
    } elseif (isset($is_order) && $is_order == true) {
        require_once 'souvenir/order.php';
    } elseif (isset($is_shopping_chart) && $is_shopping_chart == true) {
        require_once 'souvenir/shopping-chart.php';
    } else {
        require_once 'souvenir/souvenir.php';
    }
}


?>

<?php require_once 'layouts/footer.php' ?>
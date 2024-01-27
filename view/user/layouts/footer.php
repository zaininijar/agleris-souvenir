</main>
<footer style="padding: 80px 80px 30px 80px;">
    <div style="display: flex; justify-content: space-between; gap: 100px">
        <section style="text-align: left;">
            <div class="brand secondary-font" style="font-size: 48px;">
                <a href="<?= $base_url ?>"> Agleris Souvenir </a>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est odit dolorum cupiditate praesentium in iure
                placeat. Cupiditate at quaerat deserunt!</p>
        </section>
        <section style="width: 70%;">
            <h2 style="color: white; text-align: left;" class="title-section">Support Payment</h2>
            <div class="payment-method">
                <div class="image">
                    <img src="<?= $base_url . 'view/user/' ?>assets/images/payment/bri.svg" alt="" />
                </div>
                <div class="image">
                    <img src="<?= $base_url . 'view/user/' ?>assets/images/payment/bni.svg" alt="" />
                </div>
                <div class="image">
                    <img src="<?= $base_url . 'view/user/' ?>assets/images/payment/bca.svg" alt="" />
                </div>
                <div class="image">
                    <img src="<?= $base_url . 'view/user/' ?>assets/images/payment/mandiri.svg" alt="" />
                </div>
                <div class="image">
                    <img src="<?= $base_url . 'view/user/' ?>assets/images/payment/dana.svg" alt="" />
                </div>
                <div class="image">
                    <img src="<?= $base_url . 'view/user/' ?>assets/images/payment/ovo.svg" alt="" />
                </div>
                <div class="image">
                    <img src="<?= $base_url . 'view/user/' ?>assets/images/payment/gopay.svg" alt="" />
                </div>

            </div>
        </section>
    </div>
    <p style="margin-top: 30px; border-top: 1px solid white; padding-top: 30px;">Copyright 2023 © Web Souvenir</p>
</footer>
<a href="<?= $base_url . 'souvenir/shopping-chart' ?>" class="buble-chart">
    <div class="count"><?php print(isset($new_chart_count)) ? $new_chart_count : $chart_count ?? 0; ?></div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path
            d="M4.00436 6.41662L0.761719 3.17398L2.17593 1.75977L5.41857 5.00241H20.6603C21.2126 5.00241 21.6603 5.45012 21.6603 6.00241C21.6603 6.09973 21.6461 6.19653 21.6182 6.28975L19.2182 14.2898C19.0913 14.7127 18.7019 15.0024 18.2603 15.0024H6.00436V17.0024H17.0044V19.0024H5.00436C4.45207 19.0024 4.00436 18.5547 4.00436 18.0024V6.41662ZM5.50436 23.0024C4.67593 23.0024 4.00436 22.3308 4.00436 21.5024C4.00436 20.674 4.67593 20.0024 5.50436 20.0024C6.33279 20.0024 7.00436 20.674 7.00436 21.5024C7.00436 22.3308 6.33279 23.0024 5.50436 23.0024ZM17.5044 23.0024C16.6759 23.0024 16.0044 22.3308 16.0044 21.5024C16.0044 20.674 16.6759 20.0024 17.5044 20.0024C18.3328 20.0024 19.0044 20.674 19.0044 21.5024C19.0044 22.3308 18.3328 23.0024 17.5044 23.0024Z"
            fill="rgba(255,255,255,1)"></path>
    </svg>
</a>
</div>
<script src="<?= $base_url . 'view/user/' ?>assets/js/global.js"></script>

</body>

</html>
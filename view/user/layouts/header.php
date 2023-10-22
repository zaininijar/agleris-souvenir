<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= $base_url . 'view/user/' ?>assets/css/global.css" />
    <title>Agleris Souvenir</title>
</head>

<body class="primary-font">
    <div class="wrapper">
        <a href="<?= $base_url . 'souvenir/shopping-chart' ?>" class="buble-chart">
            <div class="count"><?= $chart_count ?></div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M4.00436 6.41662L0.761719 3.17398L2.17593 1.75977L5.41857 5.00241H20.6603C21.2126 5.00241 21.6603 5.45012 21.6603 6.00241C21.6603 6.09973 21.6461 6.19653 21.6182 6.28975L19.2182 14.2898C19.0913 14.7127 18.7019 15.0024 18.2603 15.0024H6.00436V17.0024H17.0044V19.0024H5.00436C4.45207 19.0024 4.00436 18.5547 4.00436 18.0024V6.41662ZM5.50436 23.0024C4.67593 23.0024 4.00436 22.3308 4.00436 21.5024C4.00436 20.674 4.67593 20.0024 5.50436 20.0024C6.33279 20.0024 7.00436 20.674 7.00436 21.5024C7.00436 22.3308 6.33279 23.0024 5.50436 23.0024ZM17.5044 23.0024C16.6759 23.0024 16.0044 22.3308 16.0044 21.5024C16.0044 20.674 16.6759 20.0024 17.5044 20.0024C18.3328 20.0024 19.0044 20.674 19.0044 21.5024C19.0044 22.3308 18.3328 23.0024 17.5044 23.0024Z"
                    fill="rgba(255,255,255,1)"></path>
            </svg>
        </a>
        <header style="position: relative;">
            <div class="header-effect"></div>
            <section class="navbar container">
                <div class="brand secondary-font">
                    <a href="<?= $base_url ?>"> Agleris Souvenir </a>
                </div>
                <div class="nav-links">
                    <ul>
                        <li><a class="<?php print ($menu == 'home') ? 'active' : ''; ?>"
                                href="<?= $base_url . "home"; ?>">Home</a></li>
                        <li><a class="<?php print ($menu == 'souvenir') ? 'active' : ''; ?>"
                                href="<?= $base_url . "souvenir" ?>">Souvenir</a>
                        </li>
                        <li><a class="<?php print ($menu == 'contact') ? 'active' : ''; ?>"
                                href="<?= $base_url . "contact" ?>">Contacts</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-auth">
                    <ul>
                        <?php if (isset($_SESSION['auth'])) : ?>
                        <li>
                            <a class="<?php print ($menu == 'pesanan') ? 'active' : ''; ?>"
                                href="<?= $base_url . "souvenir/order" ?>">Pesanan</a>
                        </li>
                        <li>
                            <a class="<?php print ($menu == 'logout') ? 'active' : ''; ?>"
                                href="<?= $base_url . "logout" ?>">Logout</a>
                        </li>
                        <?php else : ?>
                        <li>
                            <a class="<?php print ($menu == 'login') ? 'active' : ''; ?>"
                                href="<?= $base_url . "login" ?>">Login</a>
                        </li>
                        <li>
                            <a class="<?php print ($menu == 'register') ? 'active' : ''; ?>"
                                href="register">Register</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>
            <section class="hero"
                style="<?php print ($menu == 'souvenir' || $menu == 'contact') ? 'height: 700px' : '' ?>">
                <img src="<?= $base_url . 'view/user/' ?>assets/images/global/souvenir-hero.jpg" alt="" />
                <?php if ($hero_text) : ?>
                <div class="hero-text">
                    <div>
                        <h1 class="secondary-font">
                            <?= $hero_text_h1 ?>
                        </h1>
                        <h3>
                            <?= $hero_text_h3 ?>
                        </h3>
                        <?php print ($hero_button) ? "<br /><br /><a class='btn-primary' href='#ref'>Let's See</a>" : "" ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="hero-waves">
                    <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 390" xmlns="http://www.w3.org/2000/svg"
                        class="transition duration-300 ease-in-out delay-150">
                        <defs>
                            <linearGradient id="gradient" x1="35%" y1="2%" x2="65%" y2="98%">
                                <stop offset="2%" stop-color="#fffdf8"></stop>
                                <stop offset="98%" stop-color="white"></stop>
                            </linearGradient>
                        </defs>
                        <path
                            d="M 0,400 C 0,400 0,133 0,133 C 74.30769230769232,159.4025641025641 148.61538461538464,185.80512820512823 217,181 C 285.38461538461536,176.19487179487177 347.8461538461538,140.18205128205128 438,136 C 528.1538461538462,131.81794871794872 646,159.46666666666667 730,152 C 814,144.53333333333333 864.1538461538462,101.95128205128206 932,101 C 999.8461538461538,100.04871794871794 1085.3846153846155,140.72820512820513 1173,153 C 1260.6153846153845,165.27179487179487 1350.3076923076924,149.13589743589745 1440,133 C 1440,133 1440,400 1440,400 Z"
                            stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.53"
                            class="transition-all duration-300 ease-in-out delay-150 path-0"></path>
                        <defs>
                            <linearGradient id="gradient" x1="35%" y1="2%" x2="65%" y2="98%">
                                <stop offset="2%" stop-color="#fffdf8"></stop>
                                <stop offset="98%" stop-color="white"></stop>
                            </linearGradient>
                        </defs>
                        <path
                            d="M 0,400 C 0,400 0,266 0,266 C 101.89487179487179,274.41282051282053 203.78974358974358,282.825641025641 283,273 C 362.2102564102564,263.174358974359 418.7358974358974,235.1102564102564 492,230 C 565.2641025641026,224.8897435897436 655.2666666666668,242.7333333333333 735,251 C 814.7333333333332,259.2666666666667 884.197435897436,257.9564102564103 966,254 C 1047.802564102564,250.0435897435897 1141.9435897435897,243.44102564102562 1223,245 C 1304.0564102564103,246.55897435897438 1372.0282051282052,256.2794871794872 1440,266 C 1440,266 1440,400 1440,400 Z"
                            stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="1"
                            class="transition-all duration-300 ease-in-out delay-150 path-1"></path>
                    </svg>
                </div>
            </section>
        </header>
        <main class="container">
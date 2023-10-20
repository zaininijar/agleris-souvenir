<?php

$base_url = 'http://localhost/agleris-souvenir/';
require_once 'connection.php';

if (isset($_GET['url'])) {
    $url = rtrim($_GET['url'], '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
}

session_start();

if (isset($url)) {
    $url_now = $url[0];
    $url_then = (isset($url[1]) ? $url[1] : '');
    $hero_text = false;
    $hero_text_h1 = false;
    $hero_text_h3 = false;
    $hero_button = false;
    $menu = '';

    if ($url_now == 'admin') {
        switch ($url_then) {
            case 'souvenir':
                require_once 'view/admin/souvenir.php';
                break;

            default:
                echo "overview";
                require_once 'view/admin/index.php';
                break;
        }
    } else {
        switch ($url_now) {
            case 'login':
                $menu = 'login';
                require_once 'view/user/login.php';
                break;
            case 'home':
                $menu = 'home';
                $hero_text = true;
                $hero_text_h1 = "Sulap Momen Spesial dengan Souvenir Berkualitas Tinggi dari Kami.";
                $hero_text_h3 = "Momen penting memerlukan perhatian khusus. Lihatlah pilihan
                hadiah spesial kami yang akan membuat setiap perayaan lebih
                berarti. Buat kenangan tak terlupakan bersama kami.";
                $hero_button = true;

                require_once 'view/user/index.php';
                break;
            case 'souvenir':
                $menu = 'souvenir';
                $hero_text = true;
                $hero_text_h1 = "Temukan Souvenir Tebaik.";
                $hero_text_h3 = '<form class="form-souvenir" action="">
                <input
                  class="search-souvenir"
                  type="search"
                  name="search"
                  id="search"
                  placeholder="cari bedasarkan : nama | kategori "
                />
                <button
                  class="button-search-souvenir"
                  type="submit"
                  name="search"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z"
                      fill="#ff6969"
                    ></path>
                  </svg>
                </button>
              </form>';
                require_once 'view/user/souvenir.php';
                break;
            case 'contact':
                $menu = 'contact';
                $hero_text = true;
                $hero_text_h1 = "Customer Contact.";
                $hero_text_h3 = "Mendapatkan kendala?, atau meminta petunjuk pemesanan dll.<br />hubungi admin kami.";
                require_once 'view/user/contact.php';
                break;
            case 'register':
                $menu = 'register';
                require_once 'view/user/register.php';
                break;
            case 'logout':
                if (isset($_SESSION['auth'])) {
                    session_unset();
                    session_destroy();
                    header('Location: ' . $base_url);
                } else {
                    session_destroy();
                    session_unset();
                    header('Location: ' . $base_url);
                }
                break;

            default:
                echo "404 Not Found";
                break;
        }
    }
} else {
    $menu = 'home';
    $hero_text = true;
    $hero_text_h1 = "Sulap Momen Spesial dengan Souvenir Berkualitas Tinggi dari Kami.";
    $hero_text_h3 = "Momen penting memerlukan perhatian khusus. Lihatlah pilihan
    hadiah spesial kami yang akan membuat setiap perayaan lebih
    berarti. Buat kenangan tak terlupakan bersama kami.";
    $hero_button = true;
    require_once 'view/user/index.php';
}

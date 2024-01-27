<?php require_once 'layouts/header.php' ?>
<?php

if (isset($_SESSION['auth'])) {
    echo " <meta http-equiv='Refresh' content='0; url=home'>";
}

function login($data)
{
    global $conn;
    $email = $data['email'];
    $password = $data['password'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($result)) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $auth = [
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "role" => 0
            ];
            $_SESSION['auth'] = $auth;
            echo " <meta http-equiv='Refresh' content='0; url=home'>";
        } else {
            return 'Password salah!';
        }
    } else {
        return 'Email anda <b>' . $email . '</b> belum terdaftar';
    }
}


if (isset($_POST['login'])) {

    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $errors = login([
        'email' => $email_login,
        'password' => $password_login
    ]);
}

?>
<link rel="stylesheet" href="<?= $base_url . 'view/user/' ?>assets/css/login.css" />

<section class="login-container">
    <div class="form-container">
        <h1 class="title-section">Login Form</h1>
        <h3 class="subtitle-section">
            Selamat datang kembali! Masukkan informasi akun Anda untuk
            melanjutkan.
        </h3>
        <form action="" method="POST">
            <div>
                <label for="email">Email</label>
                <input placeholder="type your email" type="text" name="email" id="email" />
            </div>
            <div>
                <label for="password">Password</label>
                <input placeholder="type your password" type="password" name="password" id="password" />
            </div>
            <div>
                <button type="submit" name="login" class="btn-login">Login</button>
                <a href="register" class="btn-register">I dont have account</a>
            </div>
        </form>
    </div>
    <div style="width: 60%; height: max-content; overflow: hidden;">
        <img style="object-fit: cover; object-position: center; width: 100%; height: 100%;"
            src="<?= $base_url ?>view/user/assets/images/souvenir/3.jpg" alt="">
    </div>
</section>
<?php require_once 'layouts/footer.php' ?>
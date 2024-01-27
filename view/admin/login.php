<?php

if (isset($_SESSION['auth']) and $_SESSION['auth']['role'] == 1) {
    echo " <meta http-equiv='Refresh' content='0; url=$base_url" . "admin'>";
}

function login($data)
{
    global $conn, $base_url;
    $email = $data['email'];
    $password = $data['password'];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");

    if (mysqli_num_rows($result)) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $auth = [
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "role" => 1
            ];
            $_SESSION['auth'] = $auth;
            echo " <meta http-equiv='Refresh' content='0; url=$base_url" . "admin'>";
        } else {
            return 'Password salah!';
        }
    } else {
        return 'Email anda <b>' . $email . '</b> belum terdaftar';
    }
}

if (isset($_POST['login-admin'])) {

    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $errors = login([
        'email' => $email_login,
        'password' => $password_login
    ]);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="<?= $base_url ?>view/admin/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?= $base_url ?>view/admin/vendors/base/vendor.bundle.base.css" />
    <link rel="stylesheet" href="<?= $base_url ?>view/admin/css/style.css" />
    <title>Agleris Souvenir | Admin Login</title>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <h1 class="secondary-font">Agleris Souvenir</h1>
                            </div>
                            <h4>Welcome back!</h4>
                            <h6 class="font-weight-light">Happy to see you again!</h6>
                            <form action="" method="post" class="pt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <div class="input-group">
                                        <input name="email" type="email"
                                            class="form-control form-control-lg border-left-0" id="exampleInputEmail"
                                            placeholder="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Password</label>
                                    <div class="input-group">
                                        <input name="password" type="password"
                                            class="form-control form-control-lg border-left-0" id="exampleInputPassword"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <button type="submit" name="login-admin"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text-white">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy;
                            2020 Agleris Souvenir.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
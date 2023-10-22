<?php require_once 'layouts/header.php' ?>

<?php

function register($data)
{
    global $conn;

    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $address = $data['address'];

    $sql = "INSERT INTO users (name, email, password, address) 
    VALUES(
            '" . $name . "', 
            '" . $email . "', 
            '" . $password . "',
            '" . $address . "'
        )";

    if ($conn->query($sql)) {
        return "Berhasil Mendaftar";
    } else {
        var_dump(mysqli_error($conn));
    };
}

if (isset($_POST['register'])) {
    $messageSuccess = register([
      'name' => filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW),
      'email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
      'password' => password_hash($_POST["password"], PASSWORD_DEFAULT),
      'address' => filter_input(INPUT_POST, 'address', FILTER_UNSAFE_RAW)
    ]);
}

?>

<link rel="stylesheet" href="<?= $base_url . 'view/user/' ?>assets/css/login.css" />

<section class="login-container">
    <?php if (isset($messageSuccess)) : ?>
    <div class="alert-success">
        <?= $messageSuccess; ?> <a href="login">Login Sekarang</a>
    </div>
    <?php endif; ?>
    <h1 class="title-section">Register Form</h1>
    <h3 class="subtitle-section">
        Daftar dan jadilah anggota komunitas Agleris Souvenir. Mari
        bergabung bersama kami!
    </h3>
    <form action="" method="POST">
        <div>
            <label for="username">Username</label>
            <input placeholder="type your username" type="text" name="name" id="username" />
        </div>
        <div>
            <label for="email">Email</label>
            <input placeholder="type your email" type="email" name="email" id="email" />
        </div>
        <div>
            <label for="password">Password</label>
            <input placeholder="type your password" type="password" name="password" id="password" />
        </div>
        <div>
            <label for="confirm-password">Confirm Password</label>
            <input placeholder="retype your password" type="confirm password" name="confirm password"
                id="confirm-password" />
        </div>
        <div>
            <label for="address">Adress</label>
            <textarea name="address" id="address" cols="30" rows="10"></textarea>
        </div>
        <div>
            <button type="submit" name="register" class="btn-login">Register</button>
            <a href="login" class="btn-register">Already have account</a>
        </div>
    </form>
</section>

</section>
<?php require_once 'layouts/footer.php' ?>
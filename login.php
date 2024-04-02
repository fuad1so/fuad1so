<?php

require_once('db_connection.php');


if (basename($_SERVER['PHP_SELF']) == 'login.php') {
    header("Location:user.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $has_error = false;

        if (empty($email)) {
            $error_login_email = "Please provide your email!";
            $has_error = true;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_login_email = "Please provide a valid email!";
            $has_error = true;
        }

        if (empty($password)) {
            $error_login_password = "Please provide your password!";
            $has_error = true;
        }

        if (!$has_error) {
            // Check if the user exists in the database
            $stmt = $pdo->prepare("SELECT user_id, username,email, password,profile_image, date_registered FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Login successful, redirect to profile page
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user'] = $user;
                header("Location: profile.php");
                exit();
            } else {
                $error_login_email = "Invalid email or password.";
                $has_error = true;
            }
        }
    }
}
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4 mt-2">
            <h2>Login</h2>
            <form method="post" action="">
                <div class="mb-1">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= htmlspecialchars($email ?? '') ?>">
                    <?php if (isset($error_login_email)) : ?>
                    <div class="alert alert-danger my-1 p-2"><?= $error_login_email ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php if (isset($error_login_password)) : ?>
                    <div class="alert alert-danger my-1 p-2"><?= $error_login_password ?></div>
                    <?php endif; ?>
                </div>
                <?php
                if (isset($login_errors)) :
                    foreach ($login_errors as $error) : ?>
                <div class="alert alert-danger"><?= $error ?></div>
                <?php endforeach;
                endif;
                ?>
                <input type="submit" name="login" value="Login" class="btn btn-primary mt-2 mb-2 border border-white">
            </form>
        </div>
    </div>
</div>
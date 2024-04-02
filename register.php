<?php
require_once('db_connection.php');
if (basename($_SERVER['PHP_SELF']) == 'register.php') {
    header("Location:user.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {

        // Sanitization
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $register_email = $_POST['register_email'];
        // Password hash
        $register_password = password_hash($_POST["register_password"], PASSWORD_DEFAULT);

        $has_error = false;

        if (empty($username)) {
            $error_username = "Please provide your username!";
            $has_error = true;
        }

        if (empty($register_email)) {
            $error_email = "Please provide your email!";
            $has_error = true;
        } else if (!filter_var($register_email, FILTER_VALIDATE_EMAIL)) {
            $error_email = "Please provide a valid email!";
            $has_error = true;
        } else if (check_email_exists($register_email)) {
            $error_email = "Email is already registered!";
            $has_error = true;
        } else {
            $register_email = filter_input(INPUT_POST, "register_email", FILTER_VALIDATE_EMAIL);
        }

        if (empty($_POST['register_password'])) {
            $error_password = "Please provide your password!";
            $has_error = true;
        }

        if (!$has_error) {
            // Insert user into the database
            $stmt = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $register_email, $register_password]);
            // $confirm = "Registration Successful, Please login!";
            // Redirect to login page after successful registration
            header("Location:  user.php?action=confirmReg");
            exit();
        }
    }
}
// Check if email already exists
function check_email_exists($register_email)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT user_id FROM user WHERE email = ?");
    $stmt->execute([$register_email]);
    if ($stmt->rowCount() > 0) {
        return true;
    }
}
?>



<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-11 mb-4 mt-3">
            <h2>Register</h2>
            <form method="post" action="">
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="<?= htmlspecialchars($username ?? '') ?>">
                    <?php if (isset($error_username)) : ?>
                    <div class="alert alert-danger my-1 p-2"><?= $error_username ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-1">
                    <label for="register_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="register_email" name="register_email"
                        value="<?= htmlspecialchars($register_email ?? '') ?>">
                    <?php if (isset($error_email)) : ?>
                    <div class="alert alert-danger my-1 p-2"><?= $error_email ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="register_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="register_password" name="register_password">
                    <?php if (isset($error_password)) : ?>
                    <div class="alert alert-danger my-1 p-2"><?= $error_password ?></div>
                    <?php endif; ?>
                </div>

                <input type="submit" name="register" value="Register"
                    class="btn btn-primary mt-2 mb-4 border border-white">
            </form>
        </div>
    </div>
</div>
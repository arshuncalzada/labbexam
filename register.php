<?php
$first_name = '';
$last_name = '';
$email = '';
$username = '';
$password = '';
$confirm_password = '';
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if ($first_name === '') $errors[] = 'First name is required.';
    if ($last_name === '') $errors[] = 'Last name is required.';
    if ($email === '') $errors[] = 'Email is required.';
    if ($username === '') $errors[] = 'Username is required.';
    if ($password === '') $errors[] = 'Password is required.';
    if ($confirm_password === '') $errors[] = 'Confirm password is required.';

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email format is invalid.';
    }

    if ($password !== '' && $confirm_password !== '' && $password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors) $success = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registration</title>
    <style>
        *{box-sizing:border-box}
        body{margin:0;font-family:system-ui,Arial,sans-serif;background:#f3f4f6}
        .wrap{min-height:100vh;display:flex;align-items:flex-start;justify-content:center;padding:56px 16px}
        .card{width:100%;max-width:640px;background:#fff;border-radius:10px;padding:24px;box-shadow:0 10px 30px rgba(0,0,0,.08)}
        h1{margin:0 0 18px;font-size:22px;font-weight:700}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:14px 16px}
        .full{grid-column:1 / -1}
        label{display:block;margin:0 0 6px;font-size:12px;color:#111827}
        input{width:100%;height:40px;border:1px solid #d1d5db;border-radius:8px;padding:0 12px;font-size:14px;outline:none}
        input:focus{border-color:#34d399;box-shadow:0 0 0 3px rgba(52,211,153,.22)}
        button{width:100%;height:40px;border:0;border-radius:8px;background:#16a34a;color:#fff;font-weight:600;font-size:14px;cursor:pointer;margin-top:16px}
        .msg{margin:12px 0;padding:10px 12px;border-radius:8px;font-size:14px}
        .error{background:#fee2e2;color:#991b1b}
        .success{background:#dcfce7;color:#166534}
        ul{margin:0;padding-left:18px}
        .link{margin-top:14px;text-align:center;font-size:13px;color:#111827}
        a{color:#2563eb;text-decoration:none}
        a:hover{text-decoration:underline}
        @media (max-width:620px){
            .card{max-width:520px}
            .grid{grid-template-columns:1fr}
            .full{grid-column:auto}
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1>Registration</h1>

        <?php if ($errors): ?>
            <div class="msg error">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="msg success">Registration Successful</div>
        <?php else: ?>
            <form method="post" action="">
                <div class="grid">
                    <div>
                        <label for="first_name">First Name</label>
                        <input id="first_name" name="first_name" type="text" value="<?= htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div>
                        <label for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" type="text" value="<?= htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="full">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="full">
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" value="<?= htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div>
                        <label for="confirm_password">Confirm Password</label>
                        <input id="confirm_password" name="confirm_password" type="password" value="<?= htmlspecialchars($confirm_password, ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                </div>

                <button type="submit">Register</button>
            </form>
        <?php endif; ?>

        <div class="link">
            Already have an account? <a href="login.php">Go to Login</a>
        </div>
    </div>
</div>
</body>
</html>
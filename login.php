<?php
$username = '';
$password = '';
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '') $errors[] = 'Username is required.';
    if ($password === '') $errors[] = 'Password is required.';

    if (!$errors) $success = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <style>
        *{box-sizing:border-box}
        body{margin:0;font-family:system-ui,Arial,sans-serif;background:#f3f4f6}
        .wrap{min-height:100vh;display:flex;align-items:flex-start;justify-content:center;padding:56px 16px}
        .card{width:100%;max-width:520px;background:#fff;border-radius:10px;padding:24px;box-shadow:0 10px 30px rgba(0,0,0,.08)}
        h1{margin:0 0 18px;font-size:22px;font-weight:700}
        .field{margin-bottom:14px}
        label{display:block;margin:0 0 6px;font-size:12px;color:#111827}
        input{width:100%;height:40px;border:1px solid #d1d5db;border-radius:8px;padding:0 12px;font-size:14px;outline:none}
        input:focus{border-color:#60a5fa;box-shadow:0 0 0 3px rgba(96,165,250,.25)}
        button{width:100%;height:40px;border:0;border-radius:8px;background:#2563eb;color:#fff;font-weight:600;font-size:14px;cursor:pointer}
        .msg{margin:12px 0;padding:10px 12px;border-radius:8px;font-size:14px}
        .error{background:#fee2e2;color:#991b1b}
        .success{background:#dcfce7;color:#166534}
        ul{margin:0;padding-left:18px}
        .link{margin-top:14px;text-align:center;font-size:13px;color:#111827}
        a{color:#2563eb;text-decoration:none}
        a:hover{text-decoration:underline}
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1>Login</h1>

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
            <div class="msg success">Login Successful</div>
        <?php else: ?>
            <form method="post" action="">
                <div class="field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" value="<?= htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <button type="submit">Login</button>
            </form>
        <?php endif; ?>

        <div class="link">
            No account? <a href="register.php">Go to Registration</a>
        </div>
    </div>
</div>
</body>
</html>
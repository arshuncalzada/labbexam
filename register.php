<?php
$full_name = '';
$email = '';
$username = '';
$password = '';
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = trim($_POST['password'] ?? '');

    if ($full_name === '') $errors[] = 'Full name is required.';
    if ($email === '')     $errors[] = 'Email is required.';
    if ($username === '')  $errors[] = 'Username is required.';
    if ($password === '')  $errors[] = 'Password is required.';

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email format is invalid.';
    }

    if (!$errors) $success = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0e0f11;
            --surface: #17191d;
            --border: #2a2d34;
            --accent: #a8ff78;
            --accent-dim: rgba(168,255,120,.12);
            --text: #f0f0f0;
            --muted: #6b7280;
            --error-bg: rgba(239,68,68,.1);
            --error-text: #f87171;
            --success-bg: rgba(168,255,120,.1);
            --success-text: #a8ff78;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(168,255,120,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(168,255,120,.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .card {
            position: relative;
            width: 100%;
            max-width: 480px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px 36px;
            box-shadow: 0 0 60px rgba(0,0,0,.5), 0 0 0 1px rgba(168,255,120,.05);
            animation: fadeUp .4s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--accent);
            background: var(--accent-dim);
            border: 1px solid rgba(168,255,120,.2);
            border-radius: 100px;
            padding: 4px 12px;
            margin-bottom: 18px;
        }

        h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 30px;
            font-weight: 400;
            line-height: 1.2;
            color: var(--text);
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .04em;
            color: #9ca3af;
            margin-bottom: 7px;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            height: 44px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        input::placeholder { color: #3d4148; }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(168,255,120,.14);
        }

        button {
            width: 100%;
            height: 46px;
            margin-top: 8px;
            border: none;
            border-radius: 10px;
            background: var(--accent);
            color: #0e0f11;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .02em;
            cursor: pointer;
            transition: opacity .2s, transform .15s;
        }

        button:hover { opacity: .88; transform: translateY(-1px); }
        button:active { transform: translateY(0); }

        .msg {
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13.5px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .msg.error {
            background: var(--error-bg);
            border-color: rgba(239,68,68,.2);
            color: var(--error-text);
        }

        .msg.success {
            background: var(--success-bg);
            border-color: rgba(168,255,120,.2);
            color: var(--success-text);
            text-align: center;
            font-weight: 600;
        }

        ul { padding-left: 18px; }
        ul li { margin-bottom: 4px; }

        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 24px 0 18px;
        }

        .link {
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        .link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .link a:hover { text-decoration: underline; }

        @media (max-width: 520px) {
            .card { padding: 30px 20px; }
        }
    </style>
</head>
<body>
<div class="card">
    <div class="card-tag">Create account</div>
    <h1>Get started</h1>
    <p class="subtitle">Fill in the details below to register.</p>

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
        <div class="msg success">Registration successful!</div>
    <?php else: ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input id="full_name" name="full_name" type="text" placeholder="Juan dela Cruz"
                       value="<?= htmlspecialchars($full_name, ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" placeholder="you@example.com"
                       value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="juandelacruz"
                       value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="••••••••">
            </div>

            <button type="submit">Register</button>
        </form>
    <?php endif; ?>

    <hr class="divider">
    <p class="link">Already have an account? <a href="login.php">Sign in</a></p>
</div>
</body>
</html>

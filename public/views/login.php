<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="/public/css/login-signup.css">
    <title>LOGIN PAGE</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php") ?>
    <div class="content">
        <section class="login-container">
            <img src="/public/img/cubesat-in-space.svg">
            <form action="login" method="POST">
                <h1>Log In</h1>
                <div class="messages">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="Email">
                <input name="password" type="password" placeholder="Password">
                <button type="submit">CONTINUE</button>
            </form>
        </section>
    </div>
</div>
</div>
</body>
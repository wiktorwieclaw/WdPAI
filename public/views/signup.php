<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <script type="text/javascript" src="/public/js/validate.js" defer></script>
    <link rel="stylesheet" type="text/css" href="/public/css/login-signup.css">
    <title>SIGNUP</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php") ?>
    <div class="content">
        <section class="login-container">
            <img src="/public/img/cubesat-in-space.svg">
            <form action="/signup" method="POST">
                <h1>Create an Account</h1>
                <div class="messages">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message."<br>";
                        }
                    }
                    ?>
                </div>
                <input name="name" type="text" placeholder="Name" maxlength="35">
                <input name="surname" type="text" placeholder="Surname" maxlength="35">
                <input name="email" type="text" placeholder="Email" maxlength="254">
                <input name="password" type="password" placeholder="Password" maxlength="100">
                <input name="confirm-password" type="password" placeholder="Confirm Password" maxlength="100">
                <button type="submit">CONTINUE</button>
            </form>
    </div>
    </section>
</div>
</div>
</body>
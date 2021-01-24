<!DOCTYPE html>
<head>
    <?php include("head.php")?>
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>SIGNUP</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php")?>
    <div class="content">
        <section class="login">
            <div class="image-container">
                <img src="/public/img/cubesat-in-space.svg">
            </div>
            <div class="form-container">
                <form class="signup" action="/signup" method="POST">
                    <h1>Create an Account</h1>
                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input name="name" type="text" placeholder="Name">
                    <input name="surname" type="text" placeholder="Surname">
                    <input name="email" type="text" placeholder="Email">
                    <input name="password" type="password" placeholder="Password">
                    <input name="confirm-password" type="password" placeholder="Confirm Password">
                    <button type="submit">CONTINUE</button>
                </form>
            </div>
        </section>
    </div>
</div>
</body>
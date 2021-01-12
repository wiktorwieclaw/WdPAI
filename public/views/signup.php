<!DOCTYPE html>
<head>
    <link rel = "stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/917ffdbb3f.js" crossorigin="anonymous"></script>
    <title>SIGNUP</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php")?>
    <div class="content">
        <section class="login">
            <div class="image-container">
                <img src="public/img/cubesat-in-space.svg">
            </div>
            <div class="form-container">
                <form>
                    <h1>Create an Account</h1>
                    <input name="name" type="text" placeholder="Full Name">
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
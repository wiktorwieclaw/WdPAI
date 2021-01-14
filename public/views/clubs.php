<!DOCTYPE html>
<head>
    <link rel = "stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/917ffdbb3f.js" crossorigin="anonymous"></script>
    <title>CLUBS</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php")?>
    <div class="content">
        <section class="clubs">
            <div class="club">
                <div class="image-container">
                    <img src="public/uploads/test.png">
                </div>
                <h3>COSMO</h3>
                <p>Poland</p>
            </div>
            <div class="club">
                <div class="image-container">
                    <img src="public/uploads/full.png">
                </div>
                <h3><?= $club->getTitle() ?></h3>
                <p><?= $club->getDescription() ?></p>
            </div>
        </section>
    </div>
</div>
</body>
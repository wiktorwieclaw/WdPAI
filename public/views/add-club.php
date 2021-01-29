<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="/public/css/add-club.css">
</head>
<body>
<div class="base-container">
    <?php include("header.php") ?>
    <div class="content">
        <main>
            <section class="club-form">
                <h1>Register a new club</h1>
                <form action="/addClub" method="POST" ENCTYPE="multipart/form-data">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                    <input name="title" type="text" placeholder="Title">
                    <textarea name="description" rows="5" placeholder="Description"></textarea>
                    <p>Logo</p>
                    <input type="file" name="file">
                    <button type="submit">Register</button>
                </form>
            </section>
        </main>
    </div>
</div>
</body>
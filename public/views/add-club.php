<!DOCTYPE html>
<head>
    <link rel = "stylesheet" type="text/css" href = "public/css/style.css">
    <script src="https://kit.fontawesome.com/917ffdbb3f.js" crossorigin="anonymous"></script>
    <title>ADD CLUB</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php")?>
    <main>
        <section class="club-form">
            <h1>UPLOAD</h1>
            <form action="addClub" method="POST" ENCTYPE="multipart/form-data">
                <?php
                if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
                <input name="title" type="text" placeholder="title">
                <textarea name="description" rows="5" placeholder="description"></textarea>
                <input type="file" name="file">
                <button type="submit">send</button>
            </form>
        </section>
    </main>
</div>
</body>
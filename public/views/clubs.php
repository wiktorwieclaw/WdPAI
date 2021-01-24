<!DOCTYPE html>
<head>
    <?php include("head.php")?>
    <title>CLUBS</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php")?>
    <div class="content">
        <section class="clubs">
            <?php foreach ($clubs as $club): ?>
            <div class="club">
                <div class="image-container">
                    <img src="public/uploads/<?= $club->getImage() ?>">
                </div>
                <h3><?= $club->getTitle() ?></h3>
                <p><?= $club->getDescription() ?></p>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>
</body>
<!DOCTYPE html>
<head>
    <?php include("head.php")?>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>CLUBS</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php")?>
    <div class="content">
        <section class="clubs">
            <input name="search" placeholder="Search">
            <div class="clubs-container">
                <?php foreach ($clubs as $club): ?>
                <div id="<?=$club->getId() ?>" class="club">
                    <div class="image-container">
                        <img src="public/uploads/<?= $club->getImage() ?>">
                    </div>
                    <h3><?= $club->getTitle() ?></h3>
                    <p><?= $club->getDescription() ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>
</body>

<template id="club-template">
    <div id="" class="club">
        <div class="image-container">
            <img src="">
        </div>
        <h3>title</h3>
        <p>description</p>
    </div>
</template>

<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <script type="text/javascript" src="/public/js/search.js" defer></script>
    <link rel="stylesheet" type="text/css" href="/public/css/clubs.css">
    <title>CLUBS</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php") ?>
    <div class="content">
        <section class="clubs-container">
            <div id="search-bar">
                <input name="search" placeholder="Search">
                <button id="search-button" type="submit">Search</button>
            </div>
            <div class="clubs-grid">
                <?php foreach ($clubs as $club): ?>
                    <a id="<?= $club->getId() ?>" class="club" href="/club/<?= $club->getId() ?>">
                        <img src="public/uploads/<?= $club->getImage() ?>">
                        <h3><?= $club->getTitle() ?></h3>
                        <p><?= $club->getDescription() ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>
</body>

<template id="club-template">
    <a id="" class="club">
        <img src="">
        <h3>title</h3>
        <p>description</p>
    </a>
</template>

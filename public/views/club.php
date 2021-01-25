<!DOCTYPE html>
<head>
    <?php include("head.php")?>
    <script type="text/javascript" src="/public/js/join.js" defer></script>
    <title>PROFILE</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php")?>
    <div class="content">
        <h1><?= $club->getTitle() ?></h1>
        <button id="join-button" value="<?= $club->getId()?>">join</button>
        <div class="member-container">
            <?php foreach ($members as $member): ?>
                <a class="member" href="/profile/<?=$member['id_users']?>">
                    <h3><?=$member['name']?></h3>
                    <p><?=$member['surname']?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>

<template id="member-template">
    <a class="member">
        <h3>name</h3>
        <p>surname</p>
    </a>
</template>
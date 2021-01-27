<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <script type="text/javascript" src="/public/js/join.js" defer></script>
    <link rel="stylesheet" type="text/css" href="/public/css/club.css">
    <title>PROFILE</title>
</head>
<body>
<div class="base-container">
    <?php include("header.php") ?>
    <div class="content">
        <div class="club-page-container">
            <div class="column">
                <div class="club-info">
                    <h1><?= $club->getTitle() ?></h1>
                    <button id="join-button" value="<?= $club->getId() ?>">join</button>
                    <?php if($isAdmin): ?>
                        <form method="post" action="/deleteClub/<?= $club->getId() ?>"><button>Delete</button></form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="column">
                <h3>Members</h3>
                <div class="member-container">
                    <?php foreach ($members as $member): ?>
                        <a class="member" href="/profile/<?= $member['id_users'] ?>">
                            <p id="name"><?= $member['name'] ?></p>
                            <p id="surname"><?= $member['surname'] ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<template id="member-template">
    <a class="member">
        <p id="name">name</p>
        <p id="surname">surname</p>
    </a>
</template>
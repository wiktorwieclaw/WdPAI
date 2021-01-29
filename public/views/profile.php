<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="/public/css/clubs.css">
    <link rel="stylesheet" type="text/css" href="/public/css/profile.css">
    <script type="text/javascript" src="./public/js/search.js" defer></script>
</head>
<body>
<div class="base-container">
    <?php include("header.php") ?>
    <div class="content">
        <div class="profile-container">
            <div class="info-container">
                <h1><?= $user->getName() ?> <?= $user->getSurname() ?></h1>
                <?php if ($user->getRole() === "admin"): ?>
                    <h3 class="admin"><?= $user->getRole() ?></h3>
                <?php endif ?>
            </div>
            <?php include("clubs-grid.php") ?>
        </div>
    </div>
</div>
</body>
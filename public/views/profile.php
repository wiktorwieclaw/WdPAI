<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
</head>
<body>
<div class="base-container">
    <?php include("header.php") ?>
    <div class="content">
        <h1><?= $user->getName() ?></h1>
        <h1><?= $user->getSurname() ?></h1>
    </div>
</div>
</body>
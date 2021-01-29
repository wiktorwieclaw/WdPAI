<!DOCTYPE html>
<head>
    <?php include("head.php") ?>
    <script type="text/javascript" src="/public/js/search.js" defer></script>
    <link rel="stylesheet" type="text/css" href="/public/css/clubs.css">
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
            <?php include("clubs-grid.php")?>
        </section>
    </div>
</div>
</body>

<template id="club-template">
    <a id="" class="club">
        <img src="">
        <h3>title</h3>
    </a>
</template>

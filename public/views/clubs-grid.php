<div class="clubs-grid">
    <?php foreach ($clubs as $club): ?>
        <a id="<?= $club->getId() ?>" class="club" href="/club/<?= $club->getId() ?>">
            <img src="/public/uploads/<?= $club->getImage() ?>">
            <h3><?= $club->getTitle() ?></h3>
        </a>
    <?php endforeach; ?>
</div>
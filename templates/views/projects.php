<?php if ($projects === null) : ?>

    <div>
        <p> Vous n'avez pour le moment aucun projet de créé. :(</p>
    </div>

<?php else: ?>

    <?php foreach ($projets as $projet) : ?>

        <div>
            <p>Personna:<?= $projet->getPersonaMark() ?></p>
            <p>User Story: <?= $projet->getUserStoryMark() ?></p>
            <p>Story map: <?= $projet->getStoryMapMark() ?></p>
            <p>Matrice: <?= $projet->getMatriceMark() ?></p>
            <p>Score Final: <?= $projet->getFinalScoreMark() ?></p>
        </div>

    <?php endforeach; ?>

<?php endif; ?>

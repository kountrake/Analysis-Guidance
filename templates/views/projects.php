<div class="w-full">
    <div class="flex justify-center bg-white w-full my-10 p-4">
        <h1 class="text-center text-4xl font-bold underline">Mes projets</h1>
    </div>

    <div class="flex justify-center">
        <?php if (empty($projects)) : ?>
            <div class="flex flex-col items-center bg-white rounded w-2/3 p-5">
                <p class="mb-4"> Vous n'avez pour le moment aucun projet de créé. :(</p>
                <a href="/personna"
                   class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Créer
                    un projet</a>
            </div>
        <?php else : ?>
            <?php foreach ($projets as $projet) : ?>
                <?php $i = 1 ?>
                <div class="bg-white rounded w-2/3 p-5 mb-5">
                    <h3 class="text-xl text-center underline">Projet n° <?= $i ?></h3>
                    <div class="ml-20 mt-5">
                        <p class="mb-4">Personna: <?= $projet->getPersonaMark() ?></p>
                        <p class="mb-4">User Story: <?= $projet->getUserStoryMark() ?></p>
                        <p class="mb-4">Story map: <?= $projet->getStoryMapMark() ?></p>
                        <p class="mb-4">Matrice: <?= $projet->getMatriceMark() ?></p>
                        <p class="mb-4">Score Final: <?= $projet->getFinalScoreMark() ?></p>
                    </div>
                    <div class="flex flex-row justify-end">
                        <a href="/myprojects/2"
                           class="block bg-blue-700 rounded border-2 border-blue-800 py-2 px-5  text-white text-semi-bold mr-4 hover:underline hover:bg-blue-600">Visualiser
                            le projet</a>
                        <form method="post" action="/myprojects/delete/project">
                            <input type="hidden" name="id" value="<?= $projet->getId() ?>">
                            <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                                Supprimer le projet
                            </button>
                        </form>
                    </div>
                </div>
                <?php $i++ ?>
            <?php endforeach; ?>

<?php endif; ?>
    </div>

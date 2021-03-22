<?php
function checked($correspond, $etapeid, $exigenceid): bool
{
    foreach ($correspond as $c) {
        if ($c->idetape === $etapeid && $c->idexigence === $exigenceid) {
            return true;
        }
    }
    return false;
}

?>

<div class="w-full">

    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">Projet</h1>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h2 class="text-center text-2xl font-bold underline">Personna</h2>
    </div>

    <div class="flex flex-col w-full px-8">
        <div class="my-4 mx-2">
            <?php if (isset($personnas)) : ?>
                <?php $i = 1 ?>
                <?php foreach ($personnas as $personna) : ?>
                    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
                        <h3 class="text-center text-2xl font-bold">Personna n° <?= $i ?></h3>
                    </div>
                    <div class="w-full bg-white rounded mb-4 p-4">
                        <h3 class="text-center underline text-xl">Identité</h3>
                        <p class="p-2">Nom : <?= $personna->nom ?></p>
                        <p class="p-2">Prénom : <?= $personna->prenom ?></p>
                        <p class="p-2">Age : <?= $personna->age ?></p>
                        <p class="p-2">Profession : <?= $personna->role ?></p>
                    </div>
                    <div class="bg-white rounded mb-4 p-4">
                        <h3 class="text-center underline text-xl">Description</h3>
                        <p class="p-2"><?= $personna->caractéristiques ?></p>
                    </div>
                    <div class="bg-white rounded mb-4 p-4">
                        <h3 class="text-center underline text-xl">Objectifs</h3>
                        <p class="p-2"><?= $personna->objectif ?></p>
                    </div>
                    <div class="bg-white rounded mb-4 p-4">
                        <h3 class="text-center underline text-xl">Scénarios</h3>
                        <p class="p-2"><?= $personna->scénario ?></p>
                    </div>
                    <?php $i++ ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="flex justify-end">
                <a href="/personna/<?= $id ?>"
                   class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Modifier</a>
            </div>
        </div>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-4">
        <h2 class="text-center text-2xl font-bold underline">User Story</h2>
    </div>

    <div class="mx-10">
        <?php if (isset($userstories)) : ?>
            <?php $nbUs = 1 ?>
            <?php for ($i = 0; $i < count($userstories); $i+=3) : ?>
                <div class="mt-10 bg-white rounded">
                    <h3 class="text-center underline text-xl">Us - <?= $nbUs ?> </h3>
                    <div class="p-4">
                        <p class="p-2">
                            En tant que : <?= $userstories[$i]->entantque ?>
                        </p>
                        <p class="p-2">
                            Je veux : <?= $userstories[$i]->jeveux ?>
                        </p>
                        <p class="p-2">
                            De sorte que : <?= $userstories[$i]->desorte ?>
                        </p>
                        <p class="p-2">
                            Je suis satisfait si :
                        </p>
                        <ul class="pl-10 list-disc">
                            <li><?= $userstories[$i]->description ?></li>
                            <li><?= $userstories[$i+1]->description ?></li>
                            <li><?= $userstories[$i+2]->description ?></li>
                        </ul>
                    </div>
                </div>
                <?php $nbUs++?>
            <?php endfor; ?>
        <?php endif; ?>
        <div class="flex justify-end mt-4">
            <a href="/userstory/<?= $id ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Modifier</a>
        </div>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-4">
        <h2 class="text-center text-2xl font-bold underline">Story Map</h2>
    </div>

    <div class="mx-10">
        <div class="flex justify-center bg-white mb-4">
            <div class="flex flex-row m-4">
                <div class="flex flex-col border border-black border-r-0 justify-items-center">
                    <div class="border-b border-black p-4 text-center">
                        <?= $columns[0]->role->role ?>
                    </div>
                    <div class="p-4 border-b border-black">
                        <?php foreach ($columns[0]->activites as $activite) : ?>
                            <p><?= $activite->activite ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="p-4">
                        <?php foreach ($columns[0]->stories as $story) : ?>
                            <p><?= $story->description ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php for ($i = 1; $i < count($columns); $i++) : ?>
                    <div class="flex flex-col border-t border-b border-black justify-items-start">
                        <div class="border-b border-black p-4">
                            <?= $columns[$i]->role->role ?>
                        </div>
                        <div class="p-4 border-b border-black">
                            <?php foreach ($columns[$i]->activites as $activite) : ?>
                                <p><?= $activite->activite ?></p>
                            <?php endforeach; ?>
                        </div>
                        <div class="p-4">
                            <?php foreach ($columns[$i]->stories as $story) : ?>
                                <p><?= $story->description ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endfor; ?>
                <div class="flex flex-col items-stretch content-between border border-black border-l-0 item-center">
                    <div class="border-b border-black p-4">
                        Thèmes
                    </div>
                    <div class="p-4 border-b border-black">
                        Epics
                    </div>
                    <div class="p-4">
                        V1
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <form method="post" action="/storymap/delete">
                <input type="hidden" name="idProjet" value="<?= $id ?>">
                <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-4">
        <h2 class="text-center text-2xl font-bold underline">Matrice</h2>
    </div>
    <div class="mx-10">
        <div class="bg-white rounded mb-4">
            <div class="flex flex-col px-8 mt-4 bg-white ml-4 mr-4">

                <div class="my-4 mx-2 ">
                    <div class="mt-4 ml-auto mr-auto text-center">
                        <div class="m-4 p-4 border border-gray-500 rounded-lg">
                            <?php for ($i = 0; $i < count($couverture); $i++) : ?>
                                <?php
                                $etape = array_keys($couverture)[$i];
                                $exigences = array_values($couverture)[$i];
                                $etapeId = array_keys($couvertureId)[$i];
                                $exigencesId = array_values($couvertureId)[$i];
                                ?>
                                <p class="mb-2" ><?= $etape ?> : </p>
                                <?php for ($j = 0; $j < count($exigences); $j++) : ?>
                                    <input
                                    class="ml-4 mr-2 mb-5"
                                    type="checkbox"
                                    name="<?= $etapeId ?>[]"
                                    value="<?= $exigencesId[$j] ?>"
                                    <?= checked($correspond, $etapeId, $exigencesId[$j]) ? 'checked' : '' ?>><?= $exigences[$j] ?>
                                <?php endfor; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <form method="post" action="/matrice/delete">
                <input type="hidden" name="idProjet" value="<?= $id ?>">
                <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="flex justify-around bg-white w-full mt-10 p-4 mb-4">
        <form method="post" action="/myprojects/delete">
            <input type="hidden" name="id" value="<?= $projectId ?>">
            <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                Supprimer le projet
            </button>
        </form>
        <a href="/download/project/<?= $id ?>"
           class="block bg-gray-700 rounded border-2 border-gray-800 p-2 text-white text-semi-bold hover:underline hover:bg-gray-600">Télécharger
            le projet</a>
        <a href="/myprojects"
           class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Retour
            à mes projets</a>
    </div>
</div>
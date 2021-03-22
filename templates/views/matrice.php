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
        <h1 class="text-center text-4xl font-bold underline">Matrice </h1>
    </div>

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
    <div class="flex flew-row justify-around mb-4">
        <a href="/storymap/<?= $projectId ?>" class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
            Précédent
        </a>
        <a href="/download" class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
          Télécharger
        </a>
        <a href="/score/<?= $projectId ?>" class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
          Suivant
        </a>
    </div>
</div>



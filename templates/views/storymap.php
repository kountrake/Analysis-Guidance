<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-12">
        <h1 class="text-center text-4xl font-bold underline">Story Map</h1>
    </div>

    <div class="flex flex-col w-full px-8 pr-40 bg-white">
        <div class="flex justify-center">
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

        <div class="flex flew-row justify-around mb-4">
            <a href="/userstory/<?= $projectId ?>"
            class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                Précédent
            </a>
            <a href="/download/storymap/<?= $projectId ?>"
            class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                Télécharger
            </a>
            <a href="/matrice/correspond/<?= $projectId ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                Suivant
            </a>
        </div>

    </div>
</div>
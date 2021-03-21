<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">StoryMap - Les activités et leurs stories</h1>
    </div>

    <div class="flex flex-col px-8 mt-4 bg-white ml-4 mr-4">
        <div>
            <p class="text-center text-xl pt-4">Dans cette deuxième étape vous allez lier des stories avec des activités</p>
        </div>
        <div class="my-4 mx-2">
            <form method="post" action="/storymap/activite/create">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <?php $i = 0 ?>
                <?php foreach ($roles as $role) : ?>
                    <p class="text-xl"><?= $role->role ?></p>
                    <?php foreach ($activites[$i] as $activite) : ?>
                        <p><?= $activite->activite ?> : </p>
                        <div class="mb-6">
                            <div class="mb-4">
                                <p class="block text-grey-darker text-sm font-bold mb-2 pt-2">Story1</p>
                                <input name="<?= $role->idbut . '_' . $activite->idactivite . '_1' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                                <p class="block text-grey-darker text-sm font-bold mb-2 pt-2">priorité:</p>
                                <input name="<?= $role->idbut . '_' . $activite->idactivite . 'priorite_1' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                            </div>
                            <div class="mb-4">
                                <p class="block text-grey-darker text-sm font-bold mb-2 pt-2">Story2</p>
                                <input name="<?= $role->idbut . '_' . $activite->idactivite . '_2' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                                <p class="block text-grey-darker text-sm font-bold mb-2 pt-2">priorité:</p>
                                <input name="<?= $role->idbut . '_' . $activite->idactivite . 'priorite_2' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                            </div>
                            <div class="mb-4">
                                <p class="block text-grey-darker text-sm font-bold mb-2 pt-2">Story3</p>
                                <input name="<?= $role->idbut . '_' . $activite->idactivite . '_3' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                                <p class="block text-grey-darker text-sm font-bold mb-2 pt-2">priorité:</p>
                                <input name="<?= $role->idbut . '_' . $activite->idactivite . 'priorite_3' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php $i++ ?>
                <?php endforeach; ?>
            <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600 float-right">Créer</button>
            </form>
        </div>
    </div>
</div>
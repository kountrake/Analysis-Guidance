<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">StoryMap - Les activités et leurs stories</h1>
    </div>

    <div class="flex flex-col w-full px-8">
        <div>
            <p>Dans cette deuxième étape vous allez lier des stories avec des activités</p>
        </div>
        <div class="my-4 mx-2">
            <form method="post" action="/storymap/activite/create">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <?php $i = 0 ?>
                <?php foreach ($roles as $role) : ?>
                    <p><?= $role->role ?></p>
                    <?php foreach ($activites[$i] as $activite) : ?>
                        <p><?= $activite->activite ?> : </p>
                        <div class="mb-6">
                            <div class="mb-4">
                                <p class="block text-grey-darker text-sm font-bold mb-2">Story1</p>
                                <input name="<?= $role->role . '_' . $activite->activite . '_1' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                            </div>
                            <div class="mb-4">
                                <p class="block text-grey-darker text-sm font-bold mb-2">Story2</p>
                                <input name="<?= $role->role . '_' . $activite->activite . '_2' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                            </div>
                            <div class="mb-4">
                                <p class="block text-grey-darker text-sm font-bold mb-2">Story3</p>
                                <input name="<?= $role->role . '_' . $activite->activite . '_3' ?>"
                                       class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                       type="text">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php $i++ ?>
                <?php endforeach; ?>
            <button>Créer</button>
            </form>
        </div>
    </div>
</div>
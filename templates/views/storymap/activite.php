<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">StoryMap - Les activités et leurs stories</h1>
    </div>

    <div class="flex flex-col px-8 m-4">
        <p class="bg-white text-center text-l p-4">Dans cette deuxième étape vous allez lier des stories avec des activités</p>
        <div class="my-4 mx-2">
            <form method="post" action="/storymap/activite/create">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <?php $i = 0 ?>
                <?php foreach ($roles as $role) : ?>
                    <div class="flex justify-center">
                        <div class="bg-white w-2/3 p-10 mb-5">
                            <p class="text-2xl text-center"><?= ucfirst($role->role) ?></p>
                            <?php foreach ($activites[$i] as $activite) : ?>
                                <p class="text-l underline my-4"><?= ucfirst($activite->activite) ?> : </p>
                                <div class="mb-6">
                                    <div class="mb-4">
                                        <div class="flex flex-row">
                                            <p class="block text-grey-darker text-sm font-bold mb-2 mr-3 pt-2">Story1</p>
                                            <input name="<?= $role->idbut . '_' . $activite->idactivite . '_1' ?>"
                                                   class="w-1/2 border border-black shadow rounded py-2 px-3 text-grey-darker"
                                                   type="text">
                                            <select name="<?= $role->idbut . '_' . $activite->idactivite . 'priorite_1' ?>"
                                                                       class="rounded border border-gray-400 mx-2"
                                            >
                                                <option value="0">--Priorité--</option>
                                                <?php for ($option = 0; $option <= 10; $option++) : ?>
                                                    <option value="<?= $option ?>"><?= $option ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex flex-row">
                                            <p class="block text-grey-darker text-sm font-bold mb-2 mr-3 pt-2">Story2</p>
                                            <input name="<?= $role->idbut . '_' . $activite->idactivite . '_2' ?>"
                                                   class="w-1/2 border border-black shadow rounded py-2 px-3 text-grey-darker"
                                                   type="text">
                                            <select name="<?= $role->idbut . '_' . $activite->idactivite . 'priorite_2' ?>"
                                                    class="rounded border border-gray-400 mx-2"
                                            >
                                                <option value="0">--Priorité--</option>
                                                <?php for ($option = 0; $option <= 10; $option++) : ?>
                                                    <option value="<?= $option ?>"><?= $option ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex flex-row">
                                            <p class="block text-grey-darker text-sm font-bold mb-2 mr-3 pt-2">Story3</p>
                                            <input name="<?= $role->idbut . '_' . $activite->idactivite . '_3' ?>"
                                                   class="w-1/2 border border-black shadow rounded py-2 px-3 text-grey-darker"
                                                   type="text">
                                            <select name="<?= $role->idbut . '_' . $activite->idactivite . 'priorite_3' ?>"
                                                    class="rounded border border-gray-400 mx-2"
                                            >
                                                <option value="0">--Priorité--</option>
                                                <?php for ($option = 0; $option <= 10; $option++) : ?>
                                                    <option value="<?= $option ?>"><?= $option ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php $i++ ?>
                <?php endforeach; ?>
            <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600 float-right">Créer</button>
            </form>
        </div>
    </div>
</div>
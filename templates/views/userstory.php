<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">User Story</h1>
    </div>

    <div class="w-full px-8">
        <form method="post" class="p-4 w-full" action="/userstory/add/<?= $projectId ?>">
            <input type="hidden" name="idProjet" value="<?= $projectId ?>">
            <div class="flex flex-row">
                <div class="flex flex-col w-1/2 bg-white rounded p-2 mr-4">
                    <h3 class="text-center underline text-xl">Expression du besoin</h3>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="entantque">
                            En tant que :
                        </label>
                        <select name="entantque"
                                id="entantque"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker">
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role->role ?>"><?= $role->role ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="jeveux">
                            Je veux :
                        </label>
                        <input name="jeveux"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                               id="jeveux" type="text">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="desorte">
                            De sorte que :
                        </label>
                        <input name="desorte"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                               id="desorte" type="text">
                    </div>
                </div>
                <div class="flex flex-col w-1/2  bg-white rounded p-2">
                    <h3 class="text-center underline text-xl">Crit??res de satisfaction</h3>
                    <div class="mb-6">
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="critere1">Crit??re
                                1:</label>
                            <input name="critere1" class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                   id="critere1" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="critere2">Crit??re
                                2:</label>
                            <input name="critere2" class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                   id="critere2" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="critere3">Crit??re
                                3:</label>
                            <input name="critere3" class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                   id="critere3" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type='submit'
                        class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                    G??n??rer
                </button>
            </div>
        </form>

        <?php if (isset($userstories)) : ?>
            <?php $nbUs = 1 ?>
            <?php for ($i = 0; $i < count($userstories); $i+=3) : ?>
                <div class="mt-10 bg-white rounded">
                    <h3 class="text-center underline text-xl">Us - <?= $nbUs ?> </h3>
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
                <div class="flex flex-row justify-end">
                    <form method="post" action="/userstory/change">
                        <input type="hidden" name="idProjet" value="<?= $projectId ?>">
                        <input type="hidden" name="idus" value="<?= $userstories[$i]->idus ?>">
                        <button class="bg-yellow-700 rounded border-2 border-yellow-800 py-2 px-5 mr-4 text-white text-semi-bold hover:underline hover:bg-yellow-600">
                            Modifier
                        </button>
                    </form>
                    <form method="post" action="/delete/userstory">
                        <input type="hidden" name="idProjet" value="<?= $projectId ?>">
                        <input type="hidden" name="idus" value="<?= $userstories[$i]->idus ?>">
                        <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                            Supprimer la user story
                        </button>
                    </form>
                </div>
                <?php $nbUs++?>
            <?php endfor; ?>
        <?php endif; ?>

        <div class="flex flex-row justify-around mt-4">
            <a href="/personna/<?= $projectId ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold
               hover:underline hover:bg-blue-600">Pr??c??dent</a>
            <a href="/download/userstory/<?= $projectId ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold
               hover:underline hover:bg-blue-600">T??l??charger</a>
            <a href="/storymap/role/<?= $projectId ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold
               hover:underline hover:bg-blue-600">Suivant</a>
        </div>

    </div>
</div>

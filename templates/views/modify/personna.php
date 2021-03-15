<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">Personna</h1>
    </div>

    <div class="flex flex-col w-full px-8">
        <div class="my-4 mx-2">
            <form method="post" action="/personna/update">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <input type="hidden" name="personnaId" value="<?= isset($personna) ? $personna->idpersonna : '' ?>">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-around w-1/2 bg-white p-4 mb-4 mr-4">
                        <h3 class="text-center underline text-xl">Identité</h3>
                        <label class="text-grey-darker text-sm font-bold mb-2" for="usname">
                            Nom :
                        </label>
                        <input name="name"
                               value="<?= $personna->nom ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="usname" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="usname">
                            Prénom :
                        </label>
                        <input name="firstname"
                               value="<?= $personna->prenom ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="usname" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="entantque">
                            Age :
                        </label>
                        <input name="age"
                               value="<?= $personna->age ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="entantque" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="jeveux">
                            Profession :
                        </label>
                        <input name="role"
                               value="<?= $personna->role ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="jeveux" type="text">
                    </div>
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4">
                        <label for="description" class="text-center underline text-xl">Description</label>
                        <textarea name="description" class="border rounded w-full py-2 px-3 text-grey-darker"
                                  id="usname" maxlength="300"
                                  rows="9" cols="33"><?= $personna->caractéristiques ?>
                        </textarea>
                    </div>
                </div>
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4 mr-4">
                        <label for="objectifs" class="text-center underline text-xl mb-2">Objectifs</label>
                        <textarea name="objectifs" class="border rounded w-full py-2 px-3 text-grey-darker"
                                  maxlength="300" rows="5"
                                  cols="33" id="usname"><?= $personna->objectif ?>
                        </textarea>
                    </div>
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4">
                        <label for="scenarios" class="text-center underline text-xl mb-2">Scénario</label>
                        <input name="scenario" type="text"
                               value="<?= $personna->scénario ?>"
                               class="border border-red rounded w-full py-2 px-3 text-grey-darker"
                               id="scenarios">
                    </div>
                </div>
                <div class="flex justify-center">
                    <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">Personna</h1>
    </div>

    <div class="flex flex-col w-full px-8">
        <div class="my-4 mx-2">
            <form method="post" action="/personna/add/<?= $projectId ?>">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-around w-1/2 bg-white p-4 mb-4 mr-4">
                        <h3 class="text-center underline text-xl">Identité</h3>
                        <label class="text-grey-darker text-sm font-bold mb-2" for="usname">
                            Nom :
                        </label>
                        <input name="name"
                               value="<?= isset($change) ? $personnas[$change]->nom : '' ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="usname" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="usname">
                            Prénom :
                        </label>
                        <input name="firstname"
                               value="<?= isset($change) ? $personnas[$change]->prenom : '' ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="usname" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="entantque">
                            Age :
                        </label>
                        <input name="age"
                               value="<?= isset($change) ? $personnas[$change]->age : '' ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="entantque" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="jeveux">
                            Profession :
                        </label>
                        <input name="role"
                               value="<?= isset($change) ? $personnas[$change]->role : '' ?>"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="jeveux" type="text">
                    </div>
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4">
                        <label for="description" class="text-center underline text-xl">Description</label>
                        <textarea name="description" class="border rounded w-full py-2 px-3 text-grey-darker"
                                  id="usname" maxlength="300"
                                  rows="9"
                                  cols="33"><?= isset($change) ? $personnas[$change]->caractéristiques : '' ?></textarea>
                    </div>
                </div>
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4 mr-4">
                        <label for="objectifs" class="text-center underline text-xl mb-2">Objectifs</label>
                        <textarea name="objectifs" class="border rounded w-full py-2 px-3 text-grey-darker"
                                  maxlength="300" rows="5"
                                  cols="33"
                                  id="usname"><?= isset($change) ? $personnas[$change]->objectif : '' ?></textarea>
                    </div>
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4">
                        <label for="scenarios" class="text-center underline text-xl mb-2">Scénario</label>
                        <input name="scenario" type="text"
                               value="<?= isset($change) ? $personnas[$change]->scénario : '' ?>"
                               class="border border-red rounded w-full py-2 px-3 text-grey-darker"
                               id="scenarios">
                    </div>
                </div>
                <div class="flex justify-center">
                    <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                        Générer
                    </button>
                </div>
            </form>
        </div>

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
                <div class="flex flex-row justify-end">
                    <form method="post" action="/personna/change">
                        <input type="hidden" name="idProjet" value="<?= $projectId ?>">
                        <input type="hidden" name="idPersonna" value="<?= $personna->idpersonna ?>">
                        <button class="bg-yellow-700 rounded border-2 border-yellow-800 py-2 px-5 mr-4 text-white text-semi-bold hover:underline hover:bg-yellow-600">
                            Modifier
                        </button>
                    </form>
                    <form method="post" action="/delete/personna">
                        <input type="hidden" name="idProjet" value="<?= $projectId ?>">
                        <input type="hidden" name="id" value="<?= $personna->idpersonna ?>">
                        <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                            Supprimer le projet
                        </button>
                    </form>
                </div>
                <?php $i++ ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="flex flew-row justify-around mb-4">
            <a href="/download"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                Télécharger
            </a>
            <a href="/userstory"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                Suivant
            </a>
        </div>
    </div>
</div>
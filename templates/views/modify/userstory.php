<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">User Story</h1>
    </div>

    <div class="w-full px-8">
        <form method="post" class="p-4 w-full" action="/userstory/update">
            <input type="hidden" name="projectId" value="<?= $projectId ?>">
            <input type="hidden" name="userstoryId" value="<?= isset($us) ? $us->idus : '' ?>">
            <div class="flex flex-row">
                <div class="flex flex-col w-1/2 bg-white rounded p-2 mr-4">
                    <h3 class="text-center underline text-xl">Expression du besoin</h3>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="entantque">
                            En tant que :
                        </label>
                        <input name="entantque"
                               value="<?= $us->entantque ?>"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                               id="entantque" type="text">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="jeveux">
                            Je veux :
                        </label>
                        <input name="jeveux"
                               value="<?= $us->jeveux ?>"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                               id="jeveux" type="text">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="desorte">
                            De sorte que :
                        </label>
                        <input name="desorte"
                               value="<?= $us->desorte ?>"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                               id="desorte" type="text">
                    </div>
                </div>
                <div class="flex flex-col w-1/2  bg-white rounded p-2">
                    <h3 class="text-center underline text-xl">Critères de satisfaction</h3>
                    <div class="mb-6">
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="critere1">Critère
                                1:</label>
                            <input name="critere1"
                                   value="<?= $us->critere1 ?>"
                                   class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                   id="critere1" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="critere2">Critère
                                2:</label>
                            <input name="critere2"
                                   value="<?= $us->critere2 ?>"
                                   class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                   id="critere2" type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="critere3">Critère
                                3:</label>
                            <input name="critere3"
                                   value="<?= $us->critere3 ?>"
                                   class="border shadow rounded w-full py-2 px-3 text-grey-darker"
                                   id="critere3" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type='submit'
                        class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</div>

<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">Personna</h1>
    </div>

    <div class="flex flex-col w-full px-8">
        <div class="my-4 mx-2">
            <form method="post">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-around w-1/2 bg-white p-4 mb-4 mr-4">
                        <h3 class="text-center underline text-xl">Identité</h3>
                        <label class="text-grey-darker text-sm font-bold mb-2" for="usname">
                            Nom :
                        </label>
                        <input name="name"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="usname" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="usname">
                            Prénom :
                        </label>
                        <input name="firstname"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="usname" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="entantque">
                            Age :
                        </label>
                        <input name="entantque"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="entantque" type="text">
                        <label class="text-grey-darker text-sm font-bold mb-2" for="jeveux">
                            Profession :
                        </label>
                        <input name="jeveux"
                               class="border rounded py-2 px-3 text-grey-darker"
                               id="jeveux" type="text">
                    </div>
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4">
                        <label for="description" class="text-center underline text-xl">Description</label>
                        <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usname" maxlength="300"
                                  rows="9" cols="33"></textarea>
                    </div>
                </div>
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4 mr-4">
                        <label for="objectifs" class="text-center underline text-xl mb-2">Objectifs</label>
                        <textarea class="border rounded w-full py-2 px-3 text-grey-darker" maxlength="300" rows="5"
                                  cols="33" id="usname"></textarea>
                    </div>
                    <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4">
                        <label for="scenarios" class="text-center underline text-xl mb-2">Scénarios</label>
                        <textarea class="border border-red rounded w-full py-2 px-3 text-grey-darker" maxlength="300"
                                  rows="5" cols="33"></textarea>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                        Générer
                    </button>
                </div>
            </form>
        </div>

        <div class="w-full bg-white rounded mb-4 p-4">
            <h3 class="text-center underline text-xl">Identité</h3>
            <p class="p-2">Nom :</p>
            <p class="p-2">Prénom :</p>
            <p class="p-2">Age :</p>
            <p class="p-2">Profession :</p>
            <p class="p-2">Situation familiale :</p>
        </div>
        <div class="bg-white rounded mb-4 p-4">
            <h3 class="text-center underline text-xl">Description</h3>
        </div>
        <div class="bg-white rounded mb-4 p-4">
            <h3 class="text-center underline text-xl">Objectifs</h3>
        </div>
        <div class="bg-white rounded mb-4 p-4">
            <h3 class="text-center underline text-xl">Scénarios</h3>
        </div>

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
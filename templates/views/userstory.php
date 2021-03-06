<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">User Story</h1>
    </div>

    <div class="w-full px-8 h-screen">
        <div class="mt-10 mx-2 w-full h-1/2 mb-20">
            <div class="bg-white rounded float-left w-5/12">
                <h3 class="text-center underline text-xl">Expression du besoin</h3>
                <form method="post" class="p-4">
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="entantque">
                            En tant que :
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="entantque" type="text">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="jeveux">
                            Je veux :
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="jeveux" type="text">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="desorte">
                            De sorte que :
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="desorte" type="text">
                    </div>
                </form>
            </div>
            <div class="bg-white rounded mt-10 float-right w-5/12">
                <h3 class="text-center underline text-xl">Critères de satisfaction</h3>
                <form method="post" class="p-4">
                    <div class="mb-6">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="satisfait">
                            Je suis satisfait si :
                        </label>
                        <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker" id="satisfait" type="text">
                    </div>
                    <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                            Ajouter
                    </button>
                </form>
            </div>
            <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600 relative top-full left-16">
                            Générer
            </button>
        </div>
        <div class="mt-10 mx-2 w-full bg-white rounded">
            <h3 class="text-center underline text-xl">Us-00X - Nom</h3>
            <p class="p-2">
                    En tant que
                </p>
                <p class="p-2">
                    Je veux :
                </p>
                <p class="p-2">
                    De sorte que :
                </p>
                <p class="p-2">
                    Je suis satisfait si :
                </p>
        </div>
        <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600 float-right ml-10 mt-4">
                            Suivant
        </button>
        <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600 float-right mt-4">
                            Télécharger
        </button>
    </div>
</div>
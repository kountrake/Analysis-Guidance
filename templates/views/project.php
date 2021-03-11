<div class="w-full">

    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">Projet n° <?= $id ?></h1>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h2 class="text-center text-2xl font-bold underline">Personna</h2>
    </div>

    <div class="flex flex-col w-full px-8">
        <div class="my-4 mx-2">
            <div class="flex flex-col items-center">
                <div class="flex flex-col justify-around w-full bg-white p-4 mb-4">
                    <h3 class="text-center underline text-xl">Identité</h3>
                    <p class="text-grey-darker text-sm font-bold mb-2">
                        Nom :
                    </p>
                    <p class="text-grey-darker text-sm font-bold mb-2">
                        Prénom :
                    </p>
                    <p class="text-grey-darker text-sm font-bold mb-2">
                        Age :
                    </p>
                    <p class="text-grey-darker text-sm font-bold mb-2">
                        Profession :
                    </p>
                </div>
                <div class="flex flex-col justify-around w-full bg-white mb-4 p-4">
                    <h3 class="text-center underline text-xl">Description</h3>
                    <p>La description ...</p>
                </div>
            </div>
            <div class="flex flex-row justify-between">
                <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4 mr-4">
                    <h3 class="text-center underline text-xl">Objectifs</h3>
                    <p>Les Objectifs ...</p>
                </div>
                <div class="flex flex-col justify-around w-1/2 bg-white mb-4 p-4">
                    <h3 class="text-center underline text-xl">Scénario</h3>
                    <p>Le scénario ...</p>
                </div>
            </div>
            <div class="flex justify-end">
                <a href="/personna/<?= $id ?>"
                   class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Modifier</a>
            </div>
        </div>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-4">
        <h2 class="text-center text-2xl font-bold underline">User Story</h2>
    </div>

    <div class="mx-10">
        <div class="bg-white rounded mb-4">
            <h3 class="text-center underline text-xl">Us-00X</h3>
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
        <div class="flex justify-end">
            <a href="/userstory/<?= $id ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Modifier</a>
        </div>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-4">
        <h2 class="text-center text-2xl font-bold underline">Story Map</h2>
    </div>
    <div class="mx-10">
        <div class="bg-white rounded mb-4">
            La superbe story map
        </div>
        <div class="flex justify-end">
            <a href="/storymap/<?= $id ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Modifier</a>
        </div>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-4">
        <h2 class="text-center text-2xl font-bold underline">Matrice</h2>
    </div>
    <div class="mx-10">
        <div class="bg-white rounded mb-4">
            La superbe matrice
        </div>
        <div class="flex justify-end">
            <a href="/matrice/<?= $id ?>"
               class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Modifier</a>
        </div>
    </div>

    <div class="flex justify-around bg-white w-full mt-10 p-4 mb-4">
        <form method="post" action="/myprojects/delete">
            <input type="hidden" name="id" value="<?= 1 //$project->getId()  ?>">
            <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                Supprimer le projet
            </button>
        </form>
        <a href="/download/project/<?= $id ?>"
           class="block bg-gray-700 rounded border-2 border-gray-800 p-2 text-white text-semi-bold hover:underline hover:bg-gray-600">Télécharger
            le projet</a>
        <a href="/myprojects"
           class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">Retour
            à mes projets</a>
    </div>
</div>
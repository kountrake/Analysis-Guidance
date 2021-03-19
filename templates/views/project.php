<div class="w-full">

    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">Projet</h1>
    </div>

    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h2 class="text-center text-2xl font-bold underline">Personna</h2>
    </div>

    <div class="flex flex-col w-full px-8">
        <div class="my-4 mx-2">
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
                    <?php $i++ ?>
                <?php endforeach; ?>
            <?php endif; ?>
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
        <?php if (isset($userstories)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($userstories as $userstory) : ?>
                <div class="mt-10 bg-white rounded">
                    <h3 class="text-center underline text-xl">Us - <?= $i ?> </h3>
                    <p class="p-2">
                        En tant que : <?= $userstory->entantque ?>
                    </p>
                    <p class="p-2">
                        Je veux : <?= $userstory->jeveux ?>
                    </p>
                    <p class="p-2">
                        De sorte que : <?= $userstory->desorte ?>
                    </p>
                    <p class="p-2">
                        Je suis satisfait si :
                    </p>
                    <ul>
                        <li><?= $userstory->critere1 ?></li>
                        <li><?= $userstory->critere2 ?></li>
                        <li><?= $userstory->critere3 ?></li>
                    </ul>
                </div>
                <?php $i++ ?>
            <?php endforeach; ?>
        <?php endif; ?>
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
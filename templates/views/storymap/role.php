<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">StoryMap - rôles et activités</h1>
    </div>

    <div class="flex flex-col px-8 mt-4 bg-white ml-4 mr-4">
        <div class="pt-4">
            <p class="text-center text-xl">Dans cette partie vous allez lier des rôles avec des activités</p>
        </div>
        <div class="my-4 mx-2">
            <form method="post" action="/storymap/role/create" class="mt-4 ml-auto mr-auto text-center">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <?php foreach ($roles as $role) : ?>
                    <p><?= $role->entantque ?> : </p>
                    <?php foreach ($jeveux as $jv) : ?>
                        <input class="ml-4 mr-1" type="checkbox" name="<?= $role->entantque ?>[]" value="<?= $jv->jeveux ?>"><?= $jv->jeveux ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600 float-right">Créer</button>
            </form>
        </div>
    </div>
</div>
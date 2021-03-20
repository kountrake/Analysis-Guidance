<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">StoryMap - rôles et activités</h1>
    </div>

    <div class="flex flex-col w-full px-8">
        <div>
            <p>Dans cette partie vous allez lier des rôles avec des activités</p>
        </div>
        <div class="my-4 mx-2">
            <form method="post" action="/storymap/role/create">
                <input type="hidden" name="projectId" value="<?= $projectId ?>">
                <?php foreach ($roles as $role) : ?>
                    <p><?= $role->entantque ?> : </p>
                    <?php foreach ($jeveux as $jv) : ?>
                        <input type="checkbox" name="<?= $role->entantque ?>[]" value="<?= $jv->jeveux ?>"><?= $jv->jeveux ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <button>Créer</button>
            </form>
        </div>
    </div>
</div>
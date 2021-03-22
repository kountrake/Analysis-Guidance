<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">Matrice - étapes et exigences</h1>
    </div>

    <div class="flex flex-col px-8 mt-4 bg-white ml-4 mr-4">
        <div class="pt-4">
            <p class="text-center text-xl">Dans cette partie vous allez lier des étapes et des exigences</p>
        </div>
        <div class="my-4 mx-2 ">
            <form method="post" action="/matrice/correspond/create" class="mt-4 ml-auto mr-auto text-center">
                <div class="m-4 p-4 border border-gray-500 rounded-lg">
                    <input type="hidden" name="projectId" value="<?= $projectId ?>">
                    <?php foreach ($couverture as $etape => $exigences) : ?>
                        <p class="mb-2" ><?= $etape ?> : </p>
                        <?php foreach ($exigences as $exigence) : ?>
                            <input class="ml-4 mr-2 mb-5" type="checkbox" name="<?= str_replace(' ', '',$etape) ?>[]" value="<?= $exigence ?>"><?= $exigence ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600 float-right">Créer</button>
            </form>
        </div>
    </div>
</div>
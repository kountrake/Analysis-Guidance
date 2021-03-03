<?php

if (isset($prev)) {
    $email = $prev;
} else {
    $email = '';
}

?>

<?php if (isset($error)) : ?>
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <div class="w-full bg-red-600 p-2 border rounded border-red-800">
            <p class="text-white text-center"><?= $error ?></p>
        </div>
    </div>
<?php endif; ?>

<div class="flex justify-center w-full">
    <form class="bg-white w-2/3 mt-10 p-4 rounded" method="post">
        <h1 class="text-center text-4xl font-bold underline mb-20">Connexion</h1>
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input required name="email" value="<?= $email ?>"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                   id="email" type="text" placeholder="email@domaine.fr">
        </div>
        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Mot de passe
            </label>
            <input required name="password"
                   class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                   id="password" type="password" placeholder="******************">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                    class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold
                        hover:underline hover:bg-blue-600">
                Se connecter
            </button>
            <a class="inline-block align-baseline text-sm text-gray-400 hover:underline" href="#">
                Mot de passe oublié?
            </a>
        </div>
    </form>
</div>
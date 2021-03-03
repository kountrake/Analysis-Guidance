<?php

if (isset($prevEmail)) {
    $email = $prevEmail;
} else {
    $email = '';
}

if (isset($prevNom)) {
    $nom = $prevNom;
} else {
    $nom = '';
}

if (isset($prevPrenom)) {
    $prenom = $prevPrenom;
} else {
    $prenom = '';
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
    <form class="bg-white w-2/3 mt-10 p-4" method="post">
        <h1 class="text-center text-4xl font-bold underline mb-20">Inscription</h1>
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="lastname">
                Nom
            </label>
            <input required name="lastname" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="lastname" type="text" placeholder="Doe" value="<?= $nom ?>">
        </div>
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="firstname">
                Prénom
            </label>
            <input required name="firstname" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="firstname" type="text" placeholder="John" value="<?= $prenom ?>">
        </div>
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input required name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" type="text" placeholder="email@domaine.fr" value="<?= $email ?>">
        </div>
        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Mot de passe
            </label>
            <input required name="password" class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker" id="password" type="password" placeholder="******************">
        </div>
        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password_confirm">
                Confirmation du mot de passe
            </label>
            <input required name="password_confirm" class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password_confirm" type="password" placeholder="Confirmez votre mot de passe">
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                S'inscrire
            </button>
        </div>

    </form>
</div>
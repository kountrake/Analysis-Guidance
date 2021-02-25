<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 ">
        <h1 class="text-center text-4xl font-bold underline">MON PROFIL</h1>
    </div>

    <div class="flex justify-center w-full px-8 ">
        <div class="mt-10 mx-2 w-1/2">
            <div class="bg-white rounded">
                <h3 class="text-center underline text-xl">Mes informations</h3>
                <form method="post" class="p-4" action="/dashboard/update/info">
                    <input type="hidden" name="id" value="<?= $auth->getId()?>">
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="lastname">
                            Nom
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="lastname" id="lastname" type="text" value="<?= $auth->getLastname() ?>" placeholder="Doe">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="firstname">
                            Prénom
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="firstname" id="firstname" type="text" value="<?= $auth->getFirstname() ?>" placeholder="John">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="email" id="email" type="text" value="<?= $auth->getEmail() ?>" placeholder="email@domaine.fr">
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                            Modifier
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-white rounded mt-10">
                <h3 class="text-center underline text-xl">Modifications</h3>
                <form method="post" class="p-4" action="/dashboard/update/password">
                    <input type="hidden" name="id" value="<?= $auth->getId()?>">
                    <div class="mb-6">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="previous_password">
                            Ancien mot de passe
                        </label>
                        <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker" name="previous" id="previous_password" type="password" placeholder="******************">
                    </div>
                    <div class="mb-6">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="new_password">
                            Nouveau mot de passe
                        </label>
                        <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                               name="new" id="new_password" type="password" placeholder="Nouveau mot de passe">
                    </div>
                    <div class="mb-6">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="password_confirm">
                            Confirmation du mot de passe
                        </label>
                        <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                               name="confirm" id="password_confirm" type="password"
                               placeholder="Confirmez votre nouveau mot de passe">
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                            Modifier
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex items-center justify-center my-4">
                <form method="post" action="/dashboard/delete/account">
                    <input type="hidden" name="id" value="<?= $auth->getId() ?>">
                    <button class="bg-red-700 rounded border-2 border-red-800 py-2 px-5  text-white text-semi-bold hover:underline hover:bg-red-600">
                        Supprimer mon compte
                    </button>
                </form>
            </div>
        </div>
        <div class="mt-10 mx-2 w-1/2 bg-white rounded">
            <h3 class="text-center underline text-xl">Mes projets</h3>
        </div>
    </div>
</div>
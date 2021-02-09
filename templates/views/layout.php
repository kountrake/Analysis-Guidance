<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/tailwind.css">
    <title>Projet</title>
</head>
<body class="bg-gray-200">

<header class="flex flex-row justify-between px-20 bg-yellow-500">
    <ul class="flex flex-row">
        <li class="p-4"><a href="/">Accueil</a></li>
    </ul>
    <?php if ($auth) : ?>
        <ul class="flex flex-row">
            <li class="p-4"><a href="/dashboard">Mon compte</a></li>
            <li class="p-4">
                <form action="/logout" method="post">
                    <button type="submit" >Déconnexion</button>
                </form>
            </li>
        </ul>
    <?php else : ?>
        <ul class="flex flex-row">
            <li class="p-4"><a href="/login">Connexion</a></li>
            <li class="p-4"><a href="/register">Inscription</a></li>
        </ul>
    <?php endif; ?>
</header>
    <?= $content ?>
</body>
</html>

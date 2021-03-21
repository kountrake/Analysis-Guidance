<div class="w-full">
    <div class="flex justify-center bg-white w-full my-10 p-4">
        <h1 class="text-center text-4xl font-bold underline">Score</h1>
    </div>

    <div class="flex justify-center mb-4">
        <div class="w-2/3 bg-white rounded py-10 px-20">
            <p class="p-2">
                Persona : <?php if (isset($projectId->score_moyen_personna))
                                    print_r($projectId->score_moyen_personna);
                                else
                                    print_r('0');?>/5
            </p>
            <p class="p-2">
                User Story : <?php if (isset($projectId->score_moyen_userstory))
                                    print_r($projectId->score_moyen_userstory);
                                else
                                    print_r('0');?>/5
            </p>
            <p class="p-2">
                StoryMap : <?php if (isset($projectId->score_storymap))
                                    print_r($projectId->score_storymap);
                                else
                                    print_r('0');?>/5
            </p>
            <p class="p-2">
                Matrice : <?php if (isset($projectId->score_matrice))
                                    print_r($projectId->score_matrice);
                                else
                                    print_r('0');?>/5
            </p>
            <p class="p-2 text-center text-xl">
                Score final : <?php if (isset($projectId->score))
                                    print_r($projectId->score);
                                else
                                    print_r('0');?>/20
            </p>
        </div>
    </div>

    <div class="flex items-center justify-around pt-2">
        <a href="/matrice"
           class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
            Précédent
        </a>
        <a href="/myprojects"
           class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
            Fin du projet
        </a>
    </div>

</div>
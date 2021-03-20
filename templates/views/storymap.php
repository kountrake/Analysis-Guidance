<div class="w-full">
    <div class="flex justify-center bg-white w-full mt-10 p-4 mb-12">
        <h1 class="text-center text-4xl font-bold underline">Story Map</h1>
    </div>

    <div class="flex flex-col w-full px-8 pr-40 bg-white">
        <form method="post" action="/storymap/<?=isset($storymap)?'update':'create' ?>">>
            <p class="relative left-full top-40 ml-20">Thèmes</p>
            <p class="relative left-full top-96 ml-20">Epics</p>
            <div class="my-4 mx-2 mb-0 w-full border-l-2 border-t-2 border-black pt-2 pl-2">
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="theme1">
                        <?php if (isset($userstories)) : ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="<?= $userstory->idus ?>"><?= $userstory->entantque ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="theme2">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->entantque ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="theme3">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->entantque ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="theme4">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->entantque ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="theme5">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->entantque ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="theme6">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->entantque ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="my-4 mx-2 mb-0 mt-0 w-full border-l-2 border-black pt-2 pl-2 border-t-2">
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="epic1">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value=""><?= $userstory->jeveux ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="epic2">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->jeveux ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="epic3">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->jeveux ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="epic4">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->jeveux ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="epic5">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->jeveux ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48 border-grey border-solid border-2">
                    <select id="monSelect" name="epic6">
                        <?php if (isset($userstories)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($userstories as $userstory) : ?>
                                <option value="valeur1"><?= $userstory->jeveux ?></option>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="my-4 mx-2 mt-0 mb-0 w-full border-l-2 border-black border-t-2">
                <p class="relative left-full top-56 ml-20">V1</p>


                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story1"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story2"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story3"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story4"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story5"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story6"></textarea>
                </div>
            </div>
            <div class="my-4 mx-2 mt-0 mb-12 w-full border-l-2 border-black">


                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story7"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story8"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story9"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story10"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story11"></textarea>
                </div>
                <div class="flex flex-col justify-around w-1/6 bg-white mb-4 p-4 float-left h-48">

                    <textarea class="border rounded w-full py-2 px-3 text-grey-darker" id="usstory" maxlength="300"
                              rows="9" cols="33" name="story12"></textarea>
                </div>
            </div>
            <div class="flex flew-row justify-around mb-4">
                <a href="/userstory"
                class="block bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                    Précédent
                </a>
                <a href="/download"
                class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                    Télécharger
                </a>
                <a href="/matrice"
                   class="bg-blue-700 rounded border-2 border-blue-800 p-2 text-white text-semi-bold hover:underline hover:bg-blue-600">
                    Suivant
                </a>
            </div>
        </form>

    </div>
</div>
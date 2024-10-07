<form class="w-full h-full flex">
    <div class="w-full h-full p-5">
        <div class="w-full h-5/6 max-w-screen-xl flex flex-col md:flex-row mx-auto z-0">
            <div class="p-2 h-3/5 md:h-full md:w-1/2 z-10">
                <div id="story-content"
                    class="p-2 h-full w-full flex flex-col justify-stretch border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg overflow-y-auto items-center">
                    <h1
                        class="py-2 text-lg font-bold text-center text-primary-500 dark:text-orange-500 md:text-2xl md:mt-2 md:mb-8">
                        Crea il tuo personaggio
                    </h1>
                    <div
                        class="flex flex-row items-center overflow-y-auto border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg md:flex-col md:w-1/2 md:items-center">
                        <img src="" class="object-cover h-full border-1 border-transparent rounded-lg ">
                    </div>
                    <div id="story-options" class="pt-4 flex flex-row justify-center">
                        <label for="nome"
                            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white mb-3 md:text-sm">Nome
                            Personaggio</label>
                        <input type="text" name="nome" id="nome"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div>
                </div>
            </div>
            <div class="flex flex-row h-3/6 md:h-full md:flex-col md:w-1/2 ">
                <div class="p-2 w-1/2 h-5/6 md:w-full md:h-3/6 z-10">
                    <div id="character-info"
                        class="p-2 h-full w-full border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg overflow-y-auto">
                        <h3 class="text-sm font-medium leading-6 dark:text-white text-center mb-2 md:text-2xl md:mb-4">
                            Scegli la classe</h3>

                        <ul
                            class="w-50 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white overflow-x-auto md:text-sm">
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="list-radio-[classe1]" type="radio" value="" name="list-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        checked>
                                    <label for="list-radio-[classe1]"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">[Nome
                                        classe1]</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="list-radio-[classe2]" type="radio" value="" name="list-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="list-radio-[classe2]"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">[Nome
                                        classe2]</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="list-radio-[classe3]" type="radio" value="" name="list-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="list-radio-[classe3]"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">[Nome
                                        classe3]</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="list-radio-[classe4]" type="radio" value="" name="list-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="list-radio-[classe4]"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">[Nome
                                        classe4]</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-2 w-1/2 h-5/6 md:w-full md:h-3/6 z-10">
                    <div id="caratteristiche"
                        class="p-2 h-full w-full border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg overflow-y-auto">
                        <h3 class="text-sm font-medium leading-6 dark:text-white text-center mb-2 md:text-2xl md:mb-4">
                            Caratteristiche</h3>
                        <div class="p-4 md:p-5 space-y-4">

                            <h2 class="text-xl">Punti disponibili: <span class="text-primary-500"
                                    id="available-points">{{ '2' }}</span>
                            </h2>

                            @foreach (SkillType::getOnlySkills() as $skillType)
                                @include('components.inputCounter', [
                                    'name' => $skillType->name,
                                    'min' => $config['minSkillPoints'],
                                    'max' => $config['maxSkillPoints'],
                                    'value' => 0,
                                ])
                            @endforeach

                            <script src="/static/script/editCharacter.js" defer></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="flex h-1/6 w-full md:h-1/6 md:w-full justify-center overflow-y-auto items-center md:text-center md:items-center">
            <button
                class="text-center p-1 border-gray-800 bg-orange-500 rounded-lg shadow-lg text-sm font-bold dark:text-black md:text-2xl md:p-2 md:text-center md:justify-center md:">Inizia
                la partita</button>
        </div>
    </div>
</form>

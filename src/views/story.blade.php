<div class="w-full h-full p-5">
    <div class="w-full h-full max-w-screen-xl flex flex-col md:flex-row mx-auto z-0">
        <div class="p-2 h-3/5 md:h-full md:w-1/2 z-10">
            <div id="story-content"
                class="p-2 h-full w-full flex flex-col justify-stretch border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
                <h1
                    class="py-2 text-2xl text-center text-primary-500 border-b-2 border-gray-200 dark:border-gray-800 rounded-sm">
                    {{ 'Titolo della storia' }}
                </h1>
                <span id="story-text" class="px-3 overflow-y-auto hyphens-auto flex-grow">
                    {{ 'Contenuto della storia' }}
                </span>
                <div id="story-options" class="pt-4 flex flex-row justify-center">
                    <!-- MAX 4 BUTTONS -->
                    <button type="button"
                        class="py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        {{ '1' }}
                    </button>
                    <button type="button"
                        class="py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        {{ '2' }}
                    </button>
                    <button type="button"
                        class="py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        {{ '3' }}
                    </button>
                    <button type="button"
                        class="py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        {{ '4' }}
                    </button>

                </div>
            </div>
        </div>
        <div class="flex flex-row h-2/5 md:h-full md:flex-col md:w-1/2 ">
            <div class="p-2 w-1/2 md:w-full md:h-2/6 z-10">
            <div id="character-info" class="p-2 h-full w-full md:border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-col md:flex-row">
                <!-- Immagine del personaggio -->
                <div class="w-full h-1/2 md:w-1/3">
                    <!--codice per l'immagine del personaggio -->
                    <img src="path/to/character-image.jpg" alt="Character Image" class="w-full h-full object-cover rounded-lg">
                </div>
                <!-- Informazioni del personaggio -->
                <div class="w-full h-1/2 md:w-2/3 md:pl-2 flex flex-col justify-between">
                    <!-- Nome del personaggio -->
                    <h2 class="text-xl font-bold mb-2 text-primary-500">Nome personaggio: </h2>
                    <!-- Statistiche del personaggio -->
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2">
                            <p>Forza:</p>
                            <button type="button" class="bg-orange-500 text-black px-2 rounded-full">+</button>
                        </div>
                        <div class="w-full md:w-1/2">
                            <p>Abilità:</p>
                            <button type="button" class="bg-orange-500 text-black px-2 rounded-full">+</button>
                        </div>
                        <div class="w-full md:w-1/2">
                            <p>Intelligenza:</p>
                            <button type="button" class="bg-orange-500 text-black px-2 rounded-full">+</button>
                        </div>
                        <div class="w-full md:w-1/2">
                            <p>Esperienza:</p>
                            <button type="button" class="bg-orange-500 text-black px-2 rounded-full">+</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="p-2 w-1/2 md:w-full md:h-4/6 z-10">
                <div id="inventory"
                    class="p-2 h-full w-full border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

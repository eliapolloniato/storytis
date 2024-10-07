<div class="w-full h-full">
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
            <div class="p-2 w-1/2 min-h-56 md:w-full md:h-2/6 z-10">
                <div id="character-info"
                    class="p-2 h-full w-full border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-col items-center">
                    <div class="mb-1 md:my-4 w-full flex items-center flex-row justify-between px-4">
                        <!-- Immagine del personaggio -->
                        <img src="https://placehold.co/400x400" alt="Character Image"
                            class="size-14 rounded-full object-cover">
                        <!-- Nome del personaggio -->
                        <h2 class="text-sm font-bold mb-1 text-primary-500 text-center">{{ 'nome' }}</h2>
                    </div>
                    <!-- Informazioni del personaggio -->
                    <!-- Statistiche del personaggio -->
                    <div class="px-4 w-full flex flex-col md:flex-row md:flex-wrap justify-center flex-grow">
                        <div class="w-full md:px-2 md:w-1/2">
                            <div class="flex flex-row justify-between">
                                <p>Forza:</p>
                                <span>5</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1 dark:bg-gray-700">
                                <div class="bg-primary-600 h-1.5 rounded-full dark:bg-primary-500" style="width: 20%">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:px-2 md:w-1/2">
                            <div class="flex flex-row justify-between">
                                <p>Intelligenza:</p>
                                <span>5</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1 dark:bg-gray-700">
                                <div class="bg-primary-600 h-1.5 rounded-full dark:bg-primary-500" style="width: 75%">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:px-2 md:w-1/2">
                            <div class="flex flex-row justify-between">
                                <p>Abilità:</p>
                                <span>5</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1 dark:bg-gray-700">
                                <div class="bg-primary-600 h-1.5 rounded-full dark:bg-primary-500" style="width: 35%">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:px-2 md:w-1/2">
                            <div class="flex flex-row justify-between">
                                <p>Esperienza:</p>
                                <span>5</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1 dark:bg-gray-700">
                                <div class="bg-primary-600 h-1.5 rounded-full dark:bg-primary-500" style="width: 80%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button"
                        class="py-1.5 px-3 m-1 text-sm font-medium w-full text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        Modifica
                    </button>
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

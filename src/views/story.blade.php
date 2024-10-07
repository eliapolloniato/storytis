<div class="w-full h-full p-5">
    <div class="w-full h-full max-w-screen-xl flex flex-col md:flex-row mx-auto">
        <div class="p-2 h-3/5 md:h-full md:w-1/2">
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
                        {{ 'Scelta 1' }}
                    </button>
                    <button type="button"
                        class="py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        {{ 'Scelta 2' }}
                    </button>
                    <button type="button"
                        class="py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        {{ 'Scelta 3' }}
                    </button>
                    <button type="button"
                        class="py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        {{ 'Scelta 4' }}
                    </button>

                </div>
            </div>
        </div>
        <div class="flex flex-row h-2/5 md:h-full md:flex-col md:w-1/2 ">
            <div class="p-2 w-1/2 md:w-full md:h-2/6">
                <div id="character-info"
                    class="p-2 h-full w-full border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
                </div>
            </div>
            <div class="p-2 w-1/2 md:w-full md:h-4/6">
                <div id="inventory"
                    class="p-2 h-full w-full border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

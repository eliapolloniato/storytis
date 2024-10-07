<div class="w-full h-full">
    <div class="w-full h-full max-w-screen-xl flex flex-col md:flex-row mx-auto z-0">
        <div class="p-2 h-3/5 md:h-full md:w-1/2 z-10">
            <div id="story-content"
                class="p-2 h-full w-full flex flex-col justify-stretch border border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
                <h1
                    class="py-2 text-2xl text-center text-primary-500 border-b-2 border-gray-200 dark:border-gray-800 rounded-sm">
                    {{ $chapter->getTitle() }}
                </h1>
                <span id="story-text" class="px-3 overflow-y-auto hyphens-auto flex-grow">
                    {{ $chapter->getContent() }}
                </span>
                <div id="story-options" class="pt-4 flex flex-row justify-center">
                    <!-- MAX 4 BUTTONS -->
                    @foreach ($choices as $choice)
                        @include('components.storyButton', [
                            'text' => $choice->getOptionText(),
                            'gameId' => $game->getId(),
                            'choiceId' => $choice->getId(),
                            'character' => $game->getCharacter(),
                        ])
                    @endforeach

                </div>
            </div>
        </div>
        <div class="flex flex-row h-2/5 md:h-full md:flex-col md:w-1/2 ">
            <div class="p-2 w-1/2 min-h-56 md:w-full md:h-2/5 z-10">
                <div id="character-info"
                    class="p-2 h-full w-full border border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-col items-center">
                    <div class="mb-1 md:my-4 w-full flex items-center flex-row justify-between px-4">
                        <!-- Immagine del personaggio -->
                        <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ $game->getCharacter()->getName() }}"
                            alt="Character Image" class="size-14 rounded-full object-cover">
                        <!-- Nome del personaggio -->
                        <h2 class="md:text-xl text-md font-bold mb-1 text-primary-500 text-center">
                            {{ $game->getCharacter()->getName() }}</h2>
                    </div>
                    <!-- Informazioni del personaggio -->
                    <!-- Statistiche del personaggio -->
                    <div class="px-4 w-full flex flex-col md:flex-row md:flex-wrap justify-center flex-grow">
                        @foreach ($game->getCharacter()->getSkills() as $skill)
                            <div class="w-full md:px-2 md:w-1/2">
                                <div class="flex flex-row justify-between">
                                    <span>{{ $skill->getType()->name }}</span>
                                    <span>{{ $skill->getValue() }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1 dark:bg-gray-700">
                                    <div class="bg-primary-600 h-1.5 rounded-full dark:bg-primary-500"
                                        style="width: {{ (int) (($skill->getValue() / $config['maxSkillPoints']) * 100) }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" data-modal-target="character-edit" data-modal-toggle="character-edit"
                        class="py-1.5 px-3 m-1 text-sm font-medium w-full text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700">
                        Modifica
                    </button>
                </div>
            </div>
            <div class="p-2 w-1/2 md:w-full md:h-3/5 z-10">
                <div id="inventory"
                    class="p-2 h-full w-full border border-gray-200 dark:border-gray-800 rounded-lg shadow-lg">
                    @if (count($game->getCharacter()->getInventory()) == 0)
                        <div class="w-full h-full flex justify-center items-center text-center text-gray-400">
                            <span>Non hai ancora oggetti nell'inventario</span>
                        </div>
                    @endif
                    <div class="w-full flex flex-row flex-wrap items-start">
                        @foreach ($game->getCharacter()->getInventory() as $item)
                            <div
                                class="m-2 size-10 transition hover:bg-slate-300 hover:scale-150 hover:rotate-12 dark:hover:bg-slate-600 border-gray-300 dark:border-gray-700 border rounded-md flex justify-center items-center text-center">
                                <span class="cursor-default">{{ $item->getItem()->getItemText() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Character edit modal -->
<div id="character-edit" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Modifica caratteristiche del personaggio
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="character-edit">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Chiudi</span>
                </button>
            </div>
            <!-- Modal body -->

            <div class="p-4 md:p-5 space-y-4">

                <h2 class="text-xl">Punti disponibili: <span class="text-primary-500"
                        id="available-points">{{ '2' }}</span>
                </h2>

                @include('components.inputCounter', [
                    'name' => 'Forza',
                    'min' => 0,
                    'id' => 1,
                    'max' => 10,
                    'value' => 5,
                ])

                @include('components.inputCounter', [
                    'name' => 'Intelligenza',
                    'min' => 0,
                    'id' => 2,
                    'max' => 15,
                    'value' => 5,
                ])

                <script src="/static/script/editCharacter.js" defer></script>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="character-edit" type="button"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Salva</button>
                    <button data-modal-hide="character-edit" type="button"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Annulla</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message toast -->
@isset($message)
    @include('components.messageToast', ['message' => $message])
@endisset

<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    @isset($choice)
        <h1 class="text-2xl font-bold mb-2">Modifica scelta: <span id="choiceTitle"
                class="text-2xl font-bold text-primary-500">{{ $choice->getOptionText() }}</span></h1>
    @else
        <h1 class="text-2xl font-bold mb-2">Aggiungi scelta</h1>
    @endisset

    <div class="w-full md:w-4/6 md:max-w-xl">

        @isset($chapter)
            <form method="POST" action="./edit">
            @else
                <form class="my-5" method="POST" action="./addChoice">
                @endisset
                <div>
                    <label for="optionText"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scelta</label>
                    <input type="text" id="optionText" name="optionText"
                        class="me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Titolo" value="{{ isset($choice) ? $choice->getOptionText() : '' }}" required>
                </div>
                <div class="my-5">
                    <label for="nextChapter"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capitolo
                        successivo</label>
                    <select id="nextChapter"
                        class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                        <option selected>Capitolo successivo</option>
                        @foreach ($choice->getChapter()->getOtherChapters() as $ch)
                            <option value="{{ $ch->getId() }}">{{ $ch->getTitle() }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Salva
                </button>
            </form>
    </div>

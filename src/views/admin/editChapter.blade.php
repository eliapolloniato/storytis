<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    @isset($chapter)
        <h1 class="text-2xl font-bold mb-2">Modifica capitolo: <span id="chapterTitle"
                class="text-2xl font-bold text-primary-500">{{ $chapter->getTitle() }}</span></h1>
    @else
        <h1 class="text-2xl font-bold mb-2">Aggiungi capitolo</h1>
    @endisset

    <div class="w-full md:w-4/6 md:max-w-xl">

        @isset($chapter)
            <form method="POST" action="./edit">
            @else
                <form class="my-5" method="POST" action="./addChapter">
                @endisset
                <label for="title"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titolo</label>
                <input type="text" id="title" name="title"
                    class="me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Titolo" value="{{ isset($chapter) ? $chapter->getTitle() : '' }}">

                <div
                    class="w-full my-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <label for="content" class="sr-only">Contenuto</label>
                        <textarea id="content" rows="4" name="content"
                            class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                            placeholder="C'era una volta..." required>{{ isset($chapter) ? $chapter->getContent() : '' }}</textarea>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Salva
                        </button>
                    </div>
                </div>
            </form>

            @isset($chapter)
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                <!-- Choices -->

                <h1 class="text-xl font-bold mb-2">Scelte</h1>
                <div class="flex flex-row flex-wrap justify-around">
                    @foreach ($chapter->getChoicesWithEmpty() as $choice)
                        @include('components.choiceCard', ['choice' => $choice])
                    @endforeach
                </div>

            @endisset
    </div>

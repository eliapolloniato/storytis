<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    <form method="GET" action="">
        <label for="characterSelection"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personaggio</label>
        <select id="characterSelection" name="charId"
            class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            required>
            @foreach (User::get($_SESSION['user'])->getCharacters() as $character)
                <option value="{{ $character->getId() }}">{{ $character->getName() }}</option>
            @endforeach

        </select>

        <input type="hidden" name="storyId" value="{{ $storyId }}">

        <button type="submit"
            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
            Continua
        </button>
    </form>
</div>

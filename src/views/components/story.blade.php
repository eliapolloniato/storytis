<story>
    <div
        class="w-32 h-56 m-2 py-3 border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-col justify-between items-center">
        <div class="w-full flex flex-col items-center justify-center">
            <svg alt="book" class="size-20 fill-primary-600 dark:fill-primary-500" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 -960 960 960">
                <path
                    d="M240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h480q33 0 56.5 23.5T800-800v640q0 33-23.5 56.5T720-80H240Zm0-80h480v-640h-80v280l-100-60-100 60v-280H240v640Zm0 0v-640 640Zm200-360 100-60 100 60-100-60-100 60Z" />
            </svg>
            <h1 class="text2xl font-black uppercase mb-3 mt-1">{{ $story->getTitle() }}</h1>
        </div>
        <p>Capitoli: <span>{{ count($story->getChapters()) }}</span></p>
        <a class="flex flec-row items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
            href="{{ $config['routes']['playStory'] . $story->getId() }}">Inizia <svg
                class="fill-primary-600 dark:fill-primary-500 size-4" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 -960 960 960">
                <path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z" />
            </svg></a>

    </div>
</story>

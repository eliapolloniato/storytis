@isset($choice)
    <a class="m-2 flex flex-col items-center justify-center size-20 border-2 border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
        href="{{ $config['routes']['choice'] . $choice->getId() . '/edit' }}">
        <p>{{ $choice->getOptionText() }}</p>
    </a>
@else
    <a class="m-2 flex flex-col items-center justify-center size-20 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
        href="{{ $config['routes']['chapter'] . $chapter->getId() . '/addChoice' }}">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="size-20 fill-gray-300 dark:fill-gray-500">
                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
            </svg>
        </div>
    </a>
@endisset

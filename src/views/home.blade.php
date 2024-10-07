<div class="mt-5 w-full flex flex-col items-center">
    <h1 class="text-4xl ">Le tue storie</h1>
    <a class="my-4 flex flex-row items-center font-medium text-primary-600 dark:text-primary-500 hover:underline"
        href="{{ $config['routes']['stories'] }}">Inizia una nuova storia
        <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
    </a>
    <div id="stories" class="my-5 h-full flex flex-row px-5 md:px-0 justify-around flex-wrap">
        @foreach ($games as $game)
            @include('components.gameCard', ['game' => $game])
        @endforeach
    </div>
</div>

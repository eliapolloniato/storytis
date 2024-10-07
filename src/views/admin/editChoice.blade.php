<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    @include('components.breadcrumbs', [
        'path' => [
            [
                'title' => 'Creator',
                'url' => $config['routes']['adminCreator'],
            ],
            [
                'title' => isset($choice)
                    ? $choice->getChapter()->getStory()->getTitle()
                    : $chapter->getStory()->getTitle(),
                'url' =>
                    $config['routes']['editStory'] .
                    (isset($choice)
                        ? $choice->getChapter()->getStory()->getId()
                        : $chapter->getStory()->getId()),
            ],
            [
                'title' => isset($choice) ? $choice->getChapter()->getTitle() : $chapter->getTitle(),
                'url' =>
                    $config['routes']['chapter'] .
                    (isset($choice) ? $choice->getChapter()->getId() : $chapter->getId()) .
                    '/edit',
            ],
            [
                'title' => isset($choice) ? $choice->getOptionText() : 'Nuova scelta',
                'url' => '#',
            ],
        ],
    ])

    @isset($choice)
        <h1 class="text-2xl font-bold mb-2">Modifica scelta: <span id="choiceTitle"
                class="text-2xl font-bold text-primary-500">{{ $choice->getOptionText() }}</span></h1>
    @else
        <h1 class="text-2xl font-bold mb-2">Aggiungi scelta</h1>
    @endisset

    <div class="w-full">

        @isset($choice)
            <form method="POST" action="./edit">
            @else
                <form class="my-5" method="POST" action="./addChoice">
                @endisset
                <div>
                    <label for="optionText"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scelta</label>
                    <input type="text" id="optionText" name="optionText"
                        class="me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Scelta" value="{{ isset($choice) ? $choice->getOptionText() : '' }}" required>
                </div>
                <div class="my-5">
                    <label for="nextChapter"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capitolo
                        successivo</label>
                    <select id="nextChapter" name="nextChapter"
                        class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                        @isset($choice)
                            @if ($choice->getNextChapter() !== null)
                                <option value="{{ $choice->getNextChapter()->getId() }}" selected>
                                    {{ $choice->getNextChapter()->getTitle() }}</option>
                            @endif
                            @foreach (array_filter($choice->getChapter()->getOtherChapters(), static fn($e) => $e->getId() != ($choice->getNextChapter() !== null ? $choice->getNextChapter()->getId() : null)) as $ch)
                                <option value="{{ $ch->getId() }}">{{ $ch->getTitle() }}</option>
                            @endforeach
                        @else
                            @foreach ($chapter->getOtherChapters() as $ch)
                                <option value="{{ $ch->getId() }}">{{ $ch->getTitle() }}</option>
                            @endforeach

                        @endisset
                    </select>
                </div>

                <div class="my-5">
                    <label for="reward"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ricompensa</label>
                    <div class="flex">
                        <a class="cursor-pointer flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                            href="{{ $config['routes']['reward'] . 'add' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                                class="size-5 fill-primary-500">
                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                            </svg>
                        </a>
                        <select id="reward" name="reward"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @isset($choice)
                                @if ($choice->getReward() !== null)
                                    <option value="{{ $choice->getReward()->getId() }}">
                                        {{ '(' . $choice->getReward()->getAffectedSkillName() . ', ' . $choice->getReward()->getValue() . ') - ' . $choice->getReward()->getDescription() }}
                                    </option>
                                @else
                                    <option value="" selected>Seleziona la ricompensa</option>
                                @endif
                                @foreach (array_filter(Reward::getAll(), static fn($e) => $e->getId() != ($choice->getReward() !== null ? $choice->getReward()->getId() : null)) as $reward)
                                    <option value="{{ $reward->getId() }}">
                                        {{ '(' . $reward->getAffectedSkillName() . ', ' . $reward->getValue() . ') - ' . $reward->getDescription() }}
                                    </option>
                                @endforeach
                            @else
                                @foreach (Reward::getAll() as $reward)
                                    <option value="{{ $reward->getId() }}">
                                        {{ '(' . $reward->getAffectedSkillName() . ', ' . $reward->getValue() . ') - ' . $reward->getDescription() }}
                                    </option>
                                @endforeach

                            @endisset
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Salva
                </button>
            </form>
    </div>

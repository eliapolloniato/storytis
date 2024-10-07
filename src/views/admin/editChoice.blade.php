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
                    <label for="requiredSkillType"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caratteristica
                        necessaria</label>
                    <div class="flex flex-row">
                        <select id="requiredSkillType" name="requiredSkillType"
                            class="mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            @isset($choice)
                                @if ($choice->getNextChapter() !== null)
                                    <option value="{{ $choice->getRequiredSkillType()->value }}" selected>
                                        {{ $choice->getRequiredSkillType()->name }}</option>
                                @endif
                                @foreach (array_filter(SkillType::getOnlySkills(), static fn($e) => $e->value != ($choice->getRequiredSkillType() !== null ? $choice->getRequiredSkillType()->value : null)) as $skillType)
                                    <option value="{{ $skillType->value }}">{{ $skillType->name }}</option>
                                @endforeach
                            @else
                                <option value="" selected>Seleziona la caratteristica</option>
                                @foreach (SkillType::getOnlySkills() as $skillType)
                                    <option value="{{ $skillType->value }}">{{ $skillType->name }}</option>
                                @endforeach

                            @endisset
                        </select>
                        <div class="ml-2 max-w mx-auto">
                            <div class="relative flex items-center">
                                <button type="button" id="decrement" data-input-counter-decrement="requiredSkillLevel"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>

                                <input type="text" id="requiredSkillLevel" name="requiredSkillLevel"
                                    data-input-counter data-input-counter-min="{{ $config['minSkillPoints'] }}"
                                    data-input-counter-max="{{ $config['maxSkillPoints'] }}"
                                    aria-describedby="helper-text-explanation"
                                    class="character-input bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ isset($choice) ? $choice->getRequiredSkillLevel() : 0 }}"
                                    autocomplete="off" readonly required>

                                <button type="button" id="increment" data-input-counter-increment="requiredSkillLevel"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
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

                <div class="w-full flex justify-between">
                    <button type="submit"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Salva
                    </button>

                    @isset($choice)
                        <a href="{{ $config['routes']['choice'] . $choice->getId() . '/delete' }}"
                            class="flex items-center justify-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Elimina</a>
                    @endisset
                </div>
            </form>
    </div>

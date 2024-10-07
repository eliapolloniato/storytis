<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    @include('components.breadcrumbs', [
        'path' => [
            [
                'title' => 'Creator',
                'url' => $config['routes']['adminCreator'],
            ],
            [
                'title' => isset($reward) ? $reward->getDescription() : 'Nuova ricompensa',
                'url' => '#',
            ],
        ],
    ])

    @isset($reward)
        <h1 class="text-2xl font-bold mb-2">Modifica ricompensa: <span id="choiceTitle"
                class="text-2xl font-bold text-primary-500">{{ $reward->getDescription() }}</span></h1>
    @else
        <h1 class="text-2xl font-bold mb-2">Aggiungi ricompensa</h1>
    @endisset

    <div class="w-full">

        @isset($reward)
            <form method="POST" action="./edit">
            @else
                <form class="my-5" method="POST" action="./add">
                @endisset
                <div>
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrizione</label>
                    <input type="text" id="description" name="description"
                        class="me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Descrizione" value="{{ isset($reward) ? $reward->getDescription() : '' }}"
                        required>
                </div>
                <div class="my-5">
                    <label for="affectedSkillType"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caratteristica</label>
                    <select id="affectedSkillType" name="affectedSkillType"
                        class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required {{ $reward instanceof Item ? 'disabled' : '' }}>
                        @isset($reward)
                            @if ($reward->getAffectedSkillType() !== null)
                                <option value="{{ $reward->getAffectedSkillType()->value }}" selected>
                                    {{ $reward->getAffectedSkillType()->name }}</option>
                            @endif
                            @foreach (array_filter(SkillType::getOnlySkills(), static fn($e) => $e != ($reward->getAffectedSkillType() !== null ? $reward->getAffectedSkillType() : null)) as $skillType)
                                <option value="{{ $skillType->value }}">{{ $skillType->name }}</option>
                            @endforeach
                        @else
                            @foreach (SkillType::cases() as $skillType)
                                <option value="{{ $skillType->value }}">{{ $skillType->name }}</option>
                            @endforeach

                        @endisset
                    </select>
                </div>


                @isset($reward)
                    <div class="my-5">

                        @if ($reward instanceof Item)
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Oggetto</label>
                            <input type="text" id="item" name="item"
                                class="me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Oggetto" value="{{ isset($reward) ? $reward->getItemText() : '' }}" required>
                        @else
                            <label for="value"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valore</label>
                            <div class="relative flex items-center">
                                <button type="button" id="decrement-button" data-input-counter-decrement="value"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" id="value" name="value" data-input-counter
                                    data-input-counter-min="{{ $config['minRewardValue'] }}"
                                    data-input-counter-max="{{ $config['maxRewardValue'] }}"
                                    aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="999" value="{{ isset($reward) ? $reward->getValue() : 0 }}" required>
                                <button type="button" id="increment-button" data-input-counter-increment="value"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                @endisset

                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Salva
                </button>
            </form>
    </div>

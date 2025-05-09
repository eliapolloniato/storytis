@if ($choice->canBeChosen($character))
    <a class="flex items-center text-center justify-center py-2.5 px-5 m-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-primary-400 dark:hover:bg-gray-700"
        href="{{ $gameId . '/' . $choiceId }}">
        {{ $text }}
    </a>
@else
    <span
        class="flex items-center text-center justify-center py-2.5 px-5 m-1 text-sm font-medium text-gray-900 bg-slate-200 rounded-lg border border-gray-200  focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600"
        title="Ti servono almeno {{ getActualValue($choice->getRequiredSkillLevel(), $character->getClass(), $choice->getRequiredSkillType()) }} punti {{ $choice->getRequiredSkillType()->name }}">
        {{ $text }}
    </span>
@endif

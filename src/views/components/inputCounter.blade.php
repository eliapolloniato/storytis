<div class="max-w mx-auto">
    <label for="{{ strtolower($name) . '-input' }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span>{{ $name }}</span></label>
    <div class="relative flex items-center">
        <button type="button" id="{{ strtolower($name) . '-decrement' }}"
            data-input-counter-decrement="{{ strtolower($name) . '-input' }}"
            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 2">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h16" />
            </svg>
        </button>

        <input type="text" id="{{ strtolower($name) . '-input' }}" data-input-counter
            data-input-counter-min="{{ $min }}" data-input-counter-max="{{ $max }}"
            aria-describedby="helper-text-explanation"
            class="character-input bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            value="{{ $value }}" autocomplete="off" disabled required>

        <button type="button" id="{{ strtolower($name) . '-increment' }}"
            data-input-counter-increment="{{ strtolower($name) . '-input' }}"
            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 1v16M1 9h16" />
            </svg>
        </button>
    </div>
</div>

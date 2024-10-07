<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    <h1 class="text-2xl font-bold mb-2">Crea il tuo personaggio</h1>

    <div class="w-full">
        <form class="my-5" method="POST" action="">
            <div class="w-full flex justify-center items-center">
                <img id="avatar-img" src="" class="size-64 border-1 border-transparent rounded-lg ">
            </div>

            <label for="character-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome
                personaggio</label>
            <input type="text" id="character-name" name="characterName"
                class="me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Nome" value="" required>

            <label for="character-class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classe
                personaggio</label>
            <select id="character-class" name="characterClass"
                class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                required>

                @foreach (CharacterClass::cases() as $characterClass)
                    <option value="{{ $characterClass->value }}">{{ $characterClass->name }}</option>
                @endforeach

            </select>

            <h1 class="text-xl font-bold mb-2">Abilità</h1>

            <div class="p-4 md:p-5 space-y-4">

                <h2 class="text-lg">Punti disponibili: <span class="text-primary-500"
                        id="available-points">{{ $config['initialAvailablePoints'] }}</span>
                </h2>

                @foreach (SkillType::getOnlySkills() as $skillType)
                    @include('components.inputCounter', [
                        'name' => $skillType->name,
                        'id' => $skillType->value,
                        'min' => $config['minSkillPoints'],
                        'max' => $config['maxSkillPoints'],
                        'value' => 0,
                    ])
                @endforeach

                <script src="/static/script/editCharacter.js" defer></script>
            </div>

            <button type="submit"
                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Salva
            </button>

        </form>
    </div>
</div>

<script src="/static/script/avatarGenerator.js" defer></script>

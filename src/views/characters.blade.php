<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    <div id="characters" class="flex flex-row flex-wrap justify-around">
        @foreach ($characters as $character)
            @include('components.characterCard', ['character' => $character])
        @endforeach
        @if (count($characters) < $config['maxCharacters'])
            @include('components.characterCard', ['character' => null])
        @endif
    </div>
</div>

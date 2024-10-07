<div class="w-full h-full max-w-screen-xl flex flex-col md:flex-row mx-auto z-0">
    <div id="stories" class="flex flex-row flex-wrap">
        @foreach ($stories as $story)
            @include('components.story', ['story' => $story])
        @endforeach
    </div>
</div>

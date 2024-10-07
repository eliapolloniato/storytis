<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    <div id="stories" class="flex flex-row flex-wrap justify-around">
        @foreach ($stories as $story)
            @include('components.storyCard', ['story' => $story])
        @endforeach
        @if (User::get($_SESSION['user'])->isAdmin())
            @include('components.emptyStoryCard')
        @endif
    </div>
</div>

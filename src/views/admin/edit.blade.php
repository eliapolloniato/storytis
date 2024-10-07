<div class="mx-5 md:m-auto md:w-1/2 md:max-w-xl">
    @include('components.breadcrumbs', [
        'path' => [
            [
                'title' => 'Creator',
                'url' => $config['routes']['adminCreator'],
            ],
            [
                'title' => $story->getTitle(),
                'url' => '#',
            ],
        ],
    ])

    <h1 class="text-2xl font-bold">Modifica storia: <span id="storyTitle"
            class="text-2xl font-bold text-primary-500">{{ $story->getTitle() }}</span></h1>

    <div class="mt-5 w-full">
        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titolo</label>
            <div class="flex flex-row">
                <input type="text" id="title" name="title"
                    class="me-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Titolo" value="{{ $story->getTitle() }}">
                <button id="saveTitle"
                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Salva
                </button>
            </div>
            <script defer>
                document.getElementById('saveTitle').addEventListener('click', () => {
                    const title = document.getElementById('title').value;
                    const id = {{ $story->getId() }};

                    fetch(window.location.pathname, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                title
                            })
                        })
                        .catch(err => console.error(err))
                        .then(res => res.json())
                        .then(data => {
                            window.location.reload();
                        })
                });
            </script>
        </div>

        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

        <!-- Capitoli -->
        <div class="my-5 overflow-y-auto">
            <h1 class="text-xl font-bold">Capitoli</h1>
            @foreach ($story->getChapters() as $chapter)
                @include('components.chapterCard', ['chapter' => $chapter])
            @endforeach

            <!-- Aggiungi capitolo -->
            <div class="w-full flex flex-row justify-center">
                <a href="{{ $config['routes']['editStory'] . $story->getId() . '/addChapter' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                        class="size-8 fill-primary-600 dark:fill-primary-500">
                        <path
                            d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                    </svg>
                </a>
            </div>
        </div>

        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">



    </div>

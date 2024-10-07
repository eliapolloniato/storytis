<div class="mx-5">
    <h1 class="text-2xl font-bold">Modifica storia: <span
            class="text-2xl font-bold text-primary-500">{{ $story->getTitle() }}</span></h1>

    <div class="mt-5 w-full md:w-2/6">
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
                            console.log(data);
                        })
                });
            </script>
        </div>

        <div class="my-5 overflow-y-auto">
            <!-- Capitoli -->
            @foreach ($story->getChapters() as $chapter)
                @include('components.chapter', ['chapter' => $chapter])
            @endforeach
        </div>
    </div>
</div>

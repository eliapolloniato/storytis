<chapter>
    <div
        class="w-full my-2 py-2 px-4 border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-row justify-between items-center">
        <h1 class="text2xl font-black uppercase">{{ $chapter->getTitle() }}</h1>
        <p>Scelte: <span class="bold">{{ count($chapter->getChoices()) }}</span></p>
        <div class="flex flex-row">
            <a class="mx-1 flex flec-row items-center"
                href="{{ $config['routes']['editChapter'] . $chapter->getId() }}"><svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 -960 960 960" class="size-6 fill-primary-600 dark:fill-primary-500">
                    <path
                        d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                </svg></a>
            <a class="mx-1 flex flec-row items-center"
                href="{{ $config['routes']['deleteChapter'] . $chapter->getId() }}"><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                    class="size-6 fill-primary-600 dark:fill-primary-500">
                    <path
                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                </svg></a>
        </div>
    </div>
</chapter>

<game>
    <div
        class="w-48 h-64 m-2 py-3 border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-col justify-between items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-20 fill-primary-600 dark:fill-primary-500"
            viewBox="0 -960 960 960">
            <path
                d="M560-564v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-600q-38 0-73 9.5T560-564Zm0 220v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-380q-38 0-73 9t-67 27Zm0-110v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-490q-38 0-73 9.5T560-454ZM260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z" />
        </svg>
        <h1 class="font-black uppercase mb-3 mt-1 text-center line-clamp-2">{{ $game->getStory()->getTitle() }}</h1>

        <span class="bold">{{ $game->getChapter()->getTitle() }}</span>

        <div class="flex flex-row">
            <a class="mx-1 flex flex-row items-center" href="{{ $config['routes']['playGame'] . $game->getId() }}"><svg
                    xmlns="http://www.w3.org/2000/svg" class="size-10 fill-primary-600 dark:fill-primary-500"
                    viewBox="0 -960 960 960">
                    <path
                        d="m380-300 280-180-280-180v360ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Z" />
                </svg></a>
            <a class="mx-1 flex flex-row items-center"
                href="{{ $config['routes']['game'] . $game->getId() . '/delete' }}"><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                    class="size-10 fill-primary-600 dark:fill-primary-500">
                    <path
                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                </svg></a>
        </div>

    </div>
</game>

<character>
    @isset($character)
        <div
            class="w-48 h-64 m-2 py-3 border-2 border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-col justify-between items-center">
            <div class="w-full flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-20 fill-primary-600 dark:fill-primary-500"
                    viewBox="0 -960 960 960">
                    <path
                        d="M360-390q-21 0-35.5-14.5T310-440q0-21 14.5-35.5T360-490q21 0 35.5 14.5T410-440q0 21-14.5 35.5T360-390Zm240 0q-21 0-35.5-14.5T550-440q0-21 14.5-35.5T600-490q21 0 35.5 14.5T650-440q0 21-14.5 35.5T600-390ZM480-160q134 0 227-93t93-227q0-24-3-46.5T786-570q-21 5-42 7.5t-44 2.5q-91 0-172-39T390-708q-32 78-91.5 135.5T160-486v6q0 134 93 227t227 93Zm0 80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-54-715q42 70 114 112.5T700-640q14 0 27-1.5t27-3.5q-42-70-114-112.5T480-800q-14 0-27 1.5t-27 3.5ZM177-581q51-29 89-75t57-103q-51 29-89 75t-57 103Zm249-214Zm-103 36Z" />
                </svg>
                <h1 class="font-black uppercase mb-3 mt-1 text-center line-clamp-2">{{ $character->getName() }}</h1>
            </div>
            <span class="bold">{{ $character->getClass()->name }}</span>
            <div class="flex flex-row">
                <a class="mx-1 flex flex-row items-center"
                    href="{{ $config['routes']['character'] . $character->getId() . '/edit' }}"><svg
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                        class="size-10 fill-primary-600 dark:fill-primary-500">
                        <path
                            d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
                    </svg></a>
                <a class="mx-1 flex flex-row items-center"
                    href="{{ $config['routes']['character'] . $character->getId() . '/delete' }}"><svg
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                        class="size-10 fill-primary-600 dark:fill-primary-500">
                        <path
                            d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                    </svg></a>
            </div>

        </div>
    @else
        <a class="w-48 h-64 m-2 py-3 border-2 border-dashed border-gray-200 dark:border-gray-800 rounded-lg shadow-lg flex flex-col justify-center items-center"
            href="{{ $config['routes']['character'] . 'add' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"
                class="size-20 fill-gray-300 dark:fill-gray-500">
                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
            </svg>
        </a>
    @endisset
</character>

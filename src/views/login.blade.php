<section class="h-full">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-full lg:py-0">
        <a href="{{ $config['baseUrl'] }}" class="flex items-center mb-6 text-2xl font-semibold">
            <img class="w-8 h-8 mr-2" src="/static/img/logo.svg" alt="logo">
            Storytis
        </a>
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    @if ($action == 'register')
                        Registrati
                    @else
                        Accedi al tuo account
                    @endif
                </h1>
                <form class="space-y-4 md:space-y-6" action="#">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium">Nome
                            utente</label>
                        <input type="text" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="nomeutente" required="true">
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="true">
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        @if ($action == 'register')
                            Registrati
                        @else
                            Login in
                        @endif
                    </button>

                    @if ($action == 'login')
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Non hai ancora un account? <a href="/login/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Registrati</a>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>

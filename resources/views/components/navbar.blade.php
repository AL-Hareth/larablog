@if (Route::has('login'))
    <div class="bg-transparent flex justify-between p-4 sm:p-6 items-center">
        <div>
            <a href=" {{ route('index') }}"><h1 class="text-3xl text-gray-300 font-semibold">Larablog</h1></a>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between">
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="sm:ml-4 mt-1 sm:mt-0 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
        @endauth
        </div>
    </div>
@endif

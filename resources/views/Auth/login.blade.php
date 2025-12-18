@extends('Layout.app')

@section('title', 'Login')

@section('content')
    <main class="flex-1 flex items-center justify-center transition-colors duration-300">
        <div class="w-full max-w-md bg-white dark:bg-dark rounded-xl shadow-lg p-6">
            <h1 class="text-2xl font-semibold text-dark dark:text-gray-300 mb-6 text-center">
                Login
            </h1>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm text-secondary dark:text-gray-300 mb-1">Username</label>
                    <input type="username" id="username" name="username" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-secondary dark:text-gray-300 mb-1">Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <div class="mb-4 flex items-center">
                    <input id="stay_log" name="stay_log" type="checkbox"
                        class="w-4 h-4 text-white bg-white border border-gray-300 border-opacity-60 rounded 
                            focus:ring-2 focus:ring-primary focus:ring-offset-0 
                            checked:bg-primary checked:border-primary 
                            checked:before:content-['✔'] checked:before:text-white 
                            checked:before:text-xs checked:before:flex 
                            checked:before:items-center checked:before:justify-center 
                            before:pointer-events-none appearance-none">
                    <label for="stay_log" class="ml-2 text-sm text-secondary dark:text-gray-300 cursor-pointer">
                        Remember me?
                    </label>
                </div>


                <button type="submit" 
                    class="w-auto p-3 bg-transparent border border-gray-300 dark:border-gray-500 hover:bg-secondary 
                        hover:border-transparent text-dark dark:text-gray-300 rounded-lg transition-colors duration-100">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </form>
        </div>
    </main>
@endsection
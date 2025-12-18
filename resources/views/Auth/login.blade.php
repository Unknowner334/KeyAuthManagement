@extends('Layout.app')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6">
        <!-- Your login form goes here -->
        <h1 class="text-2xl font-semibold text-dark mb-6 text-center">
            Login
        </h1>

        <form class="space-y-4">
            <div>
                <label class="block text-sm text-secondary mb-1">Email</label>
                <input
                    type="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                >
            </div>

            <div>
                <label class="block text-sm text-secondary mb-1">Password</label>
                <input type="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <button type="submit" class="w-full py-2 bg-primary text-white rounded-lg hover:opacity-90 transition">
                Sign in
            </button>
        </form>
    </div>
@endsection
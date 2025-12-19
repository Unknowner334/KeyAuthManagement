@extends('Layout.app')

@section('title', 'Fallback')

@section('content')
    <main class="flex-1 flex flex-col items-center justify-center gap-4">
        <h1 class="text-red-600 text-6xl">404</h1>
        <div class="w-full max-w-xs md:max-w-md lg:max-w-lg border border-red-600"></div>
        <h1 class="text-red-600 text-2xl md:text-4xl lg:text-5xl">Something Went Wrong.</h1>
    </main>
@endsection
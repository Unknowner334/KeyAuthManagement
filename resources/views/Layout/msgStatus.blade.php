@if($errors->any())
    <div class="alert alert-danger fade show" role="alert">
        {{ $errors->first() }}
    </div>
@endif

@if (session()->has('msgSuccess'))
    <div class="alert alert-success fade show" role="alert">
        {{ session('msgSuccess') }}
    </div>
@endif

@if (session()->has('msgWarning'))
    <div class="alert alert-warning fade show" role="alert">
        {{ session('msgWarning') }}
    </div>
@endif

@if (!$errors->any() && !session()->has('msgSuccess') && !session()->has('msgWarning'))
    @auth
        <div class="alert alert-secondary fade show" role="alert">
            Welcome {{ auth()->user()->name }}
        </div>
    @else
        <div class="alert alert-secondary fade show" role="alert">
            {{ config('app.name') }}
        </div>
    @endauth
@endif

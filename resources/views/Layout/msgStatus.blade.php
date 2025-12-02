@auth
    @if (Route::currentRouteName() === 'keys')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify key by their (id, owner, app, key, duration, devices, registrar or price).
        </div>
    @elseif (Route::currentRouteName() === 'apps')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify app by their (id, name, price or registrar).
        </div>
    @elseif (Route::currentRouteName() === 'admin.users')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify users by their (id, name, username, role, reff or registrar).
        </div>
    @else
        <div class="alert alert-secondary fade show" role="alert">
            Welcome {{ auth()->user()->name }}
        </div>
    @endif
@else
    <div class="alert alert-secondary fade show" role="alert">
        {{ config('app.name') }}
    </div>
@endauth

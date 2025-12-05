@auth
    @if (Route::currentRouteName() === 'licenses')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify licenses by their info.
        </div>
    @elseif (Route::currentRouteName() === 'apps')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify apps by their info.
        </div>
    @elseif (Route::currentRouteName() === 'admin.users')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify users by their info.
        </div>
    @elseif (Route::currentRouteName() === 'admin.referrable')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify reffs by their info.
        </div>
    @elseif (Route::currentRouteName() === 'admin.users.history.user')
        <div class="alert alert-primary fade show" role="alert">
            <B>INFO</B> · Search specify users history by their info.
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

<header>
  <nav class="bg-dark text-white shadow-sm">
    <div class="container mx-auto px-2 md:px-29.5 flex items-center justify-between h-14">
      <div class="flex items-center gap-6">
        <a href="/" class="flex items-center text-white text-[18px] md:text-[20px]">
          <i class="bi bi-box px-3"></i> {{ config('app.name') }}
        </a>
        <div class="hidden md:flex gap-3 items-center">
          @auth
            <a href="{{ route('licenses.index') }}" class="flex items-center gap-1 hover:text-primary transition-colors">
              <i class="bi bi-key"></i> Licenses
            </a>
            <a href="{{ route('apps.index') }}" class="flex items-center gap-1 hover:text-primary transition-colors">
              <i class="bi bi-terminal"></i> Apps
            </a>
          @endauth
        </div>
        <div class="md:hidden" x-data="{ open: false }">
          <button @click="open = !open" class="p-2 rounded hover:bg-dark-3 transition-colors">
            <i class="bi text-2xl" :class="open ? 'bi-x-lg' : 'bi-list'"></i>
          </button>
          <div x-show="open" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                @click.away="open = false"
                class="absolute right-2 top-14 w-48 bg-dark rounded-md shadow-lg py-2 flex flex-col gap-2 z-50">

            @auth
              <a href="{{ route('licenses.index') }}" class="px-4 py-2 hover:bg-dark-3 rounded flex items-center gap-1">
                <i class="bi bi-key"></i> Licenses
              </a>
              <a href="{{ route('apps.index') }}" class="px-4 py-2 hover:bg-dark-3 rounded flex items-center gap-1">
                <i class="bi bi-terminal"></i> Apps
              </a>
            @endauth
          </div>
        </div>
      </div>
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open"
            class="flex items-center gap-1 px-3 py-2 hover:text-primary transition-colors rounded">
          <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
          <i class="bi bi-caret-down-fill"></i>
        </button>

        <ul x-show="open" @click.away="open = false"
          x-transition 
          class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg flex flex-col z-50 py-2">
          <li class="text-black p-2 hover:bg-gray-200"><i class="bi bi-discord"></i></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
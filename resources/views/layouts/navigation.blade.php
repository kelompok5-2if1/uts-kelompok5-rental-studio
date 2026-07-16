<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur">
    @php
        $userRole = strtolower(Auth::user()->role ?? 'admin');
        $menuItems = $userRole === 'kasir'
            ? [
                ['label' => 'Dashboard', 'href' => route('dashboard'), 'roles' => ['admin', 'kasir', 'owner']],
                ['label' => 'Pembayaran', 'href' => url('/pembayaran'), 'roles' => ['admin', 'owner', 'kasir']],
            ]
            : [
                ['label' => 'Dashboard', 'href' => route('dashboard'), 'roles' => ['admin', 'kasir', 'owner']],
                ['label' => 'Pelanggan', 'href' => url('/pelanggan'), 'roles' => ['admin', 'owner']],
                ['label' => 'Kategori', 'href' => url('/kategori'), 'roles' => ['admin', 'owner']],
                ['label' => 'Studio', 'href' => url('/studio'), 'roles' => ['admin', 'owner']],
                ['label' => 'Alat Band', 'href' => url('/alat-band'), 'roles' => ['admin', 'owner']],
                ['label' => 'Booking Studio', 'href' => url('/booking-studio'), 'roles' => ['admin', 'owner']],
                ['label' => 'Rental Alat', 'href' => url('/rental-alat'), 'roles' => ['admin', 'owner']],
                ['label' => 'Detail Rental', 'href' => url('/detail-rental'), 'roles' => ['admin', 'owner']],
                ['label' => 'Pembayaran', 'href' => url('/pembayaran'), 'roles' => ['admin', 'owner', 'kasir']],
                ['label' => 'Laporan', 'href' => url('/laporan-rental'), 'roles' => ['admin', 'owner']],
            ];
    @endphp

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="mr-4 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 rounded-full bg-slate-900 px-3 py-2 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18M3 8h18M6 8v10a2 2 0 002 2h8a2 2 0 002-2V8" />
                        </svg>
                        <span class="text-sm font-semibold">Studio Rental</span>
                    </a>
                </div>

                <div class="hidden lg:flex lg:items-center lg:space-x-6 lg:ml-2 text-sm font-medium">
                    @foreach($menuItems as $item)
                        @if(in_array($userRole, $item['roles'], true))
                            <x-nav-link :href="$item['href']" :active="request()->url() === $item['href']">
                                {{ $item['label'] }}
                            </x-nav-link>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="hidden lg:flex lg:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            <span class="mr-3 inline-flex items-center rounded-full bg-blue-600 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.3em] text-white">
                                {{ strtoupper($userRole) }}
                            </span>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-2">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-600 transition hover:bg-slate-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': !open}" class="hidden border-t border-slate-200 bg-white lg:hidden">
        <div class="space-y-2 px-3 py-3">
            @foreach($menuItems as $item)
                @if(in_array(strtolower(Auth::user()->role ?? 'admin'), $item['roles'], true))
                    <x-responsive-nav-link :href="$item['href']">
                        {{ $item['label'] }}
                    </x-responsive-nav-link>
                @endif
            @endforeach
        </div>

        <div class="border-t border-slate-200 px-4 py-4">
            <div class="text-base font-medium text-slate-800">{{ Auth::user()->name }}</div>
            <div class="text-sm text-slate-500">{{ Auth::user()->email }}</div>
            <div class="mt-3 space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
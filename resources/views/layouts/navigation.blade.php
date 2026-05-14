<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center">

                <!-- LOGO -->
                <div class="shrink-0 flex items-center">

                    <a href="{{ route('dashboard') }}">

                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />

                    </a>

                </div>

                <!-- DESKTOP MENU -->
                <div class="hidden lg:flex lg:items-center lg:space-x-6 lg:ml-10 text-sm font-medium">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="url('/pelanggan')">
                        Pelanggan
                    </x-nav-link>

                    <x-nav-link :href="url('/kategori')">
                        Kategori
                    </x-nav-link>

                    <x-nav-link :href="url('/studio')">
                        Studio
                    </x-nav-link>

                    <x-nav-link :href="url('/alat-band')">
                        Alat Band
                    </x-nav-link>

                    <x-nav-link :href="url('/booking-studio')">
                        Booking Studio
                    </x-nav-link>

                    <x-nav-link :href="url('/rental-alat')">
                        Rental Alat
                    </x-nav-link>

                    <x-nav-link :href="url('/detail-rental')">
                        Detail Rental
                    </x-nav-link>

                    <x-nav-link :href="url('/pembayaran')">
                        Pembayaran
                    </x-nav-link>

                    <x-nav-link :href="url('/laporan-rental')">
                        Laporan
                    </x-nav-link>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="hidden lg:flex lg:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm rounded-md text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 hover:text-gray-800 dark:hover:text-white focus:outline-none transition">

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-2">

                                <svg class="fill-current h-4 w-4"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />

                                </svg>

                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                Log Out

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- MOBILE BUTTON -->
            <div class="flex items-center lg:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">

                    <svg class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24">

                        <path :class="{'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- MOBILE MENU -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden lg:hidden bg-white dark:bg-gray-800 border-t">

        <div class="px-3 py-3 space-y-2">

            <x-responsive-nav-link :href="route('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/pelanggan')">
                Pelanggan
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/kategori')">
                Kategori
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/studio')">
                Studio
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/alat-band')">
                Alat Band
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/booking-studio')">
                Booking Studio
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/rental-alat')">
                Rental Alat
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/detail-rental')">
                Detail Rental
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/pembayaran')">
                Pembayaran
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/laporan-rental')">
                Laporan Rental
            </x-responsive-nav-link>

        </div>

        <!-- MOBILE USER -->
        <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-4">

            <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                {{ Auth::user()->name }}
            </div>

            <div class="text-sm text-gray-500">
                {{ Auth::user()->email }}
            </div>

            <div class="mt-3 space-y-2">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">

                        Log Out

                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>
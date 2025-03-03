<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center ">
                    <a href="{{ route('listpost') }}" class=" flex items-center justify-center space-x-2 rounded-full ">
                        <img src="{{ asset('image/logo Q&A Hub pn 20a80efd-5653-40fe-9751-3b71a88a8346.png') }}"
                            alt="Logo" class="text-white rounded-lg  " style="width: 3rem; height: 3rem;">
                        <span class="text-xl font-semibold ">{{ __('Q&A HUB') }}</span>
                    </a>

                </div>

                <!-- Navigation Links -->

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('listpost')" :active="request()->routeIs('listpost')">
                        {{ __('กระทู้ทั้งหมด') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('listcategories')" :active="request()->routeIs('listcategories')">
                        {{ __('หมวดหมู่') }}
                    </x-nav-link>
                </div>
                @if (Auth::check() && Auth::user()->usertype === 'admin')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                            {{ __('จัดการผู้ใช้') }}
                        </x-nav-link>
                    </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                        {{ __('สร้างกระทู้') }}
                    </x-nav-link>
                </div>

                <!-- Show UserControl only for admin -->
                @if (Auth::check() && Auth::user()->usertype === 'admin')
                    <!-- Check if the user is an admin -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('categories.create')" :active="request()->routeIs('categories.create')">
                            {{ __('สร้างหมวดหมู่') }}
                        </x-nav-link>
                    </div>
                @endif


            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @auth
                                <div>{{ Auth::user()->name }}</div>
                            @else
                                <div>{{ __('Guest') }}</div>
                            @endauth
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @auth
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('โปรไฟล์') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('posts.myposts')">
                                {{ __('กระทู้ของฉัน') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('ออกจากระบบ') }}
                                </x-dropdown-link>
                            </form>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


</nav>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <!-- Fontawesome for Icons-->
    <script src="https://kit.fontawesome.com/fc45e0c6e7.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    @yield('library-css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-primary">

        <div id="navbar"
            class="transition-transform duration-300 ease-in-out border-b border-accent fixed w-full bg-primary px-6 sm:px-10 py-1 z-50">
            <div class="flex justify-between items-center h-20">
                <!-- Left: Logo -->
                <div class="text-lg font-bold">
                    Logo TPS
                </div>

                <!-- Mobile Toggle Button -->
                <button id="menu-toggle" class="sm:hidden text-2xl focus:outline-none">
                    <!-- Hamburger icon -->
                    <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Close icon -->
                    <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex gap-8 items-center">
                    <a class="hover:font-semibold hover:text-accent py-2 px-4 transition duration-300 text-primary
                    {{ request()->is('/') ? 'bg-accent text-primary font-semibold rounded-full' : '' }}"
                        href="{{ route('home') }}">Home</a>
                    <a class="hover:font-semibold hover:text-accent py-2 px-4 transition duration-300 text-primary
                    {{ request()->routeIs('dashboard.*') || request()->routeIs('group.*') ? 'bg-accent text-primary font-semibold rounded-full' : '' }}"
                        href="{{ route('dashboard.index') }}">Dashboard</a>
                    <a class="hover:font-semibold hover:text-accent py-2 px-4 transition duration-300 text-primary
                    {{ request()->routeIs('user.*') ? 'bg-accent text-primary font-semibold rounded-full' : '' }}"
                        href="{{ route('user') }}">Accounts</a>
                </div>

                <!-- Desktop Logout -->

                <div class="hidden sm:flex items-center">
                    @if(session()->has('email'))
                    <a href="{{ route('logout') }}" class="hover:font-semibold transition duration-300">
                        <button class="button">Logout</button>
                    </a>
                    @endif
                </div>
            </div>


            <!-- Mobile Menu (hidden by default) -->
            <div id="mobile-menu"
                class="hidden flex flex-col gap-4 items-center sm:hidden pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('home') }}"
                    class="w-full text-center hover:font-semibold hover:text-accent py-2 px-4 transition duration-300 text-primary
                    {{ request()->is('/') ? 'bg-accent text-primary font-semibold rounded-full' : '' }}">Home</a>
                <a href="{{ route('dashboard.index') }}"
                    class="w-full text-center hover:font-semibold hover:text-accent py-2 px-4 transition duration-300 text-primary
                    {{ request()->routeIs('dashboard.*') || request()->routeIs('group.*') ? 'bg-accent text-primary font-semibold rounded-full' : '' }}">Dashboard</a>
                <a href="{{ route('user') }}"
                    class="w-full text-center hover:font-semibold hover:text-accent py-2 px-4 transition duration-300 text-primary
                    {{ request()->routeIs('user.*') ? 'bg-accent text-primary font-semibold rounded-full' : '' }}">Accounts</a>
                @if(session('user'))
                <a href="{{ route('logout') }}" class="w-full text-center py-2 hover:font-semibold">
                    <button class="button">Logout</button>
                </a>
                @endif
            </div>
        </div>

        <div class="container mx-auto px-5 md:px-20 py-30">
            @if(session()->has('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Success alert!</span> {{session()->get('success')}}
                </div>
            </div>
            @endif
            @if(session()->has('error'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Danger alert!</span> {{session()->get('error')}}
                </div>
            </div>
            @endif
            @yield('content')
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script>
        document.querySelector("#navbar").querySelectorAll("a").forEach((link) => {
            if (link.href === window.location.href) {
                link.classList.add("bg-accent", "text-primary", "font-semibold", "rounded-full");
            }
        });

        let navbar = document.querySelector("#navbar");
        let prevScrollY = window.scrollY;
        window.addEventListener("scroll", () => {
            if (window.scrollY > prevScrollY) {
                navbar.style.transform = "translateY(-105%)";
            } else {
                navbar.style.transform = "translateY(0)";
            }
        });

        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

    </script>


    @yield('library-js')

</body>

</html>
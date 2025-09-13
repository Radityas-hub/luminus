<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course['title'] }} | Luminus</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f2f6;
            font-family: 'Poppins', sans-serif;
        }
        ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #fff;
    }

    ::-webkit-scrollbar-thumb {
        background: #696EFF;
        border-radius: 8px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #696EFF;
        opacity: 0.7;
    }

        #android-content::-webkit-scrollbar {
            /* width: 80%;
        margin: 0 auto;
        height: 4px */
            display: none;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #fff;
        }

        ::-webkit-scrollbar-thumb {
            background: #696EFF;
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #696EFF;
            opacity: 0.7;
        }

        @media (max-width: 920px) {
            .stickyContainer {
                display: none !important;
            }

            .containerWrapper {
                grid-template-columns: 1fr !important;
            }

            .cardContainerFirst {
                display: block !important;
            }
        }
    </style>
</head>


<body class="bg-[#f1f2f6]">

    <div class="w-full h-fit flex justify-center items-center fixed z-50 transition-all duration-500 ease-in-out">
        <div id="navbar"
            class=" bg-[#032038] w-full flex align-center justify-center transition-all duration-200 ease-in-out h-fit py-6">
            <div class=" w-[80%] h-full flex justify-between items-center transition-all duration-200 ease-in-out">
                <div class="logo flex justify-center items-center">
                    <a href="{{ route('home') }}" class="font-semibold text-2xl text-white" id="logo">Lu<span
                            id="logoSpan"
                            class="bg-gradient-to-r from-gradient-1 to-gradient-2 text-transparent bg-clip-text">minus</span>
                    </a>
                </div>
                <div class="nav hidden justify-center items-center md:flex">
                    <ul class="flex justify-between items-center gap-2 text-gray-400" id="menu">
                        <li class="mx-2 nav-links  font-medium">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="mx-2  text-white font-medium" id="active-links">
                            <a href="{{ '/kursus' }}">Kursus</a>
                        </li>
                        <li class="mx-2 nav-links font-medium">
                            <a href="{{ route('forums.index') }}">Forum</a>
                        </li>
                    </ul>
                </div>
                <div class="hidden md:flex justify-between gap-3 items-center h-full" id="buttons">
                    @guest
                        <a href="{{ route('login') }}"
                            class="flex items-center justify-center px-8 py-2 bg-gradient-to-r from-gradient-1 to-gradient-2 text-white font-semibold rounded-md text-lg header-hover-button"
                            id="registerButton">Masuk</a>
                    @else
                        <div class="relative">
                            <button id="userDropdownButton" class="flex items-center gap-x-1 justify-center text-white">
                                Halo, {{ Auth::user()->name }} <span class="text-xs"><i id="userDropdownIcon"
                                        class="fa-solid fa-chevron-down"></i></span>
                            </button>
                            <ul id="userDropdownMenu"
                                class="absolute right-0 mt-2 w-48 bg-white text-black rounded-lg shadow-lg hidden ">
                                <li class="px-4 py-2 hover:bg-gray-200 hover:rounded-lg">
                                    <a href="{{ route(Auth::user()->role . '.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="px-4 py-2 hover:bg-gray-200">
                                    <button type="button" class="w-full text-left"
                                        onclick="confirmLogout()">Logout</button>
                                    <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
                <button id="hamburger" class="md:hidden text-white"><i id="iconNav"
                        class="fa-solid fa-bars"></i></button>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                customClass: {
                    popup: 'swal2-popup-custom',
                    title: 'swal2-title-custom',
                    confirmButton: 'swal2-confirm-button-custom',
                    cancelButton: 'swal2-cancel-button-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("scroll", function() {
                // scroll-up button show/hide script
                const scrollUpBtn = document.querySelector(".scroll-up-btn");
                if (window.scrollY > 100) {
                    scrollUpBtn.classList.add("show");
                } else {
                    scrollUpBtn.classList.remove("show");
                }
            });
        });
    </script>

    <style>
        .swal2-popup-custom {
            background: #f8f9fa;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .swal2-title-custom {
            color: #052742;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .swal2-confirm-button-custom {
            background: linear-gradient(to right, #696EFF, #F8ACFF);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 600;
        }

        .swal2-cancel-button-custom {
            background: #d33;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 600;
        }

        .nav-links {
            transition: 0.1s ease;
            opacity: .6;
        }

        .nav-links:hover {
            opacity: 1;
        }
    </style>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("scroll", function() {
                // scroll-up button show/hide script
                const scrollUpBtn = document.querySelector(".scroll-up-btn");
                if (window.scrollY > 100) {
                    scrollUpBtn.classList.add("show");
                } else {
                    scrollUpBtn.classList.remove("show");
                }
            });
        });
    </script>

    <script>
        document.getElementById('userDropdownButton').addEventListener('click', function() {
            var dropdownMenu = document.getElementById('userDropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        });
    </script>

    <div class="fixed hidden bg-white w-full h-screen z-40" id="hamburgerMenu">
        <div class="flex w-full px-6 flex-col mt-24 items-center h-full ">
            <div class="flex gap-6 mb-6 border-b-2 pb-5 w-full justify-center">
                <button
                    class="flex items-center justify-center px-6 py-2 border-2 bg-[#696EFF] rounded-lg text-white w-full">Masuk</button>
            </div>

            <ul class="flex flex-col w-full  items-center gap-6">
                <li class="text-lg font-semibold flex items-center w-full justify-between text-black">
                    <span> <a href="{{ route('home') }}">Beranda</a></span> <i
                        class="fa-solid fa-info w-6 text-center text-xs text-gray-400 aspect-square"></i>
                </li>
                <li class="text-lg font-semibold flex items-center w-full justify-between text-black">
                    <span><a href="{{ route('courses.list') }}">Kursus</a></span> <i
                        class="fa-solid fa-info w-6 text-center text-xs text-gray-400 aspect-square"></i>
                </li>
                <li class="text-lg font-semibold flex items-center w-full justify-between text-black"><span
                        class="underline"><a href="{{ route('forums.index') }}">Forum</a></span>
                    <i class="fa-solid fa-link w-6 text-center aspect-square text-xs text-gray-400"></i>
                </li>
            </ul>
        </div>
    </div>

    <script>
        const navbar = document.getElementById('navbar');
        const logo = document.getElementById('logo');
        const menu = document.getElementById('menu');
        const buttons = document.getElementById('buttons').getElementsByTagName('button');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownIcon = document.getElementById('dropdownIcon');
        const hamburger = document.getElementById('hamburger');
        const navIcon = document.getElementById('iconNav');
        const logoSpan = document.getElementById('logoSpan');
        const hamburgerMenu = document.getElementById('hamburgerMenu');
        const activeLinks = document.getElementById('active-links');
        const registerButton = document.getElementById('registerButton')

        hamburger.onclick = function() {
            if (navIcon.classList.contains('fa-bars')) {
                navIcon.classList.replace('fa-bars', 'fa-xmark');
                hamburger.classList.replace('text-white', 'text-black');
                hamburgerMenu.classList.remove('hidden');
                logo.classList.replace('text-white', 'text-black');
                logoSpan.classList.replace('text-transparent', 'text-black');
                if (window.scrollY > 50) {
                    navbar.classList.remove("shadow-[0px_8px_17px_0px_rgba(0,_0,_0,_0.2)]");
                }
                document.body.classList.add('overflow-hidden');
            } else {
                navIcon.classList.replace('fa-xmark', 'fa-bars');
                hamburgerMenu.classList.add('hidden');
                if (window.scrollY > 50) {
                    logo.classList.replace('text-white', 'text-black');
                    logoSpan.classList.replace('text-transparent', 'text-black');
                    hamburger.classList.replace('text-white', 'text-black');
                } else {
                    hamburger.classList.replace('text-black', 'text-white');
                    logo.classList.replace('text-black', 'text-white');
                    logoSpan.classList.replace('text-black', 'text-transparent');
                };
                document.body.classList.remove('overflow-hidden');
            }
        };

        window.onscroll = function() {

            hamburger.onclick = function() {
                if (navIcon.classList.contains('fa-bars')) {
                    navIcon.classList.replace('fa-bars', 'fa-xmark');
                    hamburger.classList.replace('text-white', 'text-black');
                    hamburgerMenu.classList.remove('hidden');
                    logo.classList.replace('text-white', 'text-black');
                    logoSpan.classList.replace('text-transparent', 'text-black');
                    if (window.scrollY > 50) {
                        navbar.classList.remove("shadow-[0px_8px_17px_0px_rgba(0,_0,_0,_0.2)]");
                    }
                    document.body.classList.add('overflow-hidden');
                } else {
                    navIcon.classList.replace('fa-xmark', 'fa-bars');
                    hamburgerMenu.classList.add('hidden');
                    if (window.scrollY > 50) {
                        logo.classList.replace('text-white', 'text-black');
                        logoSpan.classList.replace('text-transparent', 'text-black');
                        hamburger.classList.replace('text-white', 'text-black');
                    } else {
                        hamburger.classList.replace('text-black', 'text-white');
                        logo.classList.replace('text-black', 'text-white');
                        logoSpan.classList.replace('text-black', 'text-transparent');
                    };
                    document.body.classList.remove('overflow-hidden');
                }
            };

            if (window.scrollY > 60) {
                registerButton.classList.replace("header-hover-button", "hover-button");
                activeLinks.classList.remove("text-white");
                activeLinks.classList.add("text-black");
                navbar.classList.add("bg-white", "py-2",
                    "shadow-[0px_8px_17px_0px_rgba(0,_0,_0,_0.1)]");
                logo.classList.replace('text-white', 'text-black');
                logoSpan.classList.replace('text-transparent', 'text-black');
                menu.classList.replace('text-gray-400', 'text-gray-500');
                buttons[0].classList.add('bg-gradient-1');
                buttons[0].classList.replace('border-blue-border', 'border-white');
                buttons[1].classList.replace('flex', 'hidden');
                dropdownMenu.classList.add('hidden', 'border', 'border-gray-200');
                dropdownMenu.classList.replace('mt-2', 'mt-8');
                dropdownIcon.classList.remove('fa-chevron-up');
                dropdownIcon.classList.add('fa-chevron-down');
                hamburger.classList.replace('text-white', 'text-black');

            } else {
                registerButton.classList.replace("hover-button", "header-hover-button");
                activeLinks.classList.remove("text-black");
                activeLinks.classList.add("text-white");
                navbar.classList.remove("bg-white",
                    "shadow-[0px_8px_17px_0px_rgba(0,_0,_0,_0.1)]");
                logo.classList.replace('text-black', 'text-white');
                logoSpan.classList.replace('text-black', 'text-transparent');
                menu.classList.replace('text-gray-500', 'text-gray-400');
                buttons[0].classList.remove('bg-gradient-1');
                buttons[0].classList.replace('border-white', 'border-blue-border');
                buttons[1].classList.replace('hidden', 'flex');
                dropdownMenu.classList.remove('border', 'border-gray-200');
                dropdownMenu.classList.replace('mt-8', 'mt-2');
                hamburger.classList.replace('text-black', 'text-white');
            }
        };


        document.getElementById('dropdownButtonMobile').onclick = function() {
            document.getElementById('dropdownMenuMobile').classList.toggle('hidden');
            document.getElementById('dropDownIconMobile').classList.toggle('fa-chevron-down');
            document.getElementById('dropDownIconMobile').classList.toggle('fa-chevron-up');
        };


        document.getElementById('dropdownButton').onclick = function() {
            dropdownMenu.classList.toggle('hidden');
            dropdownIcon.classList.toggle('fa-chevron-down');
            dropdownIcon.classList.toggle('fa-chevron-up');
        };
    </script>

    <div class="grid place-items-center pt-[100px]">

        <div class="container w-10/12 grid md:grid-cols-[2fr_1fr] containerWrapper">
            <div class="container mx-auto md:px-4 md:py-8">
                <div class="w-full md:max-w-4xl md:mx-auto flex flex-col gap-y-3 bg-white px-4 py-6	rounded-xl">
                    <!-- Header -->
                    <div class="overflow-hidden px-4 py-6 flex justify-center items-center">
                        <div class="w-full h-full flex flex-col gap-y-2">
                            <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                                <div class="flex items-center gap-1 bg-[#696EFF] w-fit px-3 py-2 rounded text-white">
                                    <i class="fas fa-clock "></i>
                                    <span>{{ $course['duration'] }}</span>
                                </div>
                                <div class="flex items-center gap-1 bg-[#696EFF] w-fit px-3 py-2 rounded text-white">
                                    <i class="fas fa-book "></i>
                                    <span>{{ $course['modules'] }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="text-2xl font-bold">
                                    {{ $course['title'] }}
                                </h1>

                            </div>

                            <p class="text-gray-600">{{ $course['description'] }}</p>


                        </div>
                    </div>

                    <div class="overflow-hidden md:hidden cardContainerFirst mb-8" data-aos="fade-up">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $course['category'] }}</span>
                                <span class="text-gray-500 text-sm">{{ $course['subCategory'] }}</span>
                            </div>
                            <h1 class="text-2xl font-bold mb-4">{{ $course['title'] }}</h1>

                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $course['duration'] }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-book"></i>
                                    <span>{{ $course['modules'] }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 mb-6">
                                <span class="text-gray-400 line-through text-lg">Rp
                                    {{ number_format($course['originalPrice'], 0, ',', '.') }}</span>
                                <span class="text-2xl font-bold text-blue-600">Rp
                                    {{ number_format($course['discountPrice'], 0, ',', '.') }}</span>
                            </div>

                            <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>

                    <div class=" overflow-hidden aspect-video px-2" data-aos="fade-up">
                        <iframe src="{{ $course['thumbnail'] }}" title="{{ $course['title'] }}"
                            class="w-full h-full rounded-lg" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div data-aos="fade-up" class="px-2">
                        <h1 class="mt-2 mb-2  text-xl font-bold">{{ $course['materi'][0]['title'] }}</h1>
                        <p class="text-gray-600">{{ $course['materi'][0]['description'] }}</p>
                    </div>

                    <div class="p-2" data-aos="fade-up" data-aos-delay="200">

                    </div>

                    <div class="p-2" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-bold mb-4">Daftar Materi</h2>
                        <ul class="space-y-4">
                            @foreach ($course['materi'] as $index => $materi)
                                <li
                                    class="flex flex-col rounded-md p-4 {{ $index === 0 ? 'bg-gray-200 text-gray-800' : 'bg-[#696EFF] text-white' }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-circle-play"></i>
                                            <span>{{ $materi['title'] }}</span>
                                        </div>
                                        @if ($index == 0)
                                            <i class="fa-solid fa-unlock text-black"></i>
                                        @endif
                                        @if ($index !== 0)
                                            <i class="fa-solid fa-lock"></i>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <!-- Hasil Pembelajaran -->
                    <div class=" p-2" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-xl font-bold mb-4">Hasil Pembelajaran</h2>
                        <ul class="space-y-4">
                            @foreach ($course['learning_outcomes'] as $outcome)
                                <li class="flex flex-col rounded-md p-4 bg-blue-50 ">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span>{{ $outcome['title'] }}</span>
                                    </div>
                                    <div class="pl-6 text-xs text-gray-500">{{ $outcome['description'] }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-4 py-8 hidden md:block stickyContainer">
                <div class="bg-white rounded-xl overflow-hidden sticky top-8" data-aos="fade-up"
                    style="border: 1px solid #2563EB">
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span
                                class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $course['category'] }}</span>
                            <span class="text-gray-500 text-sm">{{ $course['subCategory'] }}</span>
                        </div>
                        <h1 class="text-2xl font-bold mb-4">{{ $course['title'] }}</h1>

                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-clock"></i>
                                <span>{{ $course['duration'] }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-book"></i>
                                <span>{{ $course['modules'] }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mb-6 ">
                            <span class="text-gray-400 line-through text-lg">Rp
                                {{ number_format($course['originalPrice'], 0, ',', '.') }}</span>
                            <span class="text-2xl font-bold text-blue-600">Rp
                                {{ number_format($course['discountPrice'], 0, ',', '.') }}</span>
                        </div>

                        <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <section class="cta-section">
        <div class="cta-container">
            {{-- left images  --}}
            <img src="{{ asset('images/cta-left-people.png') }}" alt="profile" class="cta-left-people-images">
            <img src="{{ asset('images/dott.png') }}" alt="profile" class="cta-left-dott">
            {{--  --}}
            <div class="cta-text-section">
                <div class="cta-title">
                    <h1>Jadilah Ahli di Bidangmu! 🚀</h1>
                </div>
                <div class="cta-description">
                    <p>Akses kursus premium dengan mentor berpengalaman, kapan saja dan di mana saja. Jangan lewatkan
                        kesempatan ini!</p>
                </div>
                <div class="cta-button">
                    <button>Dapatkan Sekarang</button>
                </div>
            </div>
            {{-- right images --}}
            <img src="{{ asset('images/cta-right-people.png') }}" alt="profile" class="cta-right-people-images">
            <img src="{{ asset('images/dott.png') }}" alt="profile" class="cta-right-dott">
            {{--  --}}
        </div>
    </section>

    <style>
        .cta-left-people-images {
            width: 260px;
            height: auto;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 2;
        }

        .cta-left-dott {
            position: absolute;
            left: 140px;
            bottom: 0;
            width: 150px;
            height: auto;
            z-index: 1
        }

        .cta-right-people-images {
            width: 240px;
            height: auto;
            position: absolute;
            right: 0;
            bottom: 0;
            z-index: 2;
        }

        .cta-right-dott {
            position: absolute;
            right: 130px;
            top: 0;
            width: 150px;
            height: auto;
            z-index: 1
        }

        .cta-section {
            background-color: #696EFF;
            width: 100%;
            height: 50vh;
            display: flex;
            flex-direction: column;
            gap: 16px;
            justify-content: center;
            align-items: center;
        }

        .cta-container {
            width: 83%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .cta-text-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .cta-title {
            font-size: 30px;
            font-weight: 500;
            color: white;
            text-align: center
        }

        .cta-description {
            margin-top: 8px;
            font-size: 16px;
            font-weight: 300;
            color: white;
            opacity: .6;
            max-width: 530px;
            text-align: center;
        }

        .cta-button {
            margin-top: 32px;
            padding: 12px 32px;
            background-color: #fff;
            border-radius: 10px;
            color: #696EFF;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* responsive  */
        @media (max-width: 1320px) {
            .cta-left-dott {
                transform: translateY(5em)
            }

            .cta-right-dott {
                transform: translateY(-6em)
            }
        }

        @media (max-width: 1035px) {

            /* Tablet */
            .cta-left-people-images,
            .cta-right-people-images {
                display: none
            }

            .cta-left-dott {
                left: 0;
            }

            .cta-right-dott {
                right: 0;
            }
        }

        @media (max-width: 600px) {

            /* Mobile */
            .cta-right-dott {
                transform: translateY(-7em)
            }
        }
    </style>

    <section class="footer-section ">
        <div class="footer-container">
            <div class="footer-content">
                <p class="website-name">Luminus</p>
                <p class="footer-text">Tempat kursus koding terbaik untuk bantu kamu jadi ahli di dunia koding!</p>
            </div>
            <div class="footer-content">
                <p class="website-name">Navigasi</p>
                <div class="footer-links">
                    <a href="{{ route('home') }}">
                        <p>Beranda</p>
                    </a>
                    <a href="{{ route('home') }}">
                        <p>Tentang</p>
                    </a>
                    <a href="{{ route('home') }}">
                        <p>Kursus</p>
                    </a>
                    <a href="{{ route('home') }}">
                        <p>Rute Karir</p>
                    </a>
                    <a href="{{ route('home') }}">
                        <p>FAQ</p>
                    </a>
                </div>
            </div>
            <div class="footer-content">
                <p class="website-name">Halaman</p>
                <div class="footer-links">
                    <a href="{{ route('home') }}">
                        <p>Beranda</p>
                    </a>
                    <a href="{{ route('courses.list') }}">
                        <p>Kursus</p>
                    </a>
                    <a href="{{ route('forums.index') }}">
                        <p>Forum</p>
                    </a>
                </div>
            </div>
            <div class="footer-content">
                <p class="website-name">Kontak</p>
                <div class="footer-links">
                    <a href="mailto:halo@mediaku.idn">
                        <p>info@luminus.id</p>
                    </a>
                    <p>+62 813 4482 9209</p>
                    <p>Jln. Gajah Mada, Bandung</p>
                </div>
            </div>
        </div>
        <p class="copyright"
            style="position:absolute;bottom:20px;left: 0;width: 100%;text-align: center;opacity: 0.6;color: white;font-weight: 500;font-size: 14px;">
            Copyright © <span>Luminus</span> | Developed by <span>Maba Kabupaten.</span></p>
    </section>

    <style>
        .footer-section {
            height: 45vh;
            background-color: #032038;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-container {
            width: 70%;
            height: 100%;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            padding-bottom: 2em;
        }

        .footer-content {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            padding-top: 3em;
            align-items: flex-start;
            flex-direction: column;
        }

        .footer-content:nth-child(2) {
            padding-left: 8em;
        }

        .website-name {
            font-size: 18px;
            font-weight: 600;
            color: white;
        }

        .footer-text {
            margin-top: 1em;
            font-size: 15px;
            font-weight: 400;
            color: white;
            opacity: .6;
        }

        .subs-field {
            margin-top: 1.5em;
            width: 100%;
            height: 35px;
            background-color: var(--blue);
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            /* border: 1px solid white; */
        }

        .subs-field input {
            width: 80%;
            height: 100%;
            border: none;
            padding-left: 1em;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            background-color: var(--white);
            transition: .2s ease;
            color: white;
        }

        .subs-field input:focus {
            border: none !important;
            outline: none !important;
            background-color: #d9d9d9;
        }

        .subs-field input::placeholder {
            color: #303030;
        }

        .subs-btn {
            width: 20%;
            height: 100%;
            background-color: var(--blue);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-section i {
            color: white;
            font-size: 24px;
        }

        .subs-btn:hover {
            cursor: pointer;
        }

        .subs-btn i {
            transition: .2s ease;
        }

        .subs-btn:hover i {
            transform: translateX(.2em);
        }

        .footer-links {
            margin-top: 1em;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: .5em;
        }

        .footer-links p {
            font-size: 15px;
            font-weight: 400;
            color: white;
            opacity: .6;
        }

        .footer-links p:hover {
            cursor: pointer;
            opacity: 1;
            text-decoration: underline;
        }

        .footer-section span:hover {
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
        }

        .footer-section span {
            color: white;
        }

        @media (max-width:1170px) {
            .footer-container {
                width: 90%;
            }
        }

        @media (max-width:900px) {
            .footer-container {
                width: 80%;
                flex-direction: column;
                padding-bottom: 2em;
            }

            .footer-section {
                height: 100% !important;
                padding: 2em 0;
            }

            .footer-content:nth-child(2) {
                padding-left: 0em;
            }

            .subs-field {
                width: 300px;
            }

            .card-section-komunitas {
                border: 1px solid black;
                display: none;
            }

            .card-section-komunitas-tablet {
                width: 100% !important;
                height: 100% !important;
                pad
            }

            .card-komunitas {
                aspect-ratio: 6/5 !important;
            }
        }

        @media (max-width:400px) {
            .footer-container {
                padding-bottom: 4em;
            }

            .copyright {
                padding: 0em 1em;
            }

            .subs-field {
                width: 100%;
            }
        }
    </style>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>

</html>
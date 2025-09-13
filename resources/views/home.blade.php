<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Luminus | Online Learning Platform</title>
</head>
<style>
    html {
        scroll-behavior: smooth;
    }


    .scroll-up-btn {
        position: fixed;
        height: 60px;
        width: 60px;
        /* border: 2px solid #3FC351; */
        background: white;
        box-shadow: rgba(105, 110, 255, .4) 0px 7px 29px 0px;
        right: 40px;
        bottom: 40px;
        text-align: center;
        line-height: 45px;
        color: #fff;
        z-index: 999;
        font-size: 30px;
        border-radius: 50%;
        border: 2px solid transparent;
        border-bottom-width: 2px;
        opacity: 0;
        transition: all 0.2s ease-in-out;
        display: flex;
        flex-direction: column;
        justify-content: center;
        transform: translateY(20px);
        align-items: center;
        /* background-image: url(' {{ asset('images/botIcon.svg') }} ');
        background-position:center;
        background-size:cover; */
    }

    .scroll-up-btn a {
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
    }

    .scroll-up-btn img {
        width: 40px;
        height: 35px;
        position: absolute;
        z-index: 999;
        transition: 0.3s ease;
    }

    .scroll-up-btn span {
        color: white;
        opacity: 0 !important;
        transition: 0.1s ease;
        font-size: 15px;
        font-weight: 500;
        width: 100px;
    }

    .scroll-up-btn:hover img {
        position: relative;
    }

    .scroll-up-btn:hover span {
        opacity: 1 !important;
    }

    .scroll-up-btn:hover {
        cursor: pointer !important;
        transform: scale(1.1) !important;
        border: 2px solid #696EFF;
        background-color: white;
        box-shadow: none;
        /* width: 160px; */
        /* transition: width 0.3s ease; */
        /* border-radius: 5px; */
    }

    .scroll-up-btn:hover .fa-angle-up {
        color: var(--black) !important;
        animation: naikTurun .7s infinite;
        /* Panggil animasi dengan durasi 2 detik dan looping terus menerus */
    }

    /* Mendefinisikan animasi naik turun */
    @keyframes naikTurun {
        0% {
            transform: translateY(0);
            /* Posisi awal */
        }

        50% {
            transform: translateY(-7px);
            /* Posisi naik */
        }

        100% {
            transform: translateY(0);
            /* Kembali ke posisi awal */
        }
    }

    .fa-angle-up {
        color: white !important;
    }

    .scroll-up-btn i {
        color: white !important;
        font-size: 35px;
        position: absolute;
        transition: 0.1s ease !important;
    }

    .scroll-up-btn:hover i {
        opacity: 0;
    }

    .scroll-up-btn.show {
        opacity: 1;
        transform: none;
    }

    .hover-button {
        transition: .15s ease;
        border: 1px solid transparent;
    }

    .hover-button:hover {
        background: transparent;
        color: #696EFF;
        border: 1px solid;
    }

    .header-hover-button {
        transition: .15s ease;
        border: 1px solid transparent;
    }

    .header-hover-button:hover {
        background: transparent;
        color: #fff;
        border: 1px solid;
    }

    .active {
        @apply bg-gradient-to-r from-gradient-1 to-gradient-2 text-white;
    }

    body {
        background-color: #f1f2f6;
        font-family: 'Poppins', sans-serif;
    }

    #android-content::-webkit-scrollbar, #frontend-content::-webkit-scrollbar, #backend-content::-webkit-scrollbar   {
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

    /* Dropdown default style */
    #mobile-select {
        background: linear-gradient(to right, #696EFF, #F8ACFF);
        /* Set the color for bg-blue-second */
    }

    /* Option background (forced across browsers, if applicable) */
    select option {
        background-color: #052742;
        /* bg-blue-second */
        color: white;
    }

    /* Active option style (for better visibility when selected) */
    .active-option {
        font-weight: bold;
    }

    /* Button active style */
    .active {
        background: linear-gradient(to right, #696EFF, #F8ACFF);
        color: white;
    }
</style>

<body class="fontFamily">

    <!-- scroll-up button -->
    <a href="{{ '/chat' }}" class="scroll-up-btn">
        <img src="{{ asset('images/bot.png') }}" alt="">
    </a>

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
                        <li class="mx-2 text-white  font-medium" id="active-links">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="mx-2  nav-links font-medium">
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

    <section class="min-h-screen w-full overflow-hidden flex flex-col items-center">
        <div
            class="bg-blue-primary h-[80vh]  lg:h-[90vh] w-full relative md:overflow-hidden flex justify-center align-center header-responsive">
            <div class="w-[80%] h-full flex items-center justify-start header-container-responsive">
                <div class="w-[60%] text-white header-left-responsive">
                    <h1 class="text-3xl md:text-3xl lg:text-4xl font-bold mb-4 w-[80%]">Tingkatkan<span
                            class="bg-gradient-to-r from-gradient-1 to-gradient-2 text-white px-3 py-2 rounded-md mt-1 md:mt-0 ml-1 md:mb-2 mb-1 inline-block md:-rotate-0">Kemampuan</span>
                        Wujudkan Masa Depan.</h1>
                    <p class="mb-8 opacity-50 w-[70%]">Belajar coding dari nol hingga mahir bersama kami! Akses kursus
                        online interaktif kapan saja, di mana saja</p>
                    <div class="flex gap-4 items-center">
                        <a href="{{ route('courses.list') }}"
                            class="px-8 py-2 bg-gradient-to-r from-gradient-1 to-gradient-2 rounded-md font-semibold header-hover-button">Jelajahi</a>
                        <button class="px-6 py-3 text-white opacity-70"><i
                                class="fa-solid fa-circle-play pr-2"></i>Tonton
                            video</button>
                    </div>
                </div>
                <div class="w-[40%] flex justify-center align-top relative header-right-responsive ">
                    <img src="{{ asset('images/icon_2.svg') }}" alt=""
                        class="absolute left-0 top-[100px] -translate-x-16 animation-icon">
                    <img src="{{ asset('images/icon_1.svg') }}" alt=""
                        class="absolute right-0 top-[150px] translate-x-8 rotate-12 animation-icon-2">
                    <img src="{{ asset('images/heropage.png') }}" alt=""
                        class="w-full aspect-square object-contain mt-24 ">
                </div>
            </div>
        </div>
        <div
            class="w-full mt-2 md:mt-0 md:w-11/12 lg:w-10/12 md:h-24 md:-translate-y-14 bg-white md:rounded-[40px] relative z-10 md:shadow-[0px_8px_17px_0px_rgba(0,_0,_0,_0.1)] flex justify-center items-center overflow-hidden">
            <div class="flex items-center justify-start w-full animate-scroll md:justify-evenly whitespace-nowrap">
                <p class="hidden md:block font-semibold text-black opacity-50 md:text-base lg:text-lg px-4 md:px-0">
                    Supported by</p>
                <img src="{{ asset('images/google.png') }}" alt=""
                    class="w-6 h-auto object-contain mx-4 md:mx-2 lg:mx-0">
                <img src="{{ asset('images/aws.png') }}" alt=""
                    class="w-14 h-auto object-contain mx-4 md:mx-2 lg:mx-0">
                <img src="{{ asset('images/coursera.png') }}" alt=""
                    class="w-14 h-auto object-contain mx-4 md:mx-2 lg:mx-0">
                <img src="{{ asset('images/udemy.png') }}" alt=""
                    class="w-16 h-auto object-contain mx-4 md:mx-2 lg:mx-0">
                <img src="{{ asset('images/zoom.png') }}" alt=""
                    class="w-16 h-auto object-contain mx-4 md:mx-2 lg:mx-0">
                <!-- Duplicate logos for mobile scrolling only -->
                <img src="{{ asset('images/google.png') }}" alt=""
                    class="w-6 h-auto object-contain mx-4 md:hidden">
                <img src="{{ asset('images/aws.png') }}" alt=""
                    class="w-14 h-auto object-contain mx-4 md:hidden">
                <img src="{{ asset('images/coursera.png') }}" alt=""
                    class="w-16 h-auto object-contain mx-4 md:hidden">
                <img src="{{ asset('images/udemy.png') }}" alt=""
                    class="w-16 h-auto object-contain mx-4 md:hidden">
                <img src="{{ asset('images/zoom.png') }}" alt=""
                    class="w-16 h-auto object-contain mx-4 md:hidden">
            </div>
        </div>
    </section>

    <style>
        .hero-images {
            transform: translateY(3.5em) translateX(-5em);
        }

        .animation-icon {
            animation-name: iconAnimation;
            animation-duration: 4s;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
        }

        @keyframes iconAnimation {
            0% {
                transform: translateX(-64) translateY(0);
            }

            50% {
                transform: translateX(-40px) translateY(-20px);
            }

            100% {
                transform: translateX(-64px) translateY(0);
            }
        }

        .animation-icon-2 {
            animation-name: iconAnimation2;
            animation-duration: 4s;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
        }

        @keyframes iconAnimation2 {
            0% {
                transform: translateY(20px) translateX(32px) rotate(12deg);
            }

            50% {
                transform: translateX(32px) rotate(12deg);

            }

            100% {
                transform: translateY(20px) translateX(32px) rotate(12deg);
            }
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 1170px) {

            .animation-icon,
            .animation-icon-2 {
                width: 105px;
                height: 105px;
            }

            @keyframes iconAnimation {
                0% {
                    transform: translateX(-10px) translateY(-20px);
                }

                50% {
                    transform: translateX(10px) translateY(-40px);
                }

                100% {
                    transform: translateX(-10px) translateY(-20px);
                }
            }

            @keyframes iconAnimation2 {
                0% {
                    transform: translateY(0px) translateX(32px) rotate(12deg);
                }

                50% {
                    transform: translateX(32px) rotate(12deg) translateY(-20px);

                }

                100% {
                    transform: translateY(-0px) translateX(32px) rotate(12deg);
                }
            }
        }

        @media (max-width:900px) {
            .header-responsive {
                height: fit-content;
                padding-bottom: 100px;
                border: 1px solid;
                width: 100%;
            }

            .header-container-responsive {
                flex-direction: column;
                justify-content: center;
                flex-direction: column-reverse;
            }

            .animation-icon,
            .animation-icon-2 {
                display: none;
            }

            .header-left-responsive {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                text-align: left;
                margin-top: 16px;
            }

            .header-left-responsive h1 {
                padding-right: 25px;
            }

            .header-left-responsive p {
                width: 100%;
                /* max-width: 440px; */
                text-align: left;
            }

            .header-right-responsive {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .animate-scroll {
                animation: scroll 20s linear infinite;
            }
        }

        @media (max-width: 515px) {
            .header-left-responsive h1 {
                font-size: 28px;
            }
        }

        @media (max-width: 485px) {
            .header-left-responsive h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 420px) {
            .header-left-responsive h1 {
                font-size: 24px;
                line-height: 1.5
            }
        }
    </style>

    <section class="w-full py-12 flex justify-center items-center md:py-10" id="about-section">
        <div class="w-10/12 flex flex-col md:flex-row h-full justify-between items-center gap-8 about-section">
            <img src="{{ asset('images/section2.png') }}" alt=""
                class="hidden md:flex w-half max-w-[33rem] aspect-square about-desktop-image">
            <img src="{{ asset('images/mobileSection2.png') }}" alt=""
                class="w-full md:hidden flex max-w-[33rem] aspect-auto">
            <div class="w-full md:w-1/2 h-full text-left p-4 md:p-10 about-text-container">
                <span class="text-gradient-1 font-medium text-lg">Tentang</span>
                <h1 class="font-semibold text-2xl md:text-3xl w-full md:w-full mt-2">Penyedia kursus Online Terbaik
                </h1>
                <p class="opacity-50 text-black mt-4 md:mt-6">Kami adalah platform terbaik untuk belajar coding online,
                    menawarkan materi terkini, bimbingan profesional, dan pengalaman belajar yang interaktif.</p>
                <div
                    class="flex flex-col md:flex-row mt-12 md:mt-14 justify-evenly items-center bg-blue-second text-white rounded-2xl shadow-[0px_8px_17px_0px_rgba(0,_0,_0,_0.2)]">
                    <div
                        class="w-full md:w-28 py-8 md:aspect-square flex items-center justify-center border-b-2 border-gray-400 md:border-none">
                        <div
                            class="flex flex-row md:flex-col md:gap-1 w-10/12 md:w-auto justify-between md:justify-center items-center md:items-baseline text-center">
                            <h1 class="text-2xl font-bold">50+</h1>
                            <p class="text-base md:text-sm">Instruktur</p>
                        </div>
                    </div>
                    <div
                        class="w-full md:w-28 py-4 md:aspect-square flex items-center justify-center border-b-2 border-gray-400 md:border-none">
                        <div
                            class="flex flex-row md:flex-col gap-1 w-10/12 md:w-auto justify-between md:justify-center items-center md:items-baseline text-center">
                            <h1 class="text-2xl font-bold">400+</h1>
                            <p class="text-base md:text-sm">Kursus</p>
                        </div>
                    </div>
                    <div class="w-full md:w-28 py-4 md:aspect-square flex items-center justify-center">
                        <div
                            class="flex flex-row md:flex-col gap-1 w-10/12 md:w-auto justify-between md:justify-center items-center md:items-baseline text-center">
                            <h1 class="text-2xl font-bold">40+</h1>
                            <p class="text-base md:text-sm">Proyek Nyata</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @media (max-width: 900px) {
            .about-section {
                flex-direction: column;
            }

            .about-desktop-image {
                max-width: none;
                width: 100%;
            }

            .about-text-container {
                width: 100%;
                text-align: left;
                justify-content: flex-start;
                align-items: flex-start;
                padding: 0;
            }

        }
    </style>

    <!-- Slider Section -->
    <section class="blog-section" id="kursus-section">
        <div class="blog-container">
            <div class="blog-header">
                <div class="blog-left">
                    <h2>Kursus</h2>
                    <p>Kursus Terpopuler</p>
                </div>
                <div class="blog-right">
                    <a href="{{ '/kursus' }}"> <button class="hover-button">Lihat Semua</button> </a>
                </div>
            </div>

            <div class="blog-cards swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($courses as $course)
                        <div class="blog-card swiper-slide">
                            <img src="{{ asset('storage/' . $course->image_url) }}" alt="course">
                            <div class="blog-content">
                                <div class="flex gap-4 mt-4 text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-clock text-gradient-1"></i>
                                        <span>{{ $course->duration }} jam</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-video text-gradient-1"></i>
                                        <span>{{ $course->video_count }} Modul</span>
                                    </div>
                                </div>

                                <p>{{ $course->title }}</p>

                                <div class="mt-4">
                                    @if ($course->discounted_price)
                                        <span class="line-through" style="color: #E63946">Rp.
                                            {{ number_format($course->original_price, 0, ',', '.') }}</span>
                                        <span class="font-semibold text-lg ml-2">Rp.
                                            {{ number_format($course->discounted_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="font-semibold text-lg ml-2">Rp.
                                            {{ number_format($course->original_price, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                <div class="mt-8">
                                    {{-- <a href="{{ route('payment.form', $course->id) }}" class="px-6 py-3 rounded-lg bg-[#696EFF] text-white mt-8">Beli
                                        Kursus</a> --}}
                                    @if (Auth::check() && Auth::user()->enrolledCourses->contains($course->id))
                                        <a href="{{ route('siswa.courses.show', $course->id) }}"
                                            class="px-6 py-3 rounded-lg bg-[#696EFF] text-white font-medium mt-8">Lanjut
                                            Pelajari</a>
                                    @else
                                        <a href="{{ route('payment.form', $course->id) }}"
                                            class="px-6 py-3 font-medium rounded-lg bg-[#696EFF] text-white mt-8">Beli
                                            Kursus</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev prev-buttom"></div>
                <div class="swiper-button-next next-buttom"></div>
            </div>
        </div>
    </section>

    <style>
        .blog-section {
            width: 100%;
            /* height: 100vh; */
            padding: 100px 0;
            background-color: #f1f2f6;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .blog-container {
            width: 85%;
            padding: 15px 0;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow-x: hidden;
        }

        .blog-section .swiper-container {
            width: 80vw;
        }

        .blog-header {
            width: 94%;
            margin: 0 auto;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .blog-left h2 {
            font-size: 18px;
            font-weight: 500;
            /* background-color: var(--green);
    width: 12%; */
            color: #696EFF;
        }

        .blog-left p {
            font-size: 30px;
            font-weight: 600;
            color: var(--black);
        }

        .blog-right button {
            background-color: #696EFF;
            color: #fff;
            border: none;
            font-weight: 500;
            padding: 10px 40px;
            border-radius: 10px;
            font-size: 18px !important;
            cursor: pointer;
            font-size: var(--descText);
        }

        .blog-cards {
            width: 100%;
        }

        .blog-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: rgba(149, 157, 165, 0.05) 0px 8px 24px;
            width: calc(33.333% - 20px);
            padding: 20px 0 16px 0;
        }

        .blog-card img {
            width: 90%;
            margin: 0 auto;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 10px
        }


        .blog-content {
            padding: 10px 0 20px 20px;
        }

        .blog-content h4 {
            font-size: 16px;
            color: var(--black);
            margin-bottom: 10px;
            margin-top: 10px;
            font-weight: 400;
            opacity: .4;
            text-align: left;
        }

        .blog-content p {
            font-size: 18px;
            color: var(--black);
            font-weight: 500;
            text-align: left;
            margin-top: 16px
        }

        .baca-lengkap {
            font-size: 16px;
            font-weight: 400;
            color: #3A86FF !important;
            opacity: .8;
            text-decoration: underline;
            display: flex;
            align-items: center;
        }

        .baca-lengkap span {
            font-size: var(--descText);
            margin-left: 10px;
            transition: margin-left 0.1s;
        }

        .baca-lengkap:hover span {
            margin-left: 15px;
        }

        .swiper-container {
            position: relative;
            width: 100%;
        }

        .prev-buttom::after,
        .next-buttom::after {
            font-size: 18px;
        }


        .prev-buttom {
            color: #ffff;
            width: 40px;
            padding: 25px;
            height: 40px;
            z-index: 10;
            background-color: #696EFF;
            border: 5px solid #f1f2f6;
            border-radius: 50%;
            transform: translateX(-40px);
        }

        .next-buttom {
            color: #ffffff;
            width: 40px;
            padding: 25px;
            height: 40px;
            z-index: 10;
            background-color: #696EFF;
            border: 5px solid #f1f2f6;
            border-radius: 50%;
            transform: translateX(40px);
        }

        .prev-buttom,
        .next-buttom {
            transition: .1s ease;
        }

        .prev-buttom:active {
            transform: scale(0.8) translateX(-50px);
        }

        .next-buttom:active {
            transform: scale(0.8) translateX(50px);
        }

        .prev-buttom:hover,
        .next-buttom:hover {
            background: white;
            border: 2px solid #696EFF;
            color: #696EFF !important;
        }

        @media (max-width: 1024px) {
            .blog-container {
                /* border: 1px solid; */
                width: 83%;
            }

            .blog-section .swiper-container {
                width: 50vw;
                /* background-color: blue; */
            }

            .prev-buttom {
                transform: translateX(-150px);
            }

            .next-buttom {
                transform: translateX(150px);
            }
        }

        @media (max-width: 768px) {
            .blog-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .blog-section {
                height: 100%;
                padding: 100px 0 50px 0;
            }

            .blog-left {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin-bottom: 10px;
            }

            .blog-left h2,
            .blog-left p {
                width: fit-content;
                margin: 0;
            }

            .blog-right {
                margin-top: 10px;
            }

            .blog-container {
                width: 80%;
            }

            .blog-section .swiper-container {
                width: 70vw;
            }

            .prev-buttom {
                transform: translateX(-40px);
            }

            .next-buttom {
                transform: translateX(40px);
            }
        }

        :root {
            --titleText: 38px;
            --descText: 20px;
            --black: #101010;
            --whiteBg: #F1F5FC;
            --whiteContent: #fff;
            --green: #ADECDA;
            --full: 100%;
            --container: 80%;
            --radius: 15px;
            --screen: 100vh;
        }
    </style>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var blogSwiper = new Swiper(".blog-cards", {
            slidesPerView: 1,
            centeredSlides: true,

            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
    </script>

    <div class="w-full min-h-screen bg-blue-second flex flex-col justify-center items-center py-12"
        id="rutekarir-section">
        <div class="w-10/11 flex flex-col justify-center items-center pb-14 roadmap-section">
            <div class="flex flex-col text-center items-center gap-3">
                <span
                    class="bg-gradient-to-r from-gradient-1 to-gradient-2 text-transparent bg-clip-text text-lg font-medium w-fit">
                    Rute Karir
                </span>
                <h1 class="text-white font-semibold text-2xl md:text-3xl">Mulai Langkah Menuju Karir Impian</h1>
            </div>

            <div class="p-2 rounded-lg bg-blue-button flex items-center mt-8 road-tag-wrapper">
                <div class="hidden md:flex gap-3">
                    <button onclick="showContent('android')"
                        class="active bg-blue-second rounded-md px-5 py-2 text-white font-medium">
                        Web Developer
                    </button>
                    <button onclick="showContent('frontend')"
                        class="bg-blue-second rounded-md px-5 py-2 text-white font-medium">
                        Front-End Developer
                    </button>
                    <button onclick="showContent('backend')"
                        class="bg-blue-second rounded-md px-5 py-2 text-white font-medium">
                        Back-End Developer
                    </button>
                    <button onclick="showContent('cybersecurity')"
                        class="bg-blue-second rounded-md px-5 py-2 text-white font-medium">
                        Cyber Security
                    </button>
                </div>

                <div class="md:hidden w-full">
                    <select id="mobile-select" onchange="showContent(this.value)"
                        class="w-full bg-blue-second rounded-md px-4 py-4 text-white font-medium flex justify-center items-center text-left">
                        <option value="android">Web Developer</option>
                        <option value="frontend">Front-End Developer</option>
                        <option value="backend">Back-End Developer</option>
                        <option value="cybersecurity">Cyber Security</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="w-full mt-4 pl-7 md:px-0">

            <div id="android-content" class="w-full h-fit flex overflow-x-scroll pb-8">
                <div class="w-fit md:ml-60 ml-12 gap-x-5">
                    <div class="w-full h-full">
                        <div class="progress-line w-full h-1 bg-white mt-3 mb-14 relative flex gap-x-4 ml-28">
                            <div class="progressDotWrapper pr-40 md:pr-16 flex items-center justify-center">
                                <div class="progressDot w-3 h-3 bg-white rounded-full border-2 border-gradient-1">
                                </div>
                            </div>
                            {{-- progress dot --}}
                        </div>
                        <div class="flex justify-between gap-x-5 -translate-x-12 md:-translate-x-32 content-card">
                            {{-- card --}}
                        </div>
                    </div>
                </div>
            </div>

            <div id="frontend-content" class="w-full h-fit overflow-x-scroll pb-8 hidden">
                <div class="w-fit md:ml-60 ml-12 gap-x-5">
                    <div class="w-full h-full">
                        <div class="progress-line w-full h-1 bg-white mt-3 mb-14 relative flex gap-x-4 ml-28">
                            <div class="progressDotWrapper  pr-40 md:pr-16 flex items-center justify-center">
                                <div class="progressDot w-3 h-3 bg-white rounded-full border-2 border-gradient-1">
                                </div>
                            </div>
                            {{-- progress dot --}}
                        </div>
                        <div class="flex justify-between gap-x-5 -translate-x-12 md:-translate-x-32 content-card ">
                            {{-- card --}}
                        </div>
                    </div>
                </div>
            </div>

            <div id="backend-content" class="w-full h-fit overflow-x-scroll pb-8 hidden ">
                <div class="w-fit md:ml-60 ml-12 gap-x-5">
                    <div class="w-full h-full">
                        <div class="progress-line w-full h-1 bg-white mt-3 mb-14 relative flex gap-x-4 ml-28">
                            <div class="progressDotWrapper pr-40 md:pr-16 flex items-center justify-center">
                                <div class="progressDot w-3 h-3 bg-white rounded-full border-2 border-gradient-1">
                                </div>
                            </div>
                            {{-- progress dot --}}
                        </div>
                        <div class="flex justify-between gap-x-5 -translate-x-12 md:-translate-x-32 content-card">
                            {{-- card --}}
                        </div>
                    </div>
                </div>
            </div>

            <div id="cybersecurity-content"
                class="w-full h-fit overflow-x-scroll pb-8 hidden [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                <div class="w-fit md:ml-60 ml-12 gap-x-5">
                    <div class="w-full h-full">
                        <div class="progress-line w-full h-1 bg-white mt-3 mb-14 relative flex gap-x-4 ml-28">
                            <div class="progressDotWrapper pr-40 md:pr-16 flex items-center justify-center">
                                <div class="progressDot w-3 h-3 bg-white rounded-full border-2 border-gradient-1">
                                </div>
                            </div>
                            {{-- progress dot --}}
                        </div>
                        <div class="flex justify-between gap-x-5 -translate-x-12 md:-translate-x-32 content-card">
                            {{-- card --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const coursesAndroid = [{
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Introduction to HTML, CSS dan JavaScript",
                originalPrice: "Rp. 399,000",
                discountedPrice: "Rp. 99,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Front-End Website Development",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Building A Responsive Website Design",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Intermediate JavaScript",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Version Control and Collaboration",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Backend Development",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Modern Frontend Frameworks",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Full-Stack Development",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/lmsjs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Advanced Topics in Web Development",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            // Add more course objects as needed
        ];

        const coursesFrontend = [{
                image: "{{ asset('images/fe.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Pengantar Pengembangan Website",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/fe.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Advanced CSS",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            }, {
                image: "{{ asset('images/fe.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "JavaScript ES6+",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            }, {
                image: "{{ asset('images/fe.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Frontend Frameworks",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            }, {
                image: "{{ asset('images/fe.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Testing Frontend",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            }, {
                image: "{{ asset('images/fe.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Responsive and Accessibility",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            }, {
                image: "{{ asset('images/fe.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Frontend Optimization",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
        ];

        const coursesBackend = [{
                image: "{{ asset('images/be.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Pengantar Pengembangan Backend",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/be.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Authentication and Authorization",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/be.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Database Management",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/be.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Building RESTful APIs",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/be.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Testing and Debugging",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
        ]

        const coursesCybersecurity = [{
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Pengantar Cyber Security",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Networking Basics",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Operating Systems and Scripting",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Web Application Security",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Cryptography Basics",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Penetration Testing",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Incident Response",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Security Standards",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },
            {
                image: "{{ asset('images/cs.png') }}",
                duration: "12 Jam",
                modules: "6 Modul",
                title: "Advanced Topics",
                originalPrice: "Rp. 550,000",
                discountedPrice: "Rp. 299,000"
            },

        ]



        function renderCourses(containerId, courses) {
            const container = document.querySelector(`#${containerId} .content-card`);
            container.innerHTML = ''; // Clear previous content

            courses.forEach(course => {
                const card = document.createElement('div');
                card.classList.add('bg-white', 'rounded-xl', 'max-h-[25rem]', 'h-[25rem]', 'aspect-[4/5]', 'flex',
                    'flex-col', 'p-4');

                card.innerHTML = `
			<div class="w-full aspect-video"><img src="${course.image}" class="w-full h-full rounded-xl" alt=""></div>
			<div class="w-full h-half flex flex-col items-center pt-5 pb-3 justify-between">
				<div class="w-full flex items-center gap-x-4">
					<h1 class="text-sm font-normal text-text-base flex gap-x-2 items-center justify-center">
						<i class="fa-regular fa-clock text-gradient-1 font-normal opacity-100"></i>
						<span class="opacity-60">${course.duration}</span>
					</h1>
					<h1 class="text-sm font-normal text-text-base flex gap-x-2 items-center justify-center">
                        <i class="fa-solid fa-video" style="color:#696EFF"></i>					
						<span class="opacity-60">${course.modules}</span>
					</h1>
				</div>
				<h1 class="text-lg font-medium text-text-base w-full text-left">${course.title}</h1>
				<div class="w-full flex items-center gap-x-2 text-md">
					<span class="line-through text-text-red opacity-80 font-semibold">${course.originalPrice}</span>
					<span class="text-black opacity-80 font-bold">${course.discountedPrice}</span>
				</div>
			</div>
		`;

                container.appendChild(card);
            });
        }

        // Render courses for each content section
        renderCourses('android-content', coursesAndroid);
        renderCourses('frontend-content', coursesFrontend);
        renderCourses('backend-content', coursesBackend);
        renderCourses('cybersecurity-content', coursesCybersecurity);


        function createProgressDots(containerId, courses) {
            const progressLine = document.querySelector(`#${containerId} .progress-line`);
            if (!progressLine) return; // Ensure the progress line element exists

            const existingDots = progressLine.querySelectorAll('.progressDotWrapper');
            const existingDotsCount = existingDots.length;
            const coursesCount = courses.length;

            // Add new progress dots if needed
            for (let i = existingDotsCount; i < coursesCount; i++) {
                const progressDotWrapper = document.createElement('div');
                const progressDot = document.createElement('div');
                progressDotWrapper.classList.add('w-[20rem]', 'flex', 'items-center', 'justify-center');
                progressDot.classList.add('w-3', 'h-3', 'bg-white', 'rounded-full', 'border-2', 'border-gradient-1');
                progressDotWrapper.appendChild(progressDot);
                progressLine.appendChild(progressDotWrapper);
            }
        }

        createProgressDots('android-content', coursesAndroid);
        createProgressDots('frontend-content', coursesFrontend);
        createProgressDots('backend-content', coursesBackend);
        createProgressDots('cybersecurity-content', coursesCybersecurity);
    </script>


    <script>
        // Function to handle showing content and applying active class
        function showContent(contentId) {
            // Hide all content divs
            document.querySelectorAll('[id$="-content"]').forEach(div => {
                div.classList.add('hidden');
            });

            // Remove active class from all buttons
            document.querySelectorAll('.bg-blue-second').forEach(button => {
                button.classList.remove('active');
            });

            // Show selected content
            document.getElementById(contentId + '-content').classList.remove('hidden');


            // Handle button click
            const clickedButton = event.target.closest('button');
            if (clickedButton) {
                clickedButton.classList.add('active');
            }

            // Handle mobile select
            const mobileSelect = document.getElementById('mobile-select');
            if (mobileSelect) {
                const options = mobileSelect.querySelectorAll('option');
                options.forEach(option => option.classList.remove('active-option'));
                mobileSelect.querySelector(`option[value="${contentId}"]`).classList.add('active-option');
            }

            // Save the selected contentId in localStorage
            localStorage.setItem('activeContent', contentId);
        }

        // Function to restore the active content
        function restoreActiveContent() {
            const savedContentId = localStorage.getItem('activeContent');
            if (savedContentId) {
                // Restore active content
                document.querySelectorAll('[id$="-content"]').forEach(div => {
                    div.classList.add('hidden');
                });
                document.getElementById(savedContentId + '-content').classList.remove('hidden');

                // Restore active button or option based on screen size
                if (window.innerWidth >= 768) { // Desktop view
                    document.querySelectorAll('.bg-blue-second').forEach(button => {
                        button.classList.remove('active');
                    });
                    const activeButton = document.querySelector(`button[onclick="showContent('${savedContentId}')"]`);
                    if (activeButton) {
                        activeButton.classList.add('active');
                    }
                } else { // Mobile view
                    const mobileSelect = document.getElementById('mobile-select');
                    if (mobileSelect) {
                        mobileSelect.value = savedContentId;
                    }
                }
            }
        }

        // Listen for window resize to reapply active classes
        window.addEventListener('resize', restoreActiveContent);

        // Call restoreActiveContent when the page loads
        document.addEventListener('DOMContentLoaded', restoreActiveContent);
    </script>


    <style>
        @media (max-width: 1030px) {
            .roadmap-section {
                width: 100%;
            }

            .road-tag-wrapper {
                width: 80%;
            }
        }
    </style>


    <section class="w-full py-20 flex justify-center items-center">
        <div class="w-10/12 flex flex-col">
            <!-- Header -->
            <div>
                <span class="text-[#696EFF] font-medium">Testimoni</span>
                <h1 class="font-semibold text-2xl md:text-3xl mt-2">Apa Kata Mereka ?</h1>
            </div>

            <!-- Testimonial Cards Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                <!-- Testimonial Card 1 -->
                <div class="bg-white p-8 rounded-xl">
                    <!-- Stars -->
                    <div class="flex gap-1 mb-6">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                    </div>

                    <!-- Testimonial Text -->
                    <p class="text-gray-600 mb-8 min-h-[120px]">
                        Belajar coding di sini seru banget! Materinya <b> simpel tapi mendalam </b>, bikin aku ngerti
                        backend dan frontend sekaligus. Nggak nyangka bisa sejauh ini!
                    </p>

                    <!-- Profile -->
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/profile.jpg') }}" alt="profile"
                            class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h3 class="font-semibold">David</h3>
                            <p class="text-gray-500 text-sm">Full-Stack Javascript</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="bg-white p-8 rounded-xl">
                    <!-- Stars -->
                    <div class="flex gap-1 mb-6">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star-outline.svg') }}" alt="star" class="w-5 h-5">
                    </div>

                    <!-- Testimonial Text -->
                    <p class="text-gray-600 mb-8 min-h-[120px]">
                        Materinya <b> bagus dan mudah dipahami </b>, tapi ada beberapa bagian yang bisa lebih detail.
                        Overall, pengalaman belajarnya memuaskan dan bermanfaat!
                    </p>

                    <!-- Profile -->
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/profile2.jpg') }}" alt="profile"
                            class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h3 class="font-semibold">Jason</h3>
                            <p class="text-gray-500 text-sm">Front-End Beginner</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Card 3 -->
                <div class="bg-white p-8 rounded-xl">
                    <!-- Stars -->
                    <div class="flex gap-1 mb-6">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                    </div>

                    <!-- Testimonial Text -->
                    <p class="text-gray-600 mb-8 min-h-[120px]">
                        Pengalamanku belajar di sini luar biasa! Dari nol sampai paham coding backend dan frontend, <b>
                            semuanya disusun rapi dan gampang dipahami </b>. Highly recommended!
                    </p>

                    <!-- Profile -->
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/profile3.jpg') }}" alt="profile"
                            class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h3 class="font-semibold">Andrew</h3>
                            <p class="text-gray-500 text-sm">Backend Expert</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="w-full min-h-screen flex justify-center items-center pt-10 md:pb-32 pb-16">
        <div class="flex flex-col w-10/12 justify-center items-center h-full">

            <div class="flex flex-col text-center items-center justify-center">
                <span class="text-gradient-1 text-lg font-medium">Berlangganan</span>
                <h1 class="text-black text-2xl md:text-3xl font-semibold mt-2">Langkah Terbaik untuk <br> Memaksimalkan
                    Potensi
                    Belajarmu.
                </h1>
            </div>

            <div class="w-full min-h-[35rem]  flex flex-col md:flex-row justify-center items-center gap-4 mt-12">

                <div
                    class="flex flex-col px-5 py-3 max-w-80 w-80 max-h-[30rem] h-[28rem] shadow-md rounded-2xl bg-white justify-between">

                    <div class="flex flex-col">
                        <h1 class="font-bold text-black text-2xl mb-1">Biasa</h1>
                        <p class="text-gradient-1 text- font-semibold">Rp . 0 <span
                                class="text-gray-400 text-sm">/Bulan</span>
                        </p>
                    </div>

                    <ul class="font-normal text-[#101010] text-base flex flex-col gap-y-2">
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Akses Materi Dasar</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Grup Diskusi</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Progress Tracking</p>
                        </li>
                        <li class="flex items-center gap-x-2 text-gray-400 "><i class="fa-solid fa-check"></i>
                            <p class="line-through decoration-1">Akses Materi Lanjutan</p>
                        </li>
                        <li class="flex items-center gap-x-2 text-gray-400 "><i class="fa-solid fa-check"></i>
                            <p class="line-through decoration-1">Konsultasi Dengan Mentor</p>
                        </li>
                        <li class="flex items-center gap-x-2 text-gray-400"><i class="fa-solid fa-check"></i>
                            <p class="line-through decoration-1">Akses Selamanya</p>
                        </li>
                        <li class="flex items-center gap-x-2 text-gray-400"><i class="fa-solid fa-check"></i>
                            <p class="line-through decoration-1">Kelas Live Eksklusif</p>
                        </li>
                    </ul>

                    <button
                        class="w-full rounded-lg font-semibold flex items-center justify-center h-11 bg-gradient-1 text-white mb-2">
                        Pilih
                    </button>

                </div>

                <div
                    class="flex
													flex-col px-5 py-3 max-w-80 w-80 max-h-[35rem] h-[35rem] shadow-md md:shadow-lg rounded-2xl bg-gradient-1 justify-between">
                    <div class="flex flex-col">
                        <h1 class="font-bold text-white text-2xl mb-1">Murid</h1>
                        <p class="text-white text- font-semibold">Rp . 150,000 <span
                                class="text-gray-200 text-sm">/Bulan</span>
                        </p>
                    </div>

                    <ul class="font-normal text-white text-base flex flex-col gap-y-2 h-80">
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Akses Materi Dasar</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Grup Diskusi</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Progress Tracking</p>
                        </li>
                        <li class="flex items-center gap-x-2 "><i class="fa-solid fa-check"></i>
                            <p>Akses Materi Lanjutan</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Konsultasi Dengan Mentor</p>
                        </li>
                        <li class="flex items-center gap-x-2 opacity-40"><i class="fa-solid fa-check"></i>
                            <p class="line-through decoration-1">Akses Selamanya</p>
                        </li>
                        <li class="flex items-center gap-x-2 opacity-40"><i class="fa-solid fa-check"></i>
                            <p class="line-through decoration-1">Kelas Live Eksklusif</p>
                        </li>
                    </ul>

                    <button
                        class="w-full rounded-lg font-semibold flex items-center justify-center h-11 bg-white text-gradient-1 mb-2">
                        Pilih
                    </button>
                </div>

                <div
                    class="flex flex-col px-5 py-3 max-w-80 w-80 max-h-[30rem] h-[28rem] shadow-md rounded-2xl bg-white justify-between">


                    <div class="flex flex-col">
                        <h1 class="font-bold text-black text-2xl mb-1">Profesional</h1>
                        <p class="text-gradient-1 text- font-semibold">Rp . 1.500,000<span
                                class="text-gray-400 text-sm">/Pengguna</span>
                        </p>
                    </div>

                    <ul class="font-normal text-[#101010] text-base flex flex-col gap-y-2">
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Akses Materi Dasar</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Grup Diskusi</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Progress Tracking</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Akses Materi Lanjutan</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Konsultasi Dengan Mentor</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Akses Selamanya</p>
                        </li>
                        <li class="flex items-center gap-x-2"><i class="fa-solid fa-check"></i>
                            <p>Kelas Live Eksklusif</p>
                        </li>
                    </ul>

                    <button
                        class="w-full rounded-lg font-semibold flex items-center justify-center h-11 bg-gradient-1 text-white mb-2">
                        Pilih
                    </button>




                </div>

            </div>
        </div>
    </div>


    <div class="w-full bg-blue-primary flex flex-col items-center py-24 justify-center" id="faq-section">

        <div class="w-10/12 flex flex-col h-full items-center justify-center">

            <div class="flex flex-col items-center justify-center text-center">
                <span
                    class="bg-gradient-to-r from-gradient-1 to-gradient-2 text-transparent bg-clip-text text-lg md:text-lg font-medium">FAQ</span>
                <h1 class="font-semibold text-2xl md:text-3xl text-white mt-2">Pertanyaan yang Sering Diajukan</h1>
            </div>

            <div class="w-full h-auto p-3 flex items-center justify-center">

                <div class="accordion w-full max-w-3xl mt-6 text-white flex flex-col items-center">
                    <div class="accordion-content w-full my-2 rounded-lg bg-blue-second overflow-hidden">
                        <header
                            class="flex items-center min-h-12 px-6 py-4 cursor-pointer transition-all duration-200 gap-5">
                            <i class="fa-solid fa-plus text-2xl"></i>
                            <span class="title text-base md:text-lg font-medium">Apakah kursus ini cocok untuk pemula
                                tanpa pengalaman coding?</span>
                        </header>
                        <p
                            class="description h-0 opacity-60 text-sm font-normal pl-16 md:pl-14 pr-4 transition-all duration-200">
                            Ya, tentu saja! Kami memiliki kursus yang dirancang khusus untuk pemula. Anda akan belajar
                            dari dasar, mulai dari konsep pemrograman dasar hingga praktik coding yang lebih kompleks.
                        </p>
                    </div>
                    <div class="accordion-content w-full my-2 rounded-lg bg-blue-second overflow-hidden">
                        <header
                            class="flex items-center min-h-12 px-6 py-4  cursor-pointer transition-all duration-200 gap-5">
                            <i class="fa-solid fa-plus text-2xl"></i>
                            <span class="title text-base md:text-lg font-medium">Apakah saya mendapatkan sertifikat
                                setelah menyelesaikan kursus?</span>
                        </header>
                        <p
                            class="description h-0 opacity-60 text-sm font-normal pl-16 md:pl-14 pr-4 transition-all duration-200">
                            Ya, setelah menyelesaikan kursus dan lulus evaluasi, Anda akan mendapatkan sertifikat
                            elektronik yang dapat digunakan untuk menambah nilai pada portofolio Anda.</p>
                    </div>
                    <div class="accordion-content w-full my-2 rounded-lg bg-blue-second overflow-hidden">
                        <header
                            class="flex items-center min-h-12 px-6 py-4  cursor-pointer transition-all duration-200 gap-5">
                            <i class="fa-solid fa-plus text-2xl"></i>
                            <span class="title text-base md:text-lg font-medium">Bagaimana jika saya mengalami
                                kesulitan selama belajar?</span>
                        </header>
                        <p
                            class="description h-0 opacity-60 text-sm font-normal pl-16 md:pl-14 pr-4 transition-all duration-200">
                            Jika Anda mengalami kesulitan, Anda dapat bergabung di forum diskusi komunitas kami atau
                            menghubungi mentor
                            kami.</p>
                    </div>
                    <div class="accordion-content w-full my-2 rounded-lg bg-blue-second overflow-hidden">
                        <header
                            class="flex items-center min-h-12 px-6 py-4  cursor-pointer transition-all duration-200 gap-5">
                            <i class="fa-solid fa-plus text-2xl"></i>
                            <span class="title text-base md:text-lg font-medium">Apakah ada mentor yang membantu selama
                                proses belajar?</span>
                        </header>
                        <p
                            class="description h-0 opacity-60 text-sm font-normal pl-16 md:pl-14 pr-4 transition-all duration-200">
                            Ya, untuk kursus premium, Anda akan mendapatkan dukungan dari mentor berpengalaman yang siap
                            membantu menjawab pertanyaan dan memberikan feedback.</p>
                    </div>
                </div>

            </div>


        </div>

    </div>

    <script>
        document.querySelectorAll(".accordion-content header").forEach((header, index) => {
            header.addEventListener("click", () => {
                const content = header.parentElement;
                const description = content.querySelector(".description");
                const isOpen = content.classList.toggle("open");

                description.style.height = isOpen ? `${description.scrollHeight}px` : "0px";
                if (isOpen) {
                    description.classList.add("mb-4", "pb-4");
                } else {
                    description.classList.remove("mb-4", "pb-4");
                }

                header.querySelector("i").classList.toggle("fa-plus", !isOpen);
                header.querySelector("i").classList.toggle("fa-minus", isOpen);

                document.querySelectorAll(".accordion-content").forEach((otherContent, otherIndex) => {
                    if (index !== otherIndex) {
                        otherContent.classList.remove("open");
                        const otherDescription = otherContent.querySelector(".description");
                        otherDescription.classList.remove("mb-4", "pb-4");
                        otherDescription.style.height = "0px";
                        otherContent.querySelector("i").classList.add("fa-plus");
                        otherContent.querySelector("i").classList.remove("fa-minus");
                    }
                });
            });
        });
    </script>


    <div class="w-full md:h-[80vh] h-[50vh]  flex flex-col justify-center items-center  ">
        <div class="h-full w-10/12 flex md:flex-row flex-col justify-center items-center">

            <div class="flex flex-col gap-y-2 w-full md:w-half justify-center">
                <span class="text-gradient-1 text-sm">
                    Forum
                </span>
                <h1 class="text-2xl md:text-3xl font-semibold "> Diskusi Komunitas </h1>
                <p class="text-gray-500 w-10/12">Ajukan pertanyaan, berbagi wawasan, dan diskusikan materi dengan
                    komunitas
                    untuk memperdalam ilmu dan wawasan kamu</p>
                <a href="{{ route('forums.index') }}"
                    class=" rounded-lg font-semibold flex items-center justify-center px-12 py-2 w-fit bg-gradient-1 text-white mt-5 hover-button">
                    Mulai
                </a>
            </div>


            <div class="h-half hidden  md:h-full md:flex justify-center items-center w-full md:w-half overflow-hidden">

                <div
                    class="w-full md:w-half md:h-[160%] card-section-komunitas-tablet flex flex-col items-center gap-y-4 md:pl-10">

                    <div class="w-full max-w-72 aspect-square rounded-2xl bg-white flex flex-col p-6 card-komunitas">
                        <div class="w-full h-[70%]">
                            <p class="w-full text-[#101010] font-base opacity-60 text-lg">
                                " Materinya lengkap dan mudah dipahami. Sangat cocok untuk pemula hingga mahir!. ”
                            </p>
                        </div>
                        <div class="w-full h-[30%] flex items-center">
                            <img src="{{ asset('images/dummyFaq.png') }}" alt="" class="w-10 aspect-square">
                            <div class="h-full flex flex-col justify-center pl-5">
                                <h1 class="text-lg">Angga Puspa</h1>
                                <p class="text-gray-400 opacity-80">Full Stack Javascript</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full max-w-72 aspect-square rounded-2xl bg-white flex flex-col p-6 card-komunitas">
                        <div class="w-full h-[70%]">
                            <p class="w-full text-[#101010] font-base opacity-60 text-lg">
                                " Materinya lengkap dan mudah dipahami. Sangat cocok untuk pemula hingga mahir!. ”
                            </p>
                        </div>
                        <div class="w-full h-[30%] flex items-center">
                            <img src="{{ asset('images/dummyFaq.png') }}" alt="" class="w-10 aspect-square">
                            <div class="h-full flex flex-col justify-center pl-5">
                                <h1 class="text-lg">Angga Puspa</h1>
                                <p class="text-gray-400 opacity-80">Full Stack Javascript</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full max-w-72 aspect-square rounded-2xl bg-white flex flex-col p-6 card-komunitas">
                        <div class="w-full h-[70%]">
                            <p class="w-full text-[#101010] font-base opacity-60 text-lg">
                                " Materinya lengkap dan mudah dipahami. Sangat cocok untuk pemula hingga mahir!. ”
                            </p>
                        </div>
                        <div class="w-full h-[30%] flex items-center">
                            <img src="{{ asset('images/dummyFaq.png') }}" alt="" class="w-10 aspect-square">
                            <div class="h-full flex flex-col justify-center pl-5">
                                <h1 class="text-lg">Angga Puspa</h1>
                                <p class="text-gray-400 opacity-80">Full Stack Javascript</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div
                    class="w-full md:hidden lg:flex pl-[8px] translate-y-[100px] md:w-half md:h-[160%] card-section-komunitas-tablet flex flex-col items-center gap-y-4">

                    <div class="w-full max-w-72 aspect-square rounded-2xl bg-white flex flex-col p-6 card-komunitas">
                        <div class="w-full h-[70%]">
                            <p class="w-full text-[#101010] font-base opacity-60 text-lg">
                                " Materinya lengkap dan mudah dipahami. Sangat cocok untuk pemula hingga mahir!. ”
                            </p>
                        </div>
                        <div class="w-full h-[30%] flex items-center">
                            <img src="{{ asset('images/dummyFaq.png') }}" alt="" class="w-10 aspect-square">
                            <div class="h-full flex flex-col justify-center pl-5">
                                <h1 class="text-lg">Angga Puspa</h1>
                                <p class="text-gray-400 opacity-80">Full Stack Javascript</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full max-w-72 aspect-square rounded-2xl bg-white flex flex-col p-6 card-komunitas">
                        <div class="w-full h-[70%]">
                            <p class="w-full text-[#101010] font-base opacity-60 text-lg">
                                " Materinya lengkap dan mudah dipahami. Sangat cocok untuk pemula hingga mahir!. ”
                            </p>
                        </div>
                        <div class="w-full h-[30%] flex items-center">
                            <img src="{{ asset('images/dummyFaq.png') }}" alt="" class="w-10 aspect-square">
                            <div class="h-full flex flex-col justify-center pl-5">
                                <h1 class="text-lg">Angga Puspa</h1>
                                <p class="text-gray-400 opacity-80">Full Stack Javascript</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full max-w-72 aspect-square rounded-2xl bg-white flex flex-col p-6 card-komunitas">
                        <div class="w-full h-[70%]">
                            <p class="w-full text-[#101010] font-base opacity-60 text-lg">
                                " Materinya lengkap dan mudah dipahami. Sangat cocok untuk pemula hingga mahir!. ”
                            </p>
                        </div>
                        <div class="w-full h-[30%] flex items-center">
                            <img src="{{ asset('images/dummyFaq.png') }}" alt="" class="w-10 aspect-square">
                            <div class="h-full flex flex-col justify-center pl-5">
                                <h1 class="text-lg">Angga Puspa</h1>
                                <p class="text-gray-400 opacity-80">Full Stack Javascript</p>
                            </div>
                        </div>
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
                    <a href="#about-section">
                        <p>Tentang</p>
                    </a>
                    <a href="#kursus-section">
                        <p>Kursus</p>
                    </a>
                    <a href="#rutekarir-section">
                        <p>Rute Karir</p>
                    </a>
                    <a href="#faq-section">
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


</body>


</html>
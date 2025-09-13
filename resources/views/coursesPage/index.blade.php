<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>Luminus | Online Learning Platform</title>
</head>
<style>
body {
        font-family: 'Poppins', sans-serif !important;
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
    
    .button-hover {
        transition: .2s ease;
        color: #696EFF
    }

    .button-hover:hover {
        color: white;
        background: #696EFF;

    }

    .button-2-hover {
        transition: .2s ease;
        color: #fff
    }

    .button-2-hover:hover {
        color: #696EFF;
        background: white;
        border: 1px solid;
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
</style>

<body>
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

    <section class="w-[80%] mx-auto container">
        <section class="header-section text-white relative overflow-hidden mt-[80px]" data-aos="fade-up">
            <div class="w-[100%] mx-auto relative z-10 flex flex-col justify-center items-center">
                <h1 class="text-3xl font-semibold mb-6 w-[80%] text-center">Temukan Kursus Terbaik untuk Mu!</h1>
                <div class="relative max-w-[900px] w-[90%] mb-6">
                    <form id="searchForm" action="{{ route('courses.list') }}" method="GET">
                        <input type="text" id="searchInput" name="search" placeholder="Cari kursus"
                            class="w-[100%] px-6 py-3 rounded-xl text-gray-800 focus:outline-none"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="absolute right-1 top-1/2 -translate-y-1/2 bg-[#696EFF] py-2 px-4 rounded-lg hover-search">
                            <i class="fas fa-search text-white"></i>
                        </button>
                    </form>
                </div>
                <div class="flex gap-3 flex-wrap w-[90%] max-w-[900px] text-center">
                    <span class="text-gray-300">Rekomendasi:</span>
                    @foreach ($recommendations as $recommendation)
                        <a href="{{ route('courses.list', ['search' => $recommendation]) }}"
                            class="text-gray-300 hover:text-white underline">{{ $recommendation }}</a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="rekomendasi-section py-8 mt-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">Kursus Kami</h2>
                <select id="courseFilter" class="px-4 py-2 border rounded-lg bg-white" onchange="applyFilter()">
                    <option value="semua">Semua</option>
                    <option value="termurah">Termurah</option>
                    <option value="terpopuler">Terpopuler</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if ($courses->count() > 0)
                    @foreach ($courses as $course)
                        <div class="bg-white p-4 rounded-xl">
                            <img src="{{ asset('storage/' . $course->image_url) }}" alt="{{ $course->title }}"
                                class="w-full h-48 object-cover rounded-lg mb-4">
                            <div class="mt-4 text-gray-500">
                                <div class="flex gap-4 mb-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-clock text-gradient-1"></i>
                                        <span>{{ $course->duration }} jam</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-video text-gradient-1"></i>
                                        <span>{{ $course->video_count }} Modul</span>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-lg font-medium">{{ $course->title }}</h3>

                            <div class="mt-4">
                                @if ($course->discounted_price)
                                    <span class="font-semibold text-lg">Rp.
                                        {{ number_format($course->discounted_price, 0, ',', '.') }}</span>
                                    <span class="line-through pl-2" style="color: #E63946">Rp.
                                        {{ number_format($course->original_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="font-semibold text-lg">Rp.
                                        {{ number_format($course->original_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            @if (Auth::check() && Auth::user()->enrolledCourses->contains($course->id))
                                <a href="{{ route('siswa.courses.show', $course->id) }}"
                                    class="inline-block w-full text-center px-6 py-2 mt-4 bg-[#696EFF] text-white rounded-lg hover:bg-[#5c61ff]">Lanjut
                                    Pelajari</a>
                            @else
                                <div class="flex gap-2">
                                    <a href="{{ route('payment.form', $course->id) }}"
                                        class="inline-block w-half text-center font-semibold px-6 py-2 mt-4 bg-[#696EFF] text-white rounded-lg button-2-hover">Beli
                                        Kursus</a>
                                    <a href="{{ route('courses.show',1) }}"
                                        class="inline-block w-half text-center font-semibold px-6 py-2 mt-4 bg-[#fff] rounded-lg button-hover"
                                        style="border: 1px solid #696EFF;">Detail
                                        Kursus</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-8">
                        <div class="bg-white p-8 rounded-lg">
                            <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Kursus Tidak Ditemukan</h3>
                            <p class="text-gray-500 mb-4">Maaf, kursus yang Anda cari tidak tersedia.</p>
                            <a href="{{ route('courses.list') }}"
                                class="inline-block px-6 py-2 bg-[#696EFF] text-white rounded-lg hover:bg-[#5c61ff]">
                                Lihat Semua Kursus
                            </a>
                        </div>
                    </div>
                @endif

                @if ($courses->count() > 0)
                    <div class="mt-8 flex justify-center items-center gap-4">
                        @if ($courses->onFirstPage())
                            <span
                                class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $courses->previousPageUrl() }}"
                                class="px-4 py-2 bg-[#696EFF] text-white rounded-lg hover:bg-[#5c61ff]">
                                Previous
                            </a>
                        @endif

                        <span class="text-gray-600">
                            Page {{ $courses->currentPage() }} of {{ $courses->lastPage() }}
                        </span>

                        @if ($courses->hasMorePages())
                            <a href="{{ $courses->nextPageUrl() }}"
                                class="px-4 py-2 bg-[#696EFF] text-white rounded-lg hover:bg-[#5c61ff]">
                                Next
                            </a>
                        @else
                            <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">Next</span>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </section>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter');
            if (filter) {
                document.getElementById('courseFilter').value = filter;
            }
        });

        function applyFilter() {
            const filter = document.getElementById('courseFilter').value;
            const search = document.getElementById('searchInput').value;
            const url = new URL(window.location.href);

            if (filter && filter !== 'semua') {
                url.searchParams.set('filter', filter);
            } else {
                url.searchParams.delete('filter');
            }

            if (search) {
                url.searchParams.set('search', search);
            }

            window.location.href = url.toString();
        }

        function resetSearch() {
            window.location.href = '{{ route('courses.list') }}';
        }

        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-in-out'
        });
    </script>
</body>

</html>
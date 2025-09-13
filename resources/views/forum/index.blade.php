<!-- filepath: /d:/Lomba2024bact2/luminus/resources/views/forum/index.blade.php -->

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forum-responsive.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body class="bg-gray-100">
  <a href="{{ '/chat' }}" class="scroll-up-btn">
        <img src="{{ asset('images/bot.png') }}" alt="">
    </a>


    

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
                        <li class="mx-2 nav-links font-medium">
                            <a href="{{ '/kursus' }}">Kursus</a>
                        </li>
                        <li class="mx-2 text-white font-medium" id="active-links">
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
    <div class="max-w-screen-lg mx-auto py-6 min-h-screen px-4">
        <!-- Header -->

        
        @include('forum.navbar')
        <div class="pt-10 ">
            <div class="flex  md:space-x-6">
                <!-- Include Sidebar Component -->
                @include('forum.sidebar')
                <!-- Main Content -->
                <div class="w-3/4 cardth">
                    <div class="space-y-4" id="thread-list">
                        @foreach ($threads->sortByDesc('upvotes') as $thread)
                            <div class="bg-white  rounded-md p-4 thread-item">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ $thread->user->profile_picture_url ? asset('storage/' . $thread->user->profile_picture_url) : ($thread->user->gender == 'female' ? asset('images/default-female.png') : asset('images/default-male.png')) }}"
                                            alt="Profile"
                                            class="relative w-12 h-12 rounded-xl object-cover border-2 border-[#032038]">
                                        <p class="text-gray-600">Diposting oleh {{ $thread->user->name }}</p>
                                    </div>
                                    <p class="text-gray-400 text-sm">{{ $thread->created_at->diffForHumans() }}</p>
                                    @if (Auth::user()->hasRole('admin'))
                                        <form action="{{ route('threads.destroy', $thread->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus diskusi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-700 mb-2">
                                    <a href="#" class="thread-link"
                                        data-thread-id="{{ $thread->id }}">{{ $thread->title }}</a>
                                </h3>
                                <div class="text-gray-600 mb-4">
                                    {!! $thread->body !!}
                                </div>
                                @if ($thread->image)
                                    <img src="{{ asset('storage/' . $thread->image) }}" alt="Thread Image"
                                        class="w-full h-auto mb-4">
                                @endif
                                <div class="flex items-center justify-between text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('threads.upvote', $thread->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center space-x-1 hover:text-[#696EFF] transition-colors">
                                                <i class="fas fa-arrow-up"></i>
                                                <span>{{ $thread->upvotes ?? 0 }}</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('threads.downvote', $thread->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center space-x-1 hover:text-[#696EFF] transition-colors">
                                                <i class="fas fa-arrow-down"></i>
                                                <span>{{ $thread->downvotes ?? 0 }}</span>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <a href="{{ route('threads.show', $thread->id) }}"
                                            class="text-gray-500 hover:text-gray-700"
                                            onclick="incrementViews(event, {{ $thread->id }})">
                                            <i class="fa fa-comments"></i>
                                        </a>
                                    </div>
                                    <button
                                        class="comments-toggle flex items-center space-x-4 hover:text-[#696EFF] transition-colors"
                                        data-thread-id="{{ $thread->id }}">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-eye"></i>
                                            {{ $thread->views ?? 0 }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-comment"></i>
                                            {{ $thread->comments->count() ?? 0 }}
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
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


    <!-- Include Component -->
    @include('forum.create-thread-modal')

    <!--javascript-->
    <script src="{{ asset('js/forum.js') }}"></script>
</body>

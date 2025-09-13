<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $course->title }} | Luminus Education</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .aspect-video {
            aspect-ratio: 16/9;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-[#032038] flex justify-center items-center w-full fixed top-0 left-0 right-0 z-50">
        <div class="w-[88%] h-20 flex items-center justify-between">
            <!-- Left Side -->
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <a href="{{ route('home') }}">
                    <span class="text-xl font-bold text-white">Lu<span
                            class="text-xl font-bold bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text text-transparent">minus
                        </span></span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-1">
                    <a href="{{ route('siswa.dashboard') }}"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 {{ Request::routeIs('siswa.dashboard') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('siswa.courses') }}"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 {{ Request::routeIs('siswa.courses.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                        Courses
                    </a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- Profile and Logout -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('siswa.editProfile') }}"
                        class="group flex items-center gap-2 px-3 py-1.5 rounded-xl hover:bg-white/5 transition-all duration-300">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-full blur-sm opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                            </div>
                            <div
                                class="relative w-8 h-8 rounded-full bg-white/10 border border-white/10 flex items-center justify-center">
                                <i
                                    class="fas fa-user text-gray-300 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                        <span
                            class="text-sm font-medium text-gray-300 group-hover:text-white transition-colors duration-300">Profile</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="flex">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1.5 text-sm font-medium text-gray-300 hover:text-white rounded-lg hover:bg-white/5 transition-all duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>

                <!-- Hamburger Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="hamburgerButton" class="text-white focus:outline-none">
                        <i id="iconHamburgerButton" class="fas fa-bars w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
            class="fixed top-16 right-0 w-64 h-full bg-[#032038] transform translate-x-full transition-transform duration-300 md:hidden z-40">
            <div class="py-4 pl-5 pr-1">
                <a href="{{ route('siswa.editProfile') }}"
                    class="group ml-4 border border-gray-200 w-fit flex items-center gap-2 px-3 py-1.5 rounded-xl hover:bg-white/5 transition-all duration-300">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-full blur-sm opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                        </div>
                        <div
                            class="relative w-8 h-8 rounded-full bg-white/10 border border-white/10 flex items-center justify-center">
                            <i
                                class="fas fa-user text-gray-300 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                    <span
                        class="text-sm font-medium text-gray-300 group-hover:text-white transition-colors duration-300">Profile</span>
                </a>

                <div class="my-5 h-[1px] mx-5 bg-gray-200"></div>

                <a href="{{ route('siswa.dashboard') }}"
                    class="block px-4 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                    Dashboard
                </a>

                <a href="{{ route('siswa.courses') }}"
                    class="block px-4 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                    Courses
                </a>

                <div class="my-5 h-[1px] mx-5 bg-gray-200"></div>

                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full   px-4 py-2 text-sm font-medium text-left text-gray-300 hover:text-white rounded-lg hover:bg-white/5 transition-all duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>



    <div class="w-full h-16 "></div>

    <div class="grid min-h-screen overflow-y-scroll w-full place-items-center  ">
        <div class="container overflow-y-scroll w-11/12 xl:grid xl:grid-cols-[1fr_3fr] flex-col-reverse flex  ">
            <!-- Course Content Sidebar -->
            <div class="container mx-auto xl:py-8">
                <div class="w-full sticky top-8 xl:py-8 px-6 overflow-y-auto max-h-screen">
                    <div
                        class="bg-white rounded-2xl shadow-[0_2px_8px_rgba(0,0,0,0.06)] hover:shadow-[0_4px_12px_rgba(0,0,0,0.08)] transition-all duration-300">

                        <div class="p-6">
                            <!-- Course Title -->
                            <div class="mb-8">
                                <h2 class="text-xl font-bold text-gray-800 leading-snug mb-4 capitalize">
                                    {{ $course->title }}</h2>
                                <div class="bg-gray-50 p-3 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2.5 rounded-full bg-gray-50 overflow-hidden">
                                            <div class="h-full rounded-full bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] transition-all duration-300 ease-out"
                                                style="width: {{ $progressPercentage }}%">
                                            </div>
                                        </div>
                                        <span
                                            class="text-sm font-semibold bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text text-transparent">
                                            {{ round($progressPercentage) }}%
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Modules -->
                            <div class="space-y-4">
                                @foreach ($course->videoParts->groupBy('module') as $module => $parts)
                                    <div class="bg-white rounded-xl border  border-gray-100 overflow-hidden">
                                        <!-- Module Header -->
                                        <div class="px-4 py-3.5 bg-[#696EFF] border-b border-gray-100">
                                            <h3
                                                class="font-semibold text-gray-800 flex items-center gap-2 w-full h-full">
                                                <div class="flex gap-x-2 items-center w-full h-full">
                                                    <i
                                                        class="fas
                                                    fa-book-open text-white text-sm"></i>
                                                    <span class="text-white">Modul belajar</span>
                                                </div>
                                                {{ $module }}
                                            </h3>
                                        </div>

                                        <!-- Module Content -->
                                        <div class="divide-y divide-gray-50">
                                            @foreach ($parts as $part)
                                                @php
                                                    $isCompleted = $user->videoParts->contains($part->id);
                                                    $isLocked =
                                                        !$isCompleted &&
                                                        $loop->index > 0 &&
                                                        !$user->videoParts->contains($parts[$loop->index - 1]->id);
                                                    $isCurrent = $currentVideo->id == $part->id;
                                                @endphp
                                                <div class="group {{ $isCurrent ? 'bg-[#696EFF]/5' : '' }}">
                                                    <a href="{{ $isLocked ? '#' : route('siswa.courses.show', ['id' => $course->id, 'video' => $part->id]) }}"
                                                        class="flex items-center gap-3 px-4 py-3.5 hover:bg-gray-50/80 transition-colors duration-200 {{ $isLocked ? 'cursor-not-allowed opacity-60' : '' }}">
                                                        <!-- Status Icon -->
                                                        @if ($isCompleted)
                                                            <div
                                                                class="w-7 h-7 rounded-full bg-[#696EFF]/10 flex items-center justify-center shrink-0">
                                                                <i class="fas fa-check text-sm text-[#696EFF]"></i>
                                                            </div>
                                                        @elseif($isLocked)
                                                            <div
                                                                class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center shrink-0">
                                                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="w-7 h-7 rounded-full flex items-center justify-center shrink-0
                                                     {{ $isCurrent ? 'bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white shadow-sm' : 'border-2 border-gray-200' }}">
                                                                <span
                                                                    class="text-xs font-medium">{{ $loop->index + 1 }}</span>
                                                            </div>
                                                        @endif

                                                        <!-- Title -->
                                                        <span
                                                            class="text-sm {{ $isCurrent ? 'text-[#696EFF] font-medium' : 'text-gray-700' }} group-hover:text-[#696EFF] transition-colors duration-200 line-clamp-2">
                                                            {{ $part->title }}
                                                        </span>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full p-8  h-full  grid place-items-center ">
                @if ($currentVideo)
                    <div class="w-full xl:mx-auto flex justify-center">
                        <!-- Video Player Section -->
                        <div
                            class="bg-white xl:max-w-4xl xl:w-[56rem] w-full aspect-video rounded-2xl shadow-lg flex flex-col justify-between">
                            <!-- Video Player -->
                            <div class="aspect-video bg-black rounded-t-2xl">
                                @if (strpos($currentVideo->video_url, 'youtube.com') !== false || strpos($currentVideo->video_url, 'youtu.be') !== false)
                                    @php
                                        $videoId = null;
                                        if (
                                            preg_match(
                                                '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
                                                $currentVideo->video_url,
                                                $matches,
                                            )
                                        ) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp
                                    @if ($videoId)
                                        <iframe class="w-full h-full rounded-t-2xl"
                                            src="https://www.youtube.com/embed/{{ $videoId }}?modestbranding=1&rel=0&iv_load_policy=3"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    @endif
                                @else
                                    <video controls class="w-full h-full">
                                        <source src="{{ $currentVideo->video_url }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>

                            <!-- Content Section -->
                            <div class="p-5 px-6 ">
                                <div class="flex items-start justify-between gap-8 mb-6">
                                    <div class="flex-1">
                                        <!-- Video Metadata -->
                                        <div class="flex items-center gap-4 text-sm text-gray-400 mb-4">
                                            <span class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-[#696EFF]/10 flex items-center justify-center">
                                                    <i class="fas fa-play-circle text-[#696EFF]"></i>
                                                </div>
                                                Episode {{ $currentVideo->episode ?? '1' }}
                                            </span>
                                            <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                                            <span class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-[#696EFF]/10 flex items-center justify-center">
                                                    <i class="fas fa-clock text-[#696EFF]"></i>
                                                </div>
                                                {{ $currentVideo->duration ?? '15' }} mins
                                            </span>
                                        </div>

                                        <!-- Title and Module -->
                                        <h1 class="text-2xl font-bold text-gray-800 capitalize ">
                                            Materi : {{ $currentVideo->title }}
                                        </h1>

                                    </div>

                                    <!-- Completion Status -->
                                    @if (!$user->videoParts->contains($currentVideo->id))
                                        <form action="{{ route('siswa.videoParts.complete', $currentVideo->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="group px-6 py-3 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white rounded-xl hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300 flex items-center gap-2">
                                                <i class="fas fa-check"></i>
                                                <span>Mark Complete</span>
                                            </button>
                                        </form>
                                    @else
                                        <div class="px-5 py-3 bg-[#696EFF]/10 rounded-xl flex items-center gap-2">
                                            <i class="fas fa-check-circle text-[#696EFF]"></i>
                                            <span class="text-sm font-medium text-[#696EFF]">Completed</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Description -->
                                @if ($currentVideo->description)
                                    <div class="prose max-w-none text-gray-600 bg-gray-50/50 p-6 rounded-xl">
                                        {{ $currentVideo->description }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Notifications -->
    <div class="fixed top-20 right-4 z-50 space-y-4">
        @if (session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-lg shadow-lg transform transition-all duration-300"
                role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    <p class="text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-lg transform transition-all duration-300"
                role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <p class="text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('[role="alert"]');
                alerts.forEach(function(alert) {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(100%)';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 3000);
        });

        const hamburgerButton = document.getElementById('hamburgerButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const iconButtonHamburger = document.getElementById('iconHamburgerButton');
        hamburgerButton.addEventListener('click', () => {
            iconButtonHamburger.classList.toggle('fa-times');
            iconButtonHamburger.classList.toggle('fa-bars');
            mobileMenu.classList.toggle('translate-x-full');
        });
    </script>

</body>

</html>
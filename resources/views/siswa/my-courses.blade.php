<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Learning Journey | Luminus Education</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
    * {
        box-sizing: border-box !important;

    }

    @keyframes fade-up {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .animate-fade-up {
        animation: fade-up 0.6s ease-out forwards;
    }

    .animate-float {
        animation: float 2s infinite ease-in-out;
    }

    .animate-pulse-slow {
        animation: pulse 2s infinite;
    }

    @keyframes wave {
        0% {
            transform: translateX(-100%) skew-y-12;
        }

        100% {
            transform: translateX(100%) skew-y-12;
        }
    }

    @keyframes wave-reverse {
        0% {
            transform: translateX(100%) skew-y-12;
        }

        100% {
            transform: translateX(-100%) skew-y-12;
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }
    }

    .animate-wave {
        animation: wave 8s infinite linear;
    }

    .animate-wave-reverse {
        animation: wave-reverse 12s infinite linear;
    }

    .animate-float {
        animation: float 3s infinite ease-in-out;
    }

    .animate-spin-slow {
        animation: spin 8s linear infinite;
    }

    .animate-pulse-slow {
        animation: pulse-slow 3s infinite;
    }

    .particle {
        @apply absolute w-1 h-1 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-full opacity-30;
        animation: particle 15s infinite linear;
    }

    @keyframes particle {
        0% {
            transform: translate(0, 0);
        }

        100% {
            transform: translate(100vw, -100vh);
        }
    }
</style>

<body class="bg-gray-50">
    @include('siswa.partials.sidebar')

    <div class="p-4 ml-0 md:ml-64 lg:ml-64 overflow-y-scroll">

        <!-- Dashboard Header -->
        <div class="bg-[#032038] rounded-3xl mb-6 overflow-hidden group">
            <!-- Animated wave background -->



            <!-- Content -->
            <div class="relative z-10 p-8">
                <div class="flex items-start justify-between lg:flex-row md:flex-row flex-col gap-y-2">
                    <!-- Left section -->
                    <div class="flex-1">
                        <div class="flex items-start space-x-6">
                            <!-- Icon -->
                            <div
                                class="p-3 bg-[#032038] rounded-2xl shadow-lg transform hover:scale-110 
													transition-transform duration-300 animate-float">
                                <div class="bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] p-0.5 rounded-xl">
                                    <div class="bg-[#032038] p-2 rounded-xl">
                                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="space-y-2">
                                <h1
                                    class="lg:text-3xl md:text-2xl text-xl font-bold text-white tracking-tight group-hover:tracking-normal 
														 transition-all duration-300">
                                    My Courses
                                    <span
                                        class="inline-block ml-2 opacity-0 group-hover:opacity-100 
																	 transition-opacity duration-300">→</span>
                                </h1>
                                <div class="flex items-center space-x-3 text-sm text-white/60">
                                    <a href="#" class="hover:text-white transition-colors duration-200">Home</a>
                                    <span class="text-white/40">•</span>
                                    <span class="text-white">My Courses</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile section -->
                    <div class=" flex md:flex-col lg:flex-row justify-end md:justify-start">
                        <div class="group/profile relative">

                            <div
                                class="relative flex flex-row-reverse  md:flex-row  items-center bg-[#032038]/95 rounded-2xl p-3 gap-x-4 ">
                                <div class="md:text-right">
                                    <p class="text-white lg:text-base md:text-xs text-xs font-medium">
                                        {{ Auth::user()->name }}</p>
                                    <p class="text-xs text-white/60">Student</p>
                                </div>
                                <div class="relative ">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] 
																	rounded-xl animate-spin-slow opacity-70">
                                    </div>
                                    <img src="{{ Auth::user()->profile_picture_url ? asset('storage/' . Auth::user()->profile_picture_url) : (Auth::user()->gender == 'female' ? asset('images/default-female.png') : asset('images/default-male.png')) }}"
                                        alt="Profile"
                                        class="relative w-12 h-12 rounded-xl object-cover border-2 border-[#032038]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Header Section -->
        <div class="bg-[#032038] rounded-3xl mb-8 overflow-hidden group">


            <!-- Content -->
            <div class="relative py-6 px-8 z-10">
                <div class="grid grid-cols-12 gap-8 items-center">
                    <!-- Left Content -->
                    <div class="col-span-7">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-2  rounded-xl backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="h-0.5 w-16 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF]"></div>
                        </div>

                        <h1
                            class="text-3xl font-bold text-white mb-3 tracking-tight group-hover:tracking-normal transition-all duration-300">
                            Level Up Dengan Gaya!
                            <span
                                class="inline-block ml-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">✨</span>
                        </h1>

                        <p class="text-base text-white/80">
                            Tingkatkan skill anda dengan berbagai course sekarang!
                            <span
                                class="block mt-2 text-transparent bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text">
                                Mulai perjalanan pembelajaran Anda.
                            </span>
                        </p>
                    </div>

                    <!-- Right Illustration -->
                    <div class="col-span-5 relative flex items-center justify-center py-4">
                        <!-- Background glow -->
                        <div
                            class="absolute top-1/2 right-0 -translate-y-1/2 w-32 h-32 bg-gradient-to-br from-[#696EFF]/30 to-[#F8ACFF]/30 rounded-full blur-3xl animate-pulse-slow">
                        </div>

                        <!-- Image container -->
                        <div class="relative w-[180px]">
                            <img src="{{ asset('images/11.png') }}" alt="Learning Illustration"
                                class="relative z-10 w-full h-[140px] object-contain animate-float">

                            <!-- Decorative Elements -->
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-full opacity-20 animate-float"
                                style="animation-delay: 0.5s">
                            </div>
                            <div class="absolute -bottom-2 -left-2 w-10 h-10 bg-gradient-to-r from-[#F8ACFF] to-[#696EFF] rounded-full opacity-20 animate-float"
                                style="animation-delay: 1s">
                            </div>

                            <!-- Achievement Icons -->
                            <div class="absolute top-0 right-0 bg-white/10 backdrop-blur-md p-2 rounded-xl animate-float"
                                style="animation-delay: 1.5s">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1  md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach ($courses as $course)
                <div class="group relative perspective-1000">

                    <!-- Card Content -->
                    <div
                        class="relative bg-white rounded-2xl shadow-lg overflow-hidden hover:border-[#696EFF] hover:border-2 transition-all duration-300">
                        <!-- Course Image with Overlay -->
                        <div class="relative h-52 overflow-hidden">
                            <!-- Curved overlay at bottom of image -->



                            <img src="{{ asset('storage/' . $course->image_url) }}" alt="{{ $course->title }}"
                                class="w-full h-full object-cover">

                            <!-- Status Badge -->
                            <div class="absolute top-4 right-4 z-20">
                                @if ($course->progress == 100)
                                    <div class="px-4 py-2 bg-[#032038] rounded-full">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-[#696EFF]"></i>
                                            <span
                                                class="text-xs font-medium bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text text-transparent">
                                                Completed
                                            </span>
                                        </span>
                                    </div>
                                @else
                                    <div class="px-4 py-2 rounded-full bg-[#696eff] border border-white/20 ">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-spinner animate-spin text-[#F8ACFF]"></i>
                                            <span class="text-xs font-medium text-white/90">In Progress</span>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Course Info -->
                        <div class="relative p-6">
                            <!-- Course Title -->
                            <h3
                                class="text-xl font-bold text-black capitalize mb-1 group-hover:text-transparent group-hover:bg-gradient-to-r 
                           group-hover:from-[#696EFF] group-hover:to-[#F8ACFF] group-hover:bg-clip-text transition-all duration-300">
                                {{ $course->title }}
                            </h3>

                            <!-- Description with gradient fade -->
                            <p class="text-gray-500 text-sm mb-3 capitalize font-medium">
                                {{ $course->description }}

                            </p>

                            <!-- Progress Section with improved visuals -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-400">Progress</span>
                                    <span
                                        class="text-sm font-bold bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text text-transparent">
                                        {{ round($course->progress ?? 0) }}%
                                    </span>
                                </div>
                                <div
                                    class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden backdrop-blur-sm p-[1px]">
                                    <div class="h-full bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-full 
                                  transform transition-all duration-700 ease-out-cubic"
                                        style="width: {{ $course->progress ?? 0 }}%">
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons with enhanced styling -->
                            @if ($course->progress == 100)
                                <div class="flex gap-4 justify-center items-center">
                                    <a href="{{ route('siswa.courses.certificate', $course->id) }}"
                                        class="w-full h-auto border">
                                        <button
                                            class="flex w-full items-center justify-center px-4 py-3 rounded-2xl
                              bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white
                              hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300
                              "><i
                                                class="fas fa-download mr-2"></i>
                                            Certificate</button>

                                    </a>
                                    <a href="{{ route('siswa.courses.show', $course->id) }}" class="w-full h-auto">
                                        <button
                                            class="inline-flex w-full h-auto items-center justify-center px-4 py-3 
														bg-transparent text-[#696EFF] border-2 border-[#696EFF] rounded-2xl transition-all duration-300
														hover:shadow-[0_8px_16px_rgba(105,110,255,0.1)] hover:bg-[#f1f2f6]">
                                            <i
                                                class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                            Restart
                                        </button>

                                    </a>
                                </div>
                            @else
                                <a href="{{ route('siswa.courses.show', $course->id) }}" class="w-full h-auto">
                                    <button
                                        class="group/button inline-flex items-center justify-center w-full px-4 py-3.5
                          bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white rounded-2xl
                          hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300
                          ">
                                        <i
                                            class="fas fa-play-circle mr-2 transform transition-transform duration-300 
							 group-hover/button:translate-x-1"></i>
                                        Continue Learning</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if ($courses->isEmpty())
            <div class="relative min-h-[400px] flex items-center justify-center py-12">


                <!-- Main Content -->
                <div class="relative z-10 text-center max-w-3xl mx-auto px-4">
                    <!-- Icon -->
                    <div class="inline-flex mb-6 animate-float">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-full blur-lg opacity-25 animate-pulse-slow">
                            </div>
                            <div class="relative bg-black p-5 rounded-full">
                                <i
                                    class="fas fa-graduation-cap text-3xl bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text text-transparent"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <h2 class="text-3xl font-bold mb-4 animate-fade-up opacity-0">
                        <span class="bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text text-transparent">
                            Mulai Perjalanan Belajarmu
                        </span>
                    </h2>

                    <p class="text-base text-gray-600 mb-8 leading-relaxed max-w-xl mx-auto animate-fade-up opacity-0"
                        style="animation-delay: 0.2s">
                        Temukan potensi terbaikmu melalui pembelajaran yang berkualitas
                    </p>

                    <!-- Button -->
                    <div class="animate-fade-up opacity-0" style="animation-delay: 0.4s">
                        <a href="{{ route('siswa.courses') }}"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-xl text-white font-medium hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300">
                            <i class="fas fa-rocket text-lg group-hover:animate-bounce"></i>
                            <span>Jelajahi Kursus</span>
                        </a>
                    </div>

                    <!-- Quote -->
                    <div class="mt-8 animate-fade-up opacity-0" style="animation-delay: 0.6s">
                        <p class="text-sm text-gray-600 font-medium">
                            "Pendidikan adalah bekal terbaik untuk perjalanan hidup"
                        </p>
                    </div>
                </div>
            </div>
        @endif


</body>

</html>
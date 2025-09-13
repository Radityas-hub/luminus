<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Luminus Education</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
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
</head>

<body class="bg-[#f1f2f6]">
    <!-- Sidebar -->
    @include('siswa.partials.sidebar')
    <!-- Main Content -->
    <div class="p-4  md:ml-64 lg:ml-64 ml-0  flex flex-col ">
        <!-- Dashboard Header -->
        <div class="relative bg-[#032038] rounded-3xl mb-6 overflow-hidden group">

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
                                    Dashboard
                                    <span
                                        class="inline-block ml-2 opacity-0 group-hover:opacity-100 
																	 transition-opacity duration-300">→</span>
                                </h1>
                                <div class="flex items-center space-x-3 text-sm text-white/60">
                                    <a href="#" class="hover:text-white transition-colors duration-200">Home</a>
                                    <span class="text-white/40">•</span>
                                    <span class="text-white">Dashboard</span>
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


        <!-- Hero Section -->
        <div class="relative bg-[#032038] rounded-3xl  overflow-hidden group">


            <!-- Decorative elements -->
            <div
                class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-br from-[#696EFF]/30 to-[#F8ACFF]/30 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-gradient-to-tr from-[#F8ACFF]/30 to-[#696EFF]/30 rounded-full blur-3xl"
                style="animation-delay: 1s"></div>

            <!-- Content -->
            <div class="relative z-10 w-full px-8 py-8">
                <div class="max-w-7xl mx-auto">
                    <div class="flex justify-between items-center">
                        <!-- Left Content -->
                        <div class="flex-1">
                            <div class="flex flex-col space-y-2">
                                <!-- Badge -->
                                <h2 class="md:text-2xl text-xl font-bold text-white">
                                    Welcome back, <span class="">{{ Auth::user()->name }}!</span> 👋
                                </h2>
                                <p class="md:mt-1  text-white md:text-base text-sm text-opacity-60 w-2/3">
                                    {{ now()->format('l, d F Y') }} | Your Learning Journey Continues
                                </p>
                            </div>
                            <!-- Quick Actions -->
                            <div class="mt-3 w-full flex gap-x-3">
                                <a href="{{ route('siswa.courses') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF]  hover:from-[#F8ACFF]  hover:to-[#696EFF]  rounded-lg text-sm font-medium text-white">
                                    <i class="fas fa-play-circle mr-2"></i>
                                    Continue Learning
                                </a>
                                <a href="{{ route('siswa.progress') }}"
                                    class="inline-flex items-center px-4 py-2 bg-[#082d4a] bg-opacity-60 backdrop-blur-lg hover:bg-white hover:text-black  transition-colors rounded-lg text-sm font-medium text-white">
                                    <i class="fas fa-chart-line mr-2"></i>
                                    View Progress
                                </a>
                            </div>
                        </div>

                        <!-- Right Illustration -->
                        <div class="col-span-5 relative">
                            <div class="relative transform group-hover:scale-105 transition-all duration-500">
                                <!-- Floating Elements -->
                                <div class="absolute -top-10 -right-10 w-20 h-20 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] rounded-full opacity-20 animate-float"
                                    style="animation-delay: 0.5s"></div>
                                <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-gradient-to-r from-[#F8ACFF] to-[#696EFF] rounded-full opacity-20 animate-float"
                                    style="animation-delay: 1s"></div>

                                <!-- Main Illustration -->
                                <div class="relative z-10 flex items-center justify-center">
                                    <div class="w-48 h-48 relative">
                                        <svg class="w-full h-full text-white" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 21l9-5-9-5-9 5 9 5z" />
                                        </svg>

                                        <!-- Achievement Icons -->
                                        <div class="absolute top-0 right-0 bg-white/10 backdrop-blur-md p-3 rounded-xl animate-float"
                                            style="animation-delay: 1.5s">
                                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="p-4 md:ml-64 lg:ml-64 ml-0">


        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4  gap-4 mb-8 bg-white rounded-3xl p-5">
            <div class="p-4 bg-gray-50 rounded-lg shadow-lg ">
                <div class="flex items-center">
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-lg">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-base font-normal text-gray-500">Enrolled Courses</h3>
                        <span class="text-2xl font-bold text-gray-900">{{ $enrolledCount }}</span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow-lg ">
                <div class="flex items-center">
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-lg">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-base font-normal text-gray-500">Completed Courses</h3>
                        <span class="text-2xl font-bold text-gray-900">{{ $completedCount }}</span>
                        <span
                            class="text-sm text-gray-500">({{ $completedCount > 0 ? round(($completedCount / $enrolledCount) * 100) : 0 }}%)</span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow-lg ">
                <div class="flex items-center">
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-lg">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-base font-normal text-gray-500">Hours Studied</h3>
                        <span class="text-2xl font-bold text-gray-900">{{ $totalHours }}</span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg shadow-lg ">
                <div class="flex items-center">
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-emerald-600 bg-emerald-100 rounded-lg">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-base font-normal text-gray-500">Overall Progress</h3>
                        <span class="text-2xl font-bold text-gray-900">{{ $overallProgress }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Courses Table -->
        <div class="bg-white rounded-3xl shadow-sm mb-4">
            <div class="p-4 border-b">
                <h2 class="text-xl font-bold">Recent Courses</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Course Name</th>
                            <th scope="col" class="px-6 py-3">Instructor</th>
                            <th scope="col" class="px-6 py-3">Progress</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentCourses as $course)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $course->title }}</td>
                                <td class="px-6 py-4">{{ $course->instructor->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full"
                                            style="width: {{ $course->progress ?? 0 }}%"></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('siswa.courses.show', $course->id) }}"
                                        class="font-medium text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Pembayaran Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Siswa | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body class="bg-[#f1f2f6] min-h-screen">
    @include('admin.partials.sidebar')
    
    <div class="p-6 sm:ml-64 ">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl s p-8 mb-8 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-blue-500 bg-clip-text text-transparent">
                            Profil Siswa
                        </h1>
                        <p class="text-gray-500 mt-2">Detail informasi siswa</p>
                    </div>
                    <div class="hidden sm:block">
                        <img class="h-24 w-24 rounded-xl object-cover"
                            src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=random"
                            alt="{{ $student->name }}">
                    </div>
                </div>
            </div>

            <!-- Profile Details Card -->
            <div class="bg-white rounded-2xl p-8 mb-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 p-3 rounded-xl">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold ml-4 text-gray-800">Informasi Pribadi</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">Nama Lengkap</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $student->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $student->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Enrolled Courses Card -->
            <div class="bg-white rounded-2xl p-8 mb-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 p-3 rounded-xl">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold ml-4 text-gray-800">Kursus yang Diikuti</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($student->enrolledCourses as $course)
                    <div class=" p-6 rounded-xl transition-all duration-200 border-[#ddd] border ">
                        <div class="flex items-center">
                            <i class="fas fa-book text-indigo-500 mr-3"></i>
                            <p class="text-gray-800 font-medium capitalize">{{ $course->title }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Progress Section -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 p-3 rounded-xl">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold ml-4 text-gray-800">Progress Pembelajaran</h2>
                </div>

                <div class="space-y-6">
                    @foreach($student->progress as $progress)
                    <div class="bg-gray-50 p-6 rounded-xl hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between mb-3">
                            <span class="font-medium text-gray-800">{{ $progress->course->title }}</span>
                            <span class="text-gray-600">{{ $progress->date->format('d M Y') }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 h-3 rounded-full transition-all duration-500"
                                style="width: {{ $progress->progress }}%"></div>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">{{ $progress->progress }}% selesai</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Luminus Education</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#f1f2f6]">
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <nav
            class="flex justify-between items-center mb-6 bg-white p-5 rounded-xl  backdrop-blur-sm border border-gray-100">
            <div>
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Dashboard
                </h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Notification Button with Badge -->
                <button class="relative p-2.5 hover:bg-gray-50 rounded-xl transition-all duration-200 group">
                    <i class="fas fa-bell text-gray-600 group-hover:text-blue-600"></i>
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        3
                    </span>
                </button>

                <!-- User Profile -->
                <div
                    class="flex items-center gap-3 bg-gray-50 p-2 rounded-xl hover:bg-gray-100 transition-all duration-200 cursor-pointer">
                    <img class="w-9 h-9 rounded-xl  object-cover border-2 border-white"
                        src="https://ui-avatars.com/api/?name=Admin&background=4F46E5&color=fff" alt="user photo">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700">Admin</span>
                        <span class="text-xs text-gray-500">Administrator</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-400 ml-2"></i>
                </div>
            </div>
        </nav>

        <!-- Stats Grid -->
        <div class="space-y-6">
            <!-- Course Overview Section -->
            <div class="bg-white rounded-2xl p-6  border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-800">Course Overview</h2>
                    <div class="flex items-center gap-2">
                        <!-- Export Button -->
                        <a href="{{ route('admin.downloadReport') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors duration-200 font-medium text-sm">
                            <i class="fas fa-download mr-2"></i>
                            Download Report
                        </a>
                        <button
                            class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Total Courses Card -->
                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-blue-600/70">Total Courses</p>
                                <div class="mt-2 flex items-baseline gap-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $jumlahKursus }}</h3>
                                    <span
                                        class="text-green-500 text-xs font-semibold px-2 py-0.5 bg-green-50 rounded-full">+{{ $newCoursesThisMonth }}
                                        New</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                    {{ $newCoursesThisMonth }} added this month
                                </p>
                            </div>
                            <div class="p-2 bg-white/80 rounded-lg ">
                                <i class="fas fa-graduation-cap text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Students Card -->
                    <div
                        class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-purple-600/70">Total Students</p>
                                <div class="mt-2 flex items-baseline gap-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $jumlahSiswa }}</h3>
                                    <span
                                        class="text-green-500 text-xs font-semibold px-2 py-0.5 bg-green-50 rounded-full">+{{ $newStudentsThisMonth }}
                                        New</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                    {{ $newStudentsThisMonth }} new enrollments
                                </p>
                            </div>
                            <div class="p-2 bg-white/80 rounded-lg ">
                                <i class="fas fa-users text-purple-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Active Instructors Card -->
                    <div
                        class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-green-600/70">Active Instructors</p>
                                <div class="mt-2 flex items-baseline gap-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $jumlahInstruktur }}</h3>
                                    <span
                                        class="text-green-500 text-xs font-semibold px-2 py-0.5 bg-green-50 rounded-full">+{{ $newInstructorsThisMonth }}
                                        New</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                    92% satisfaction rate
                                </p>
                            </div>
                            <div class="p-2 bg-white/80 rounded-lg ">
                                <i class="fas fa-chalkboard-teacher text-green-600"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Course Sales Card -->
                    <div
                        class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-4 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-orange-600/70">Course Sales</p>
                                <div class="mt-2 flex items-baseline gap-2">
                                    <h3 class="text-xl font-bold text-gray-900">
                                        Rp{{ number_format($totalCourseSales, 2) }}</h3>
                                    <span
                                        class="text-green-500 text-xs font-semibold px-2 py-0.5 bg-green-50 rounded-full">+{{ number_format($monthlyRevenuePercentage, 1) }}%</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                    Monthly revenue: Rp{{ number_format($monthlyRevenue, 2) }}
                                </p>
                            </div>
                            <div class="p-2 bg-white/80 rounded-lg ">
                                <i class="fas fa-shopping-cart text-orange-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-8 mt-4">
            <div class="bg-white p-4 rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Student Enrollment</h2>
                <canvas id="enrollmentChart"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg ">
                <h2 class="text-lg font-semibold mb-4">Revenue Overview</h2>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        

        <!-- Top Courses -->
        <div class="bg-white rounded-2xl  border border-gray-100">
            <!-- Header Section -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <h2 class="text-xl font-bold text-gray-800">Best Selling Courses</h2>
                            <div class="absolute -top-1 -right-6 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        </div>
                        <span
                            class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                            <i class="fas fa-crown text-yellow-500 mr-1"></i>Top 5
                        </span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-sm text-gray-500">Total Revenue</span>
                        <span class="text-lg font-bold text-gray-800">Rp.
                            {{ number_format($totalCourseSales, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-100">
                                <th class="px-6 py-3">Course Details</th>
                                <th class="px-6 py-3">Instructor</th>
                                <th class="px-6 py-3">Performance</th>
                                <th class="px-6 py-3">Revenue</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($recentCourses->sortByDesc(function ($course) {
            return $course->students->count();
        })->take(5) as $index => $course)
                                <tr class="bg-white hover:bg-gray-50/30 transition-all duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="relative">
                                                <div class="w-16 h-16 rounded-xl overflow-hidden ">
                                                    @if ($course->image_url)
                                                        <img src="{{ asset('storage/' . $course->image_url) }}"
                                                            alt="{{ $course->title }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div
                                                            class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                                                            <i class="fas fa-graduation-cap text-white text-xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div
                                                    class="absolute -top-2 -left-2 w-6 h-6 rounded-full bg-gray-900 text-white text-xs flex items-center justify-center font-bold ">
                                                    #{{ $index + 1 }}
                                                </div>
                                            </div>
                                            <div class="flex flex-col">
                                                <h3 class="font-semibold text-gray-800">{{ $course->title }}</h3>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ Str::limit($course->description, 60) }}</p>
                                                <div class="flex items-center gap-3 mt-2">
                                                    <span class="flex items-center text-xs text-blue-600">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        {{ $course->duration }}h
                                                    </span>
                                                    <span class="flex items-center text-xs text-purple-600">
                                                        <i class="fas fa-video mr-1"></i>
                                                        {{ $course->video_count }} videos
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center ">
                                                <span
                                                    class="text-white font-semibold">{{ substr($course->instructor->name, 0, 1) }}</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-sm font-medium text-gray-800">{{ $course->instructor->name }}</span>
                                                <span class="text-xs text-gray-500">Professional Instructor</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-2">
                                            <div
                                                class="px-4 py-2 rounded-lg {{ $course->students->count() > 50 ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-users"></i>
                                                    <span
                                                        class="font-semibold">{{ $course->students->count() }}</span>
                                                    <span class="text-xs">students</span>
                                                </div>
                                            </div>
                                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                                <div class="bg-blue-600 h-1.5 rounded-full"
                                                    style="width: {{ min(($course->students->count() / 100) * 100, 100) }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-lg font-bold text-gray-800">
                                                Rp.
                                                {{ number_format($course->students->count() * ($course->discounted_price ?? $course->original_price), 0, ',', '.') }}
                                            </span>
                                            <div class="flex items-center gap-1 text-xs text-gray-500 mt-1">
                                                <i class="fas fa-tag"></i>
                                                <span>Rp.
                                                    {{ number_format($course->discounted_price ?? $course->original_price, 0, ',', '.') }}
                                                    / student</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.courses.create') }}"
                                                class="p-2 text-blue-600 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.courses.delete', $course->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enrollment Chart
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Student Enrollments',
                    data: @json(array_values($enrollmentData)),
                    borderColor: 'rgb(59, 130, 246)',
                    tension: 0.1
                }]
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue',
                    data: @json(array_values($revenueData)),
                    backgroundColor: 'rgb(75, 192, 192)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>

</html>

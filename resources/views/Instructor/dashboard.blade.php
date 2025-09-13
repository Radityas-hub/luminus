<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard | Luminus Education</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
            <div class="flex items-center pl-2.5 mb-5">
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Luminus Instructor</span>
            </div>
            
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('instructor.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-700 group">
                        <i class="fas fa-home w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-700 group">
                        <i class="fas fa-chalkboard-teacher w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white"></i>
                        <span class="ml-3">My Courses</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <nav class="flex justify-between items-center mb-4 bg-white p-4 rounded-lg shadow-sm">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
        </div>
        <div class="flex items-center gap-3">
            <button class="p-2 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-bell text-gray-500"></i>
            </button>
            <div class="flex items-center gap-2">
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($instructor->name) }}" alt="user photo">
                <span class="text-sm text-gray-600">{{ $instructor->name }}</span>
            </div>
        </div>
    </nav>

        <!-- Courses and Students -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            @foreach ($courses as $course)
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $course->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $course->description }}</p>
                    <h4 class="text-md font-semibold text-gray-800 mb-2">Students</h4>
                    <ul class="list-disc list-inside">
                        @foreach ($course->students as $student)
                            <li class="text-sm text-gray-600">{{ $student->name }} ({{ $student->pivot->progress }}%)</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Reports | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <nav class="flex justify-between items-center mb-6 bg-white p-5 rounded-xl shadow-lg backdrop-blur-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Forum Reports
                </h1>
            </div>
        </nav>

        <!-- Reports Table Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Report List</h2>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-100">
                                <th class="px-6 py-3">Reporter</th>
                                <th class="px-6 py-3">Thread</th>
                                <th class="px-6 py-3">Type</th>
                                <th class="px-6 py-3">Description</th>
                                <th class="px-6 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($reports as $report)
                                <tr class="hover:bg-gray-50/30 transition-all duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $report->user->name }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('threads.show', $report->thread->id) }}" 
                                           class="text-blue-600 hover:underline">
                                            {{ $report->thread->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $report->type }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $report->description }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $report->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
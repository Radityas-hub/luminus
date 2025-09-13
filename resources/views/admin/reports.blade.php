<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    <div class="p-4 sm:ml-64 bg-[#f1f2f6]">
        <!-- Header -->
        <nav
            class="flex justify-between items-center mb-6 bg-white p-5 rounded-xl backdrop-blur-sm border border-gray-100">
            <div>
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Report Generation
                </h1>
            </div>
        </nav>

        <!-- Report Generator Card -->
        <div class="bg-white rounded-2xl  border border-gray-100 mb-6">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-file-export text-blue-600 text-xl"></i>
                    <h2 class="text-xl font-bold text-gray-800">Generate Report</h2>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.reports.generate') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Report Type -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Report Type</label>
                            <div class="border-[#ddd] border rounded-lg p-4">
                                <select name="report_type" class="w-full rounded-lg border-gray-500">
                                    <option value="financial">Financial Report</option>
                                    <option value="enrollment">Enrollment Report</option>
                                    <option value="course">Course Analytics</option>
                                    <option value="instructor">Instructor Performance</option>
                                </select>
                            </div>

                        </div>

                        <!-- Format -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Format</label>
                            <div class="border-[#ddd] border rounded-lg p-4">
                                <select name="format" class="w-full rounded-lg border-gray-200">
                                    <option value="excel">Excel</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Period Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Period</label>
                            <div class="border-[#ddd] border rounded-lg p-4">
                                <select name="period" id="period" class="w-full rounded-lg border-gray-200">
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                    <option value="custom">Custom Range</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <div class="border-[#ddd] border rounded-lg p-4">
                                <select name="year" class="w-full rounded-lg border-gray-200">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="monthSelect">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Month</label>
                            <div class="border-[#ddd] border rounded-lg p-4">
                                <select name="month" class="w-full rounded-lg border-gray-200">
                                    @foreach ($months as $month)
                                        <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-file-download mr-2"></i>
                            Generate Report
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                    </svg>
                </span>
            </div>
        @endif

        @php
            $recentReports = $recentReports ?? collect([]);
        @endphp
        <!-- Recent Reports -->
        <div class="bg-white rounded-2xl  border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-history text-blue-600 text-xl"></i>
                    <h2 class="text-xl font-bold text-gray-800">Recent Reports</h2>
                </div>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-100">
                                <th class="px-6 py-3">Report Name</th>
                                <th class="px-6 py-3">Type</th>
                                <th class="px-6 py-3">Generated On</th>
                                <th class="px-6 py-3">Format</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($recentReports as $report)
                                <tr class="hover:bg-gray-50/30 transition-all duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $report->report_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                            {{ $report->report_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $report->created_at->format('Y-m-d H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <i
                                            class="fas fa-file-{{ $report->format == 'excel' ? 'excel text-green-600' : 'pdf text-red-600' }}"></i>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.reports.download', $report->id) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No reports generated yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('period').addEventListener('change', function() {
            const monthSelect = document.getElementById('monthSelect');
            if (this.value === 'yearly') {
                monthSelect.style.display = 'none';
            } else {
                monthSelect.style.display = 'block';
            }
        });
    </script>

</body>

</html>
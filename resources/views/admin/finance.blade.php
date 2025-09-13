<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-[#f1f2f6]">

    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    <div class="p-4 sm:ml-64 bg-[#f1f2f6]">
        <!-- Header -->
        <nav
            class="flex justify-between items-center mb-6 bg-white p-5 rounded-xl  backdrop-blur-sm border border-gray-100">
            <div>
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Revenue Overview
                </h1>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.finance.export') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors duration-200 font-medium text-sm">
                    <i class="fas fa-download mr-2"></i>
                    Export Report
                </a>
            </div>
        </nav>

        <!-- Revenue Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 bg-white p-4 rounded-xl">
            <!-- Total Revenue -->
            <div
                class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 hover:shadow-md transition-all duration-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-blue-600/70">Total Revenue</p>
                        <div class="mt-2">
                            <h3 class="text-2xl font-bold text-gray-900">Rp
                                {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="p-3 bg-white/80 rounded-lg ">
                        <i class="fas fa-money-bill-wave text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue -->
            <div
                class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 hover:shadow-md transition-all duration-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-green-600/70">Monthly Revenue</p>
                        <div class="mt-2">
                            <h3 class="text-2xl font-bold text-gray-900">Rp
                                {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="p-3 bg-white/80 rounded-lg ">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>



            <!-- Average Transaction -->
            <div
                class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 hover:shadow-md transition-all duration-200">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-purple-600/70">Avg Transaction</p>
                        <div class="mt-2">
                            <h3 class="text-2xl font-bold text-gray-900">Rp
                                {{ number_format($totalRevenue / max($salesReports->count(), 1), 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="p-3 bg-white/80 rounded-lg ">
                        <i class="fas fa-calculator text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Revenue Trend -->
            <div class="bg-white rounded-2xl  border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800">Revenue Trend</h2>
                </div>
                <div class="p-6">
                    <canvas id="revenueTrendChart"></canvas>
                </div>
            </div>

            <!-- Revenue per Course -->
            <div class="bg-white rounded-2xl  border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800">Course Revenue Distribution</h2>
                </div>
                <div class="p-6">
                    <canvas id="courseRevenueChart"></canvas>
                </div>
            </div>
        </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Sales Distribution Chart -->
    <div class="bg-white rounded-2xl border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800">Sales Distribution</h2>
        </div>
        <div class="p-6">
            <canvas id="salesDistributionChart" height="250"></canvas>
        </div>
    </div>

        <!-- Transactions Table -->
       <div class="lg:col-span-2 bg-white rounded-2xl  border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Transaction History</h2>
                <!-- Period Selector -->
                <div class="flex items-center space-x-3">
                    <select id="yearSelect" class="rounded-lg border-gray-200 text-sm">
                        @for($i = now()->year; $i >= now()->year - 2; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <select id="monthSelect" class="rounded-lg border-gray-200 text-sm">
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ $month == now()->month ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
           <div class="p-6">
            <div class="overflow-x-auto" style="max-height: 400px;">
                <table class="w-full">
                    <thead class="sticky top-0 bg-white">
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-100">
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Course</th>
                            <th class="px-6 py-3">Student</th>
                            <th class="px-6 py-3">Amount</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50" id="transactionList">
                            @foreach ($salesReports as $report)
                                <tr class="hover:bg-gray-50/30 transition-all duration-200">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $report->course->title }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $report->user->name }}</td>
                                    <td class="px-6 py-4 text-green-600 font-semibold">
                                        Rp {{ number_format($report->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $report->date->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prepare data
            const monthlyData = @json(
                $salesReports->groupBy(function ($item) {
                        return $item->date->format('M');
                    })->map(function ($group) {
                        return $group->sum('amount');
                    }));

            const courseData = @json($revenuePerCourse->pluck('transactions_sum_amount', 'title'));

            // Revenue Trend Chart
            new Chart(document.getElementById('revenueTrendChart'), {
                type: 'line',
                data: {
                    labels: Object.keys(monthlyData),
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: Object.values(monthlyData),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });

            // Course Revenue Chart
            new Chart(document.getElementById('courseRevenueChart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(courseData),
                    datasets: [{
                        label: 'Revenue per Course',
                        data: Object.values(courseData),
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });

            // Sales Distribution Chart
            // Sales Distribution Chart
            const salesDistribution = @json(
                $salesReports->groupBy(function ($item) {
                        return $item->date->format('F'); // Use full month name
                    })->map(function ($group) {
                        return [
                            'count' => $group->count(),
                            'amount' => $group->sum('amount'),
                        ];
                    }));

            new Chart(document.getElementById('salesDistributionChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(salesDistribution),
                    datasets: [{
                        data: Object.values(salesDistribution).map(item => item.amount),
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)', // Blue
                            'rgba(16, 185, 129, 0.8)', // Green
                            'rgba(249, 115, 22, 0.8)', // Orange
                            'rgba(139, 92, 246, 0.8)', // Purple
                            'rgba(236, 72, 153, 0.8)', // Pink
                            'rgba(234, 179, 8, 0.8)' // Yellow
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 12
                                },
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    return data.labels.map((label, i) => ({
                                        text: `${label} - ${((data.datasets[0].data[i] / total) * 100).toFixed(1)}%`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        hidden: false,
                                        index: i
                                    }));
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return `${label}: Rp ${new Intl.NumberFormat('id-ID').format(value)} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    radius: '90%'
                }
            });
        });

     document.addEventListener('DOMContentLoaded', function() {
    const yearSelect = document.getElementById('yearSelect');
    const monthSelect = document.getElementById('monthSelect');
    
    function loadTransactions() {
        const year = yearSelect.value;
        const month = monthSelect.value;
        
        fetch(`/admin/transactions/${year}/${month}`)
            .then(response => response.json())
            .then(data => {
                const transactionList = document.getElementById('transactionList');
                transactionList.innerHTML = '';
                
                if (data.length === 0) {
                    // Empty state message
                    const emptyState = `
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center">
                                        <i class="fas fa-receipt text-blue-500 text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">No Transactions Found</h3>
                                    <p class="text-sm text-gray-500">
                                        There are no transactions recorded for ${new Date(year, month-1).toLocaleString('default', { month: 'long' })} ${year}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    `;
                    transactionList.innerHTML = emptyState;
                    return;
                }
                
                data.forEach(transaction => {
                    const row = `
                        <tr class="hover:bg-gray-50/30 transition-all duration-200">
                            <td class="px-6 py-4 text-sm">
                                ${new Date(transaction.date).toLocaleDateString()}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                ${transaction.course.title}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                ${transaction.user.name}
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-blue-600">
                                Rp ${new Intl.NumberFormat('id-ID').format(transaction.amount)}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                    Success
                                </span>
                            </td>
                        </tr>
                    `;
                    transactionList.innerHTML += row;
                });
            });
    }

    yearSelect.addEventListener('change', loadTransactions);
    monthSelect.addEventListener('change', loadTransactions);
    
    // Initial load
    loadTransactions();
});
    </script>

</body>

</html>

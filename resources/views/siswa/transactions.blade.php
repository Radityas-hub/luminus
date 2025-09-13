<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions | Luminus Education</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-slate-50 font-['Plus_Jakarta_Sans']">
    @include('siswa.partials.sidebar')

    <div class="p-6 sm:ml-64">
        <div class="max-w-4xl mx-auto">
            <div class="relative bg-[#032038] rounded-3xl mb-8 overflow-hidden">


                <!-- Content -->
                <div class="relative z-10 px-8 py-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="flex items-center space-x-4">
                            <!-- Icon -->
                            <div class="p-2.5 bg-white/10 backdrop-blur-sm rounded-xl border border-white/10">
                                <i
                                    class="fas fa-shopping-cart text-lg text-transparent bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text"></i>
                            </div>

                            <!-- Title -->
                            <div>
                                <h1 class="text-2xl font-semibold text-white">
                                    Riwayat Pembelian Kelas
                                </h1>
                                <p class="text-sm text-white/70">
                                    Tinjau dan kelola riwayat pembelian kelas Anda
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                    <div class="flex items-center mb-4 md:mb-0">
                        <label for="entries" class="text-sm text-gray-600 mr-2">Show</label>
                        <select id="entries" class="border border-gray-300 rounded-md p-1 text-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label for="entries" class="text-sm text-gray-600 ml-2">entries</label>
                    </div>
                    <div class="flex items-center">
                        <label for="search" class="text-sm text-gray-600 mr-2">Search:</label>
                        <input type="text" id="search" class="border border-gray-300 rounded-md p-1 text-sm">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200">#</th>
                                <th class="py-2 px-4 border-b border-gray-200">Cover</th>
                                <th class="py-2 px-4 border-b border-gray-200">Name</th>
                                <th class="py-2 px-4 border-b border-gray-200">Tipe Kelas</th>
                                <th class="py-2 px-4 border-b border-gray-200">Price</th>
                                <th class="py-2 px-4 border-b border-gray-200">Date</th>
                                <th class="py-2 px-4 border-b border-gray-200">Status</th>
                                <th class="py-2 px-4 border-b border-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if ($transaction->course && $transaction->course->image_url)
                                            <img src="{{ $transaction->course->image_url }}" alt="Cover"
                                                class="w-10 h-10 object-cover rounded">
                                        @else
                                            <img src="{{ asset('images/default-course.png') }}" alt="Default Cover"
                                                class="w-10 h-10 object-cover rounded">
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        {{ $transaction->course ? $transaction->course->title : 'Course Deleted' }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        {{ $transaction->course ? $transaction->course->type : 'N/A' }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        Rp. {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        {{ $transaction->date->format('M d, Y') }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">Completed</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if ($transaction->course)
                                            <a href="{{ route('siswa.courses.show', $transaction->course->id) }}"
                                                class="text-blue-600 hover:underline">View</a>
                                        @else
                                            <span class="text-gray-400">Not Available</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-2 px-4 border-b border-gray-200 text-center">
                                        Belum ada data transaksi yang tersedia pada tabel ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-center mt-4">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-600">Showing {{ $transactions->count() }} to
                            {{ $transactions->count() }} of {{ $transactions->total() }} entries</p>
                    </div>
                    <div>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

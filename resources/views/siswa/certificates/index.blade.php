<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat Saya | Luminus Education</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .certificate-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #ddd;
        }

        .certificate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    @include('siswa.partials.sidebar')

    <div class="p-4 sm:ml-64">
        <header class="bg-white shadow-sm p-4 rounded-lg mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Sertifikat Saya</h1>
            <p class="text-gray-600">Daftar sertifikat yang telah Anda peroleh</p>
        </header>

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($certificates as $certificate)
                    <div class="certificate-card bg-white rounded-xl shadow-sm p-4">
                        <h2 class="text-lg font-bold text-gray-800">{{ $certificate->course->title }}</h2>
                        <p class="text-gray-500">{{ $certificate->created_at->format('d M Y') }}</p>
                        <a href="{{ route('siswa.certificates.download', $certificate->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-[#696EFF] text-white rounded-xl hover:bg-transparent hover:border-[#696EFF] hover:border-2 hover:text-[#696EFF] transition-all duration-200 shadow-sm hover:shadow-md mt-4">
                            <i class="fas fa-download mr-2"></i>
                            Unduh Sertifikat
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Saya | Luminus Education</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    @include('siswa.partials.sidebar')
    
    <div class="p-4 sm:ml-64">
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h1 class="text-2xl font-bold mb-6">Sertifikat Saya</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($certificates as $certificate)
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <h2 class="text-lg font-bold">{{ $certificate->course->title }}</h2>
                    <p class="text-gray-500">{{ $certificate->created_at->format('d M Y') }}</p>
                    <a href="{{ route('siswa.certificates.download', $certificate->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 shadow-sm hover:shadow-md mt-4">
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
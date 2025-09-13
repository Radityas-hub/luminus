<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat Penyelesaian</title>
    <style>
        @page {
            margin: 0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: #f8f9fa;
            padding: 40px;
            color: #333;
        }

        .certificate {
            max-width: 1000px;
            margin: 0 auto;
            border: 2px solid #2D3E50;
            padding: 60px;
            position: relative;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            opacity: 0.03;
            width: 80%;
            z-index: -1;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #2D3E50;
            padding-bottom: 30px;
        }

        .logo {
            height: 100px;
            margin-bottom: 20px;
        }

        .title {
            font-family: 'Merriweather', serif;
            font-size: 42px;
            font-weight: bold;
            color: #2D3E50;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 20px;
            color: #555;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .content {
            text-align: center;
            margin: 40px 0;
        }

        .name {
            font-family: 'Merriweather', serif;
            font-size: 36px;
            font-weight: bold;
            color: #2D3E50;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .course-title {
            font-size: 28px;
            font-weight: bold;
            color: #2D3E50;
            margin: 20px 0;
        }

        .description {
            font-size: 18px;
            line-height: 1.8;
            margin: 15px 0;
            color: #444;
        }

        .signatures {
            width: 100%;
            margin-top: 80px;
        }

        .signature-box {
            text-align: center;
            width: 100%
        }

        .signature-img {
            height: 70px;
            margin: 20px auto;
            display: block;
        }

        .signature-line {
            width: 80%;
            margin: 15px auto;
            border-bottom: 1px solid #2D3E50;
        }

        .signature-name {
            font-size: 18px;
            font-weight: bold;
            margin: 8px 0;
            color: #2D3E50;
        }

        .signature-title {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
            font-style: italic;
        }

        .validation {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #ddd;
        }

        .validation p {
            font-size: 16px;
            color: #555;
            margin: 8px 0;
        }

        .capitalize {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <img src="{{ public_path('images/watermark.png') }}" class="watermark" alt="Watermark">

        <div class="header">
            <img src="{{ public_path('images/logo2.png') }}" class="logo" alt="Logo">
            <h1 class="title capitalize">Sertifikat Kelulusan </h1>
            <h2 class="subtitle capitalize">{{ $certificate->certificate_number }}</h2>
        </div>

        <div class="content">
            <p class="description">Diberikan kepada:</p>
            <h2 class="name">{{ $user->name }}</h2>
            <p class="description capitalize">atas keberhasilan menyelesaikan pembelajaran</p>
            <h3 class="course-title">{{ $course->title }}</h3>
            <p class="description capitalize">dengan total {{ $course->duration }} jam pembelajaran</p>
            <p class="description">{{ \Carbon\Carbon::parse($certificate->issued_date)->isoFormat('D MMMM Y') }}</p>
        </div>

        <div class="signatures">
            <table style="width: 100%;">
                <tr>
                    <td class="signature-box">
                        <img src="{{ public_path('images/signature2.png') }}" class="signature-img"
                            alt="Tanda Tangan Instruktur">
                        <div class="signature-line"></div>
                        <p class="signature-name">{{ $course->instructor->name }}</p>
                        <p class="signature-title">Instruktur</p>
                    </td>
                    <td class="signature-box">
                        <img src="{{ public_path('images/signature.png') }}" class="signature-img"
                            alt="Tanda Tangan Direktur">
                        <div class="signature-line"></div>
                        <p class="signature-name">Anna Michelle Chen</p>
                        <p class="signature-title">Direktur Luminus</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
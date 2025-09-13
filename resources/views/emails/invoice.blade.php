<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran Kursus</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --success-color: #10b981;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
        }
        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, var(--primary-color), #1e40af);
            color: white;
            padding: 2rem;
            position: relative;
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }
        .logo-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .logo {
            max-width: 180px;
        }
        .invoice-id {
            font-size: 0.875rem;
            opacity: 0.9;
        }
        .invoice-details {
            padding: 2rem;
        }
        .status-badge {
            display: inline-block;
            background: var(--success-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
        .invoice-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 1.5rem 0;
        }
        .invoice-table th {
            background: #f3f4f6;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #e5e7eb;
        }
        .invoice-table td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .amount {
            font-size: 1.25rem;
            color: var(--primary-color);
            font-weight: 600;
        }
        .qr-section {
            text-align: center;
            margin: 2rem 0;
            padding: 1rem;
            background: #f3f4f6;
            border-radius: 8px;
        }
        .qr-code {
            max-width: 150px;
            margin: 1rem auto;
        }
        .footer {
            background: #1f2937;
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .social-links {
            margin-top: 1rem;
        }
        .social-links a {
            color: white;
            margin: 0 0.5rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-section">
                <img src="{{ asset('images/logo-white.png') }}" alt="Logo" class="logo">
                <div class="invoice-id">Invoice #{{ $transaction->id }}</div>
            </div>
            <h1>Invoice Pembayaran Kursus</h1>
        </div>

        <div class="invoice-details">
            <div class="status-badge">
                ✓ Pembayaran Berhasil
            </div>

            <div class="customer-info">
                <h3>Informasi Pelanggan</h3>
                <p>Nama: <strong>{{ $transaction->user->name }}</strong></p>
                <p>Email: <strong>{{ $transaction->user->email }}</strong></p>
            </div>

            <table class="invoice-table">
                <tr>
                    <th>Deskripsi</th>
                    <th>Detail</th>
                </tr>
                <tr>
                    <td>Nama Kursus</td>
                    <td>{{ $transaction->course->title }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pembelian</td>
                    <td>{{ $transaction->date->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td>Total Pembayaran</td>
                    <td class="amount">Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <h3>Terima kasih telah belajar bersama kami!</h3>
            <p>Jika ada pertanyaan, silakan hubungi tim support kami di:</p>
            <p>support@example.com | +62 812-3456-7890</p>
            <div class="social-links">
                <a href="#">Instagram</a> |
                <a href="#">Facebook</a> |
                <a href="#">Twitter</a>
            </div>
        </div>
    </div>
</body>
</html>
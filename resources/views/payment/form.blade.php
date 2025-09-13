<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - {{ $course->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 0;
        }

        .payment-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .payment-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 2rem;
        }

        .course-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
            margin-bottom: 2rem;
        }

        .course-image {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
        }

        .course-details h3 {
            margin: 0;
            font-size: 1.25rem;
            color: #052742;
        }

        .course-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: #696EFF;
            margin-top: 0.5rem;
        }

        .payment-methods {
            display: grid;
            gap: 1rem;
            margin-top: 2rem;
        }

        .payment-method-option {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method-option:hover {
            border-color: #696EFF;
        }

        .payment-method-option.selected {
            border-color: #696EFF;
            background: rgba(105, 110, 255, 0.05);
        }

        .payment-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .payment-icon i {
            font-size: 24px;
            color: #696EFF;
        }

        .payment-method-details {
            flex: 1;
        }

        .payment-method-details h4 {
            margin: 0;
            font-size: 1rem;
            color: #052742;
        }

        .payment-method-details p {
            margin: 0;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .submit-button {
            background: linear-gradient(to right, #696EFF, #F8ACFF);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 2rem;
            transition: opacity 0.3s ease;
        }

        .submit-button:hover {
            opacity: 0.9;
        }

        .radio-input {
            display: none;
        }
    </style>
</head>

<body>
    <div class="payment-container">
        <div class="payment-card">
            <div class="course-info">
                <img src="{{ asset('storage/' . $course->image_url) }}" alt="{{ $course->title }}" class="course-image">
                <div class="course-details">
                    <h3>{{ $course->title }}</h3>
                    <div class="course-price">
                        @if ($course->discounted_price)
                            <span class="original-price"
                                style="text-decoration: line-through; color: #dc3545; font-size: 1rem;">
                                Rp. {{ number_format($course->original_price, 0, ',', '.') }}
                            </span>
                            <span>Rp. {{ number_format($course->discounted_price, 0, ',', '.') }}</span>
                        @else
                            <span>Rp. {{ number_format($course->original_price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                </div>
            </div>

<form action="{{ route('payment.process') }}" method="POST">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course->id }}">

    <div class="payment-methods">
        <label class="payment-method-option">
            <input type="radio" name="payment_method" value="credit_card" class="radio-input" required>
            <div class="payment-icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <div class="payment-method-details">
                <h4>Kartu Kredit</h4>
                <p>Pembayaran aman dengan kartu kredit</p>
            </div>
        </label>

        <label class="payment-method-option">
            <input type="radio" name="payment_method" value="bank_transfer" class="radio-input">
            <div class="payment-icon">
                <i class="fas fa-university"></i>
            </div>
            <div class="payment-method-details">
                <h4>Transfer Bank</h4>
                <p>Transfer melalui ATM atau mobile banking</p>
            </div>
        </label>

        <label class="payment-method-option">
            <input type="radio" name="payment_method" value="paypal" class="radio-input">
            <div class="payment-icon">
                <i class="fab fa-paypal"></i>
            </div>
            <div class="payment-method-details">
                <h4>PayPal</h4>
                <p>Pembayaran online yang aman dan cepat</p>
            </div>
        </label>
    </div>

<div class="flex gap-4 mt-8">
    <button type="button" class="submit-button flex-1" onclick="confirmPayment()">
        Bayar Sekarang
    </button>

    <a href="{{ route('payment.cancel') }}"
        class="cancel-button flex-1 bg-white text-center py-4 px-6 rounded-xl border-2 border-red-500 text-red-500 font-semibold hover:bg-red-50 transition-colors">
        Batalkan
    </a>
</div>
</form>
        </div>
    </div>

    <script>
        // Add selected class to payment method when clicked
        document.querySelectorAll('.payment-method-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-method-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });

        function confirmPayment() {
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        let selectedMethod = false;

        paymentMethods.forEach(method => {
            if (method.checked) {
                selectedMethod = true;
            }
        });

        if (!selectedMethod) {
            alert('Silakan pilih metode pembayaran.');
        } else {
            if (confirm('Apakah Anda yakin ingin melanjutkan pembayaran?')) {
                document.querySelector('form').submit();
            }
        }
    }

    // Add selected class to payment method when clicked
    document.querySelectorAll('.payment-method-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.payment-method-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            this.classList.add('selected');
        });
    });
    
    </script>
</body>

</html>

<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')" style="background-color: #4F46E5; padding: 20px; text-align: center;">
            <img src="{{ asset('images/logo-white.png') }}" alt="{{ config('app.name') }}" style="max-height: 60px; margin-bottom: 10px;">
            <h1 style="color: #ffffff; font-size: 24px; margin: 0;">{{ config('app.name') }}</h1>
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    <div style="padding: 40px 30px; background-color: #ffffff;">
        <div style="max-width: 600px; margin: 0 auto;">
            {{ $slot }}
        </div>
    </div>

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy style="background-color: #F9FAFB; border-top: 1px solid #E5E7EB; padding: 20px 30px;">
                <p style="color: #6B7280; font-size: 14px; line-height: 1.6; margin: 0;">
                    {{ $subcopy }}
                </p>
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer style="background-color: #1F2937; color: #F3F4F6; padding: 40px 30px;">
            <div style="max-width: 600px; margin: 0 auto; text-align: center;">
                <img src="{{ asset('images/logo-white.png') }}" alt="{{ config('app.name') }}" style="max-height: 40px; margin-bottom: 20px;">
                
                <div style="margin-bottom: 25px;">
                    <a href="#" style="color: #F3F4F6; text-decoration: none; margin: 0 10px;"><img src="{{ asset('images/icons/facebook.png') }}" alt="Facebook" style="height: 24px;"></a>
                    <a href="#" style="color: #F3F4F6; text-decoration: none; margin: 0 10px;"><img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram" style="height: 24px;"></a>
                    <a href="#" style="color: #F3F4F6; text-decoration: none; margin: 0 10px;"><img src="{{ asset('images/icons/twitter.png') }}" alt="Twitter" style="height: 24px;"></a>
                </div>

                <div style="margin-bottom: 20px;">
                    <a href="#" style="color: #F3F4F6; text-decoration: none; margin: 0 15px; font-size: 14px;">Tentang Kami</a>
                    <a href="#" style="color: #F3F4F6; text-decoration: none; margin: 0 15px; font-size: 14px;">Kebijakan Privasi</a>
                    <a href="#" style="color: #F3F4F6; text-decoration: none; margin: 0 15px; font-size: 14px;">Syarat & Ketentuan</a>
                </div>

                <div style="margin-bottom: 20px; font-size: 14px; color: #9CA3AF;">
                    <p style="margin: 0 0 10px;">
                        Jl. Contoh No. 123, Jakarta Pusat<br>
                        Telepon: (021) 123-4567<br>
                        Email: info@example.com
                    </p>
                </div>

                <div style="font-size: 12px; color: #9CA3AF; border-top: 1px solid #374151; padding-top: 20px;">
                    <p style="margin: 0;">© {{ date('Y') }} {{ config('app.name') }}. Seluruh hak cipta dilindungi undang-undang.</p>
                </div>
            </div>
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
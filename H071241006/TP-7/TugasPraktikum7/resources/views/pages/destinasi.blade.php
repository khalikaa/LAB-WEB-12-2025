@extends('layouts.master')

@section('title', 'Destinasi Wisata')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-4 border-red-700 pb-3">Destinasi Unggulan Yogyakarta</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <x-card title="Candi Prambanan"  image="prambanan.jpg">
            Kompleks candi Hindu terbesar di Indonesia yang dibangun pada abad ke-9. Keindahan arsitekturnya yang megah menceritakan kisah Roro Jonggrang. Sebuah situs warisan dunia UNESCO.
        </x-card>
        
        <x-card title="Pantai Parangtritis" image="parangtritis.jpg">
            Pantai legendaris di selatan Jogja. Terkenal dengan gumuk pasirnya yang luas dan pemandangan matahari terbenam yang dramatis. Sering dikaitkan dengan legenda Ratu Kidul.
        </x-card>
        
        <x-card title="Jalan Malioboro" image="malioboro.jpg">
            Jantung perbelanjaan dan wisata kota. Tempat yang sempurna untuk mencari batik, cinderamata, dan menikmati suasana kota yang ramai. Wajib dikunjungi saat malam hari.
        </x-card>

        <x-card title="Taman Sari (Water Castle)" image="taman-sari.jpg">
            Bekas taman dan tempat pemandian Sultan. Kompleks ini memiliki arsitektur yang unik dan lorong-lorong rahasia. Menyimpan sejarah kesultanan yang menarik.
        </x-card>
    </div>
</div>
@endsection

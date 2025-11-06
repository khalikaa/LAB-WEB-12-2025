@extends('layouts.master')
@section('title', 'Destinasi Wisata - Eksplorasi Bone')
@section('content')

    <div style="text-align: center; padding-bottom: 20px;">
        <h1>Destinasi Unggulan Bone</h1>
        <p style="font-size: 1.1em; color: #555;">Jelajahi ikon-ikon populer di Bumi Arung Palakka.</p>
    </div>
    <div class="destinasi-container">
        
        <x-card title="Gua Mampu" image="https://tse1.mm.bing.net/th/id/OIP.7BOXBEw6nQ0vxYW3P8LZ2QHaEK?pid=Api&P=0&h=180">
            Gua bersejarah yang legendaris di Bone. Terkenal dengan stalaktit dan stalagmitnya 
            yang menyerupai wujud manusia dan hewan, menyimpan banyak cerita rakyat.
        </x-card>

        <x-card title="Tanjung Pallette" image="https://fajar.co.id/wp-content/uploads/2023/06/IMG_ORG_1627107892109.jpeg">
            Kawasan wisata bahari yang indah dengan tebing-tebing karang yang menjorok ke laut. 
            Menawarkan pemandangan laut lepas yang memukau dan spot foto yang menarik.
        </x-card>

        <x-card title="Air Terjun Baruga" image="https://tempatwisataseru.com/wp-content/uploads/2023/01/Air-Terjun-Baruga-e1674951137283.jpg">
            Setelah lelah menghabiskan banyak energi untuk menyelesaikan pekerjaan, anda bisa mencari udara segar dengan mengunjungi air terjun Baruga. 
            Di air terjun ini anda bisa menikmati segarnya udara yang tersedia dengan bersantai di atas hammock.
        </x-card>

    </div>

@endsection
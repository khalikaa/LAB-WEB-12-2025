@extends('layouts.master')

@section('title', 'Kuliner Khas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-4 border-red-700 pb-3">Kuliner Khas Wajib Coba Yogyakarta</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <x-card title="Gudeg Jogja" image="gudeg.jpg">
            Makanan khas dari nangka muda yang dimasak dengan santan dan gula aren selama berjam-jam. Dikenal dengan rasanya yang manis legit. Sering disajikan dengan krecek pedas dan ayam.
        </x-card>
        
        <x-card title="Bakpia Pathok" image="bakpia.jpg">
            Oleh-oleh ikonik Jogja berupa kue bulat pipih berisi kacang hijau manis atau varian rasa modern lainnya. Nama 'Pathok' berasal dari nama jalan di mana kue ini pertama kali populer.
        </x-card>
        
        <x-card title="Sate Klatak" image="sate-klatak.jpg">
            Sate kambing muda yang ditusuk menggunakan jeruji sepeda dan hanya dibumbui garam. Dibakar di atas bara api, menghasilkan rasa yang gurih dan daging yang sangat empuk.
        </x-card>

        <x-card title="Oseng Mercon" image="oseng-mercon.jpg">
            Oseng-oseng daging sapi (gajih/tetelan) yang dimasak dengan cabai rawit super pedas hingga rasanya meledak di mulut. Cocok untuk pecinta makanan pedas.
        </x-card>
    </div>
</div>
@endsection
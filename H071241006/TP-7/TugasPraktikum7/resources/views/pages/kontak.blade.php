@extends('layouts.master')

@section('title', 'Kontak Kami')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-4 border-red-700 pb-3">Hubungi Kami</h2>
    
    <div class="bg-white shadow-xl rounded-lg p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
            <ul class="space-y-3 text-gray-700">
                <li><strong class="font-medium">Kantor Pusat Pariwisata:</strong> Jl. Malioboro No.10, Yogyakarta</li>
                <li><strong class="font-medium">Telepon:</strong> 111111111</li>
                <li><strong class="font-medium">Email:</strong> info@pariwisatajogja.go.id</li>
                <li><strong class="font-medium">Jam Kerja:</strong> Senin - Jumat, 08:00 - 16:00 WIB</li>
            </ul>
        </div>

        <div>
            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Kirim Pesan (Simulasi Form)</h3>
            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-red-500 focus:border-red-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-red-500 focus:border-red-500">
                </div>
                <div>
                    <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan/Saran</label>
                    <textarea id="pesan" name="pesan" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-red-500 focus:border-red-500"></textarea>
                </div>
                <button type="submit" class="w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Kirim Pesan
                </button>
            </form>
        </div>
        
    </div>
</div>
@endsection
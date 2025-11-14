@extends('layouts.master')

@section('title', 'Kontak')
@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Hubungi Kami</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Informasi Kontak -->
        <div>
            <h3 class="text-2xl font-semibold mb-6">Informasi Kontak</h3>
            
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <span class="text-blue-600">📍</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Alamat</h4>
                        <p class="text-gray-600">Jl. Malioboro No. 123<br>Yogyakarta, Indonesia 55271</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <span class="text-green-600">📞</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Telepon</h4>
                        <p class="text-gray-600">+62 274 123456</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-purple-100 p-3 rounded-lg mr-4">
                        <span class="text-purple-600">📧</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Email</h4>
                        <p class="text-gray-600">info@eksplorpariwisata.id</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                        <span class="text-yellow-600">🕒</span>
                    </div>
                    <div>
                        <h4 class="font-semibold">Jam Operasional</h4>
                        <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 15:00</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Kontak -->
        <div>
            <h3 class="text-2xl font-semibold mb-6">Kirim Pesan</h3>
            
            <form class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="subjek" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                    <input type="text" id="subjek" name="subjek" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="pesan" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                    <textarea id="pesan" name="pesan" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
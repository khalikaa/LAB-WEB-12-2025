@extends('layouts.master')

@section('title', 'Kontak Kami')

@section('content')
    <h2 class="text-3xl font-extrabold text-amber-700 mb-6 border-b pb-3">Informasi Kontak dan Saran</h2>
    
    <div class="mb-10 p-6 bg-amber-50 border-l-4 border-amber-500 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-amber-800 mb-3">Pariwisata Soppeng Official</h3>
        <ul class="space-y-2 text-gray-700">
            <li class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                Email: <span class="ml-2 font-medium">info@soppengtourism.co.id</span>
            </li>
            <li class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.772-1.547a1 1 0 011.06-.54l4.435.74A1 1 0 0118 16.847V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                Telepon: <span class="ml-2 font-medium">(0484) XXX XXX</span>
            </li>
        </ul>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-2xl border border-amber-200">
        <h3 class="text-2xl font-bold text-amber-700 mb-6">Kirim Pesan Anda</h3>
        
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
            </div>

            <div>
                <label for="pesan" class="block text-sm font-medium text-gray-700 mb-1">Pesan/Saran</label>
                <textarea id="pesan" name="pesan" rows="4" required 
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500 sm:text-sm"></textarea>
            </div>

            <div>
                <button type="submit" 
                        class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150">
                    Kirim Pesan
                </button>
            </div>
        </form>
    </div>
@endsection
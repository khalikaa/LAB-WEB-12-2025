@extends('layouts.master')
@section('title', 'Kontak Kami - Eksplorasi Bone')
@section('content')

    <div style="text-align: center; padding-bottom: 20px;">
        <h1>Hubungi Kami</h1>
        <p style="font-size: 1.1em; color: #555;">Punya pertanyaan atau masukan? Silakan isi form di bawah ini.</p>
    </div>

    <div class="contact-container">
        
        <div class="contact-info">
            <h3>Informasi Kontak</h3>
            <p>
                <strong>Dinas Pariwisata Kabupaten Bone</strong><br>
                Jl. Poros Bone-Makassar<br>
                Watampone, Sulawesi Selatan
            </p>
            <p>
                <strong>Email:</strong> info@pariwisatabone.go.id<br>
                <strong>Telepon:</strong> (0481) 123-456
            </p>
            <p>
                Kunjungi juga media sosial kami untuk info terbaru seputar 
                event dan destinasi wisata di Bone.
            </p>
        </div>

        <div class="contact-form">
            <h3>Formulir Kontak</h3>
            <p>Form ini tidak berfungsi, hanya untuk tampilan tugas.</p>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-group">
                    <label for="nama">Nama Anda</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda">
                </div>
                <div class="form-group">
                    <label for="email">Email Anda</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda">
                </div>
                <div class="form-group">
                    <label for="pesan">Pesan Anda</label>
                    <textarea id="pesan" name="pesan" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Kirim Pesan</button>
                </div>
            </form>
        </div>

    </div>
@endsection
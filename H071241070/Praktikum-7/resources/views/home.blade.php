@extends('layouts.master')
@section('title', 'Home - Eksplorasi Bone')
@section('main_class', '') {{-- Ini akan membuat <main> jadi full-width --}}
@section('content')

    <div class="hero-tailwind-style" style="background-image: url('{{ asset('images/bone.png') }}');">
        
        <div class="hero-overlay"></div>
        
        <div class="hero-text-content">
            <h1>Selamat Datang di Eksplorasi Bone!</h1>
            <p>Menyusuri Jejak Sejarah dan Keindahan Alam di Tanah Bugis</p>
            <div class="hero-buttons">
                <a href="/destinasi" class="btn btn-primary">Lihat Destinasi</a>
                <a href="#tentang" class="btn btn-secondary">Tentang Bone</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content-tentang" id="tentang">
            <h2>Tentang Bone</h2>
            <p>Kabupaten Bone, yang beribukota di Watampone, adalah salah satu daerah bersejarah di Sulawesi Selatan. 
                Dikenal sebagai "Bumi Arung Palakka", Bone memiliki warisan kerajaan Bugis yang kaya dan masih kental terasa hingga kini.</p>
            <p>Dari gua-gua prasejarah yang menakjubkan, peninggalan istana kerajaan, hingga pesona 
            alam bahari di pesisirnya, Bone menawarkan perpaduan unik antara wisata sejarah, 
            budaya, dan alam.</p>
        </div>
    </div>

@endsection
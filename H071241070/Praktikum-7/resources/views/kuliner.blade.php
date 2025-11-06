@extends('layouts.master')

@section('title', 'Kuliner Khas - Eksplorasi Bone')

@section('content')

    <div style="text-align: center; padding-bottom: 20px;">
        <h1>Kuliner Khas Bone</h1>
        <p style="font-size: 1.1em; color: #555;">Cicipi cita rasa otentik dari Tanah Bugis.</p>
    </div>

    <div class="destinasi-container">
        
        <x-card title="Sop Konro" image="https://tse3.mm.bing.net/th/id/OIP.LEs2Mad0KWU55LlQkEdMoAHaE7?pid=Api&P=0&h=180">
            Meskipun populer di Makassar, Sop Konro (sup iga sapi) memiliki akar yang kuat 
            dari tradisi Bugis Bone. Disajikan dengan kuah kental berwarna gelap 
            kaya rempah, rasanya sangat khas.
        </x-card>

        <x-card title="Nasu Palekko" image="https://asset.kompas.com/crops/Jnh2ZHYPfwqmnVhu1x7etPTy65M=/7x64:695x523/750x500/data/photo/2023/09/30/6518473b580d6.jpg">
            Masakan khas Bugis berupa daging (biasanya bebek atau ayam) yang dicincang 
            dan dimasak kering dengan bumbu cabai dan rempah yang sangat pedas dan 
            meresap.
        </x-card>

        <x-card title="Barobbo" image="https://asset.kompas.com/crops/GSnSkWBe5h40j7LWWoUMlDfHYtA=/0x0:698x465/1200x800/data/photo/2021/06/13/60c5dd1340bb7.jpg">
            Bubur jagung pulut khas Bone yang dimasak dengan sayuran seperti 
            kangkung, bayam, dan labu kuning. Rasanya gurih dan sering 
            disajikan sebagai makanan utama.
        </x-card>

    </div>

@endsection
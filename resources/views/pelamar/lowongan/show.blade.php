{{-- /resources/views/pelamar/lowongan/show.blade.php --}}

@extends('pelamar.layouts.app') {{-- Sesuaikan dengan nama layout utama Anda --}}

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            {{-- Cukup panggil partial-nya. Variabel $detailLowongan dan $saved_lowongan_ids akan otomatis terbawa --}}
            @include('pelamar.lowongan.partials._job-detail')
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
    <style>
        .kelas:hover {
            background-color: #262635;
        }
    </style>
@endsection

@section('js')

@endsection

@section('content')
<div class="page-heading">
    <h2>KelasKu</h2>
</div> 
<div id="main-content">           
    <div class="page-content"> 
        <section class="row">
            @forelse ($kelas as $kelas)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card rounded-4">
                        @if ($kelas->status === 'selesai')
                            <a href="{{route('user.masuk-kelasku', $kelas->kelas_id)}}">
                                <div class="card-content kelas rounded-4">
                                    <div style="height: 11rem; background-image: url('{{ Storage::url('thumbnails/' . $kelas->thumbnail) }}'); background-size: cover; background-position: center;" class="card-img-top img-fluid"></div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{$kelas->nama_kelas}}</h3>
                                        <h5 class="card-sub-title text-light">{{$user->name}}</h5>
                                    </div>
                                </div>
                            </a>
                        @else
                            <div class="card-content kelas rounded-4">
                                <div style="height: 11rem; background-image: url('{{ Storage::url('thumbnails/' . $kelas->thumbnail) }}'); background-size: cover; background-position: center;" class="card-img-top img-fluid"></div>
                                <div class="card-body">
                                    <h3 class="card-title">{{$kelas->nama_kelas}}</h3>
                                    <a href="{{route('user.lanjut-beli', $kelas->id)}}" class="btn btn-primary me-1 mb-1">Lanjut Beli</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 d-flex justify-content-center p-5">
                    <h4>Belum Ada Kelas</h4>
                </div>
            @endforelse
        </section>
    </div>
</div>
@endsection

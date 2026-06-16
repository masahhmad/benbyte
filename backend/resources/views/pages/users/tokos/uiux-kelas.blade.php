@extends('layouts.app')

@section('css')
    <style>
        .kelas:hover {
            background-color: #222231;
        }
    </style>
@endsection

@section('js')

@endsection

@section('content')
<div class="page-heading">
    <h2>Kelas UI/UX Design</h2>
</div> 
<div id="main-content">
    <div class="page-content"> 
        <section class="row">
            @forelse ($kelases as $kelas)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card rounded-4">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('beli-kelas-{{ $kelas->id }}').submit();">
                            <div class="card-content kelas rounded-4">
                                <div style="height: 11rem; background-image: url('{{ Storage::url('thumbnails/' . $kelas->thumbnail) }}'); background-size: cover; background-position: center;" class="card-img-top img-fluid"></div>
                                <div class="card-body">
                                    <h3 class="card-title">{{$kelas->nama_kelas}}</h3>
                                    <h5 class="card-sub-title text-light">{{$kelas->harga_format}}</h5>
                                    <p class="card-text">{{$user[$kelas->id]->name}}</p>
                                    
                                </div>
                            </div>
                        </a>
                        
                        <form id="beli-kelas-{{ $kelas->id }}" action="{{route('user.beli-kelas')}}" method="POST" style="display:none;">
                            @csrf
                            <input type="hidden" value="{{$kelas->id}}" name="kelas_id">
                            <input type="hidden" value="{{$kelas->harga}}" name="harga_kelas">
                            <input type="hidden" value="{{$kelas->kategori}}" name="kategori">
                            <input type="hidden" value="{{$kelas->nama_kelas}}" name="nama_kelas">
                            <input type="hidden" value="{{$kelas->thumbnail}}" name="thumbnail">
                        </form>
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
@extends('layouts.app')

@section('css')
<link rel="stylesheet" crossorigin href="{{asset('mazer/assets/compiled/css/iconly.css')}}">
    <style>
        .kelas:hover {
            background-color: #222231;
        }
        .card-text {
            color: #435ebe;
        }
    </style>
@endsection

@section('content')
<div class="container"> 
    <div class="page-content"> 
        <section class="row">
            {{-- detail --}}
            <div class="col-12 pt-6">
                <div class="card rounded-4">
                    <div class="card-content rounded-4">
                        <div class="card-body row">
                            <h3 class="card-title col-8">{{$kreator->name}}</h3>
                            <h1 class="col-4">{{$total_duwit}}</h1>
                            <h5 class="card-sub-title text-light col-8">Total Kelas : {{$jumlah_kelas}}</h5>
                            <p class="card-text">Sejak {{$kreator->created_at->translatedFormat('d F Y')}}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- kelas --}}
            @forelse ($kelases as $kelas)
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="card rounded-4">
                        <a href="{{route('admin.detail-kelas-kreator', $kelas->id)}}">
                            <div class="card-content kelas rounded-4">
                                <div style="height: 11rem; background-image: url('{{ Storage::url('thumbnails/' . $kelas->thumbnail) }}'); background-size: cover; background-position: center;" class="card-img-top img-fluid"></div>
                                <div class="card-body">
                                    <h3 class="card-title">{{$kelas->nama_kelas}}</h3>
                                    <h5 class="card-sub-title text-light">{{$kelas->harga_format}}</h5>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('hapus-konten-{{ $kelas->id }}').submit();" id="editLabel" class="d-flex justify-content-end mx-2">
                                        <i class="fa-solid fs-4 fa-trash-can"></i>
                                    </a>

                                    <form id="hapus-konten-{{ $kelas->id }}" action="{{ route('admin.delete-kelas', $kelas->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                
            @endforelse
        </section>
    </div>
</div>
@endsection
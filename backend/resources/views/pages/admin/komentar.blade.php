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
        <h2>Komentar</h2>
    </div>
    <div id="main-content">
        <div class="page-content"> 
            @forelse ($komens as $komen)
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-text">{{$komen->created_at->translatedFormat('d F Y')}}</h6>
                        </div>
                        <div class="card-body">
                            <p>{{$komen->name}}</p>
                            <hr>
                            <p>{{$komen->komen}}</p>
                            <div class="d-flex justify-content-end">
                                <a href="{{route('admin.hapus-komentar', $komen->id)}}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <h2>
                        Belum Ada Komentar
                    </h2>
                </div>
            @endforelse
        </div>
    </div>
@endsection
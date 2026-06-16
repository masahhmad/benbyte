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

        .blog-artikel {
            white-space: pre-wrap;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="page-content"> 
        <section>
            {{-- detail --}}
            <div class="col-12 pt-6">
                <div class="d-flex justify-content-center">
                    <h1>{{$blog->judul_artikel}}</h1>
                </div>
            </div>

            {{-- detail --}}
            <div class="col-12 my-3 d-flex justify-content-center">
                <div class="image col-8" style="height: 26rem; background-image: url('{{ Storage::url('blogs/' . $blog->gambar) }}'); background-size: cover; background-position: center;"></div>
            </div>

            {{-- kelas --}}
            <div class="col-12 pt-3 mb-5">
                <p class="blog-artikel">{{$blog->artikel}}</p>
            </div>
        </section>
    </div>
</div>
@endsection
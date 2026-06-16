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
        @if (Auth::user()->role === 'admin')
            <div class="col-12">
                <div class="card rounded-4">
                    <div class="card-content rounded-4">
                        <div class="card-body row">
                            <form class="form" method="POST" action="{{route('admin.update-blog', $blog->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="judul_artikel">Judul Artikel</label>
                                            <input type="text" value="{{$blog->judul_artikel}}" id="judul_artikel" class="form-control" placeholder="Nama Kelas" name="judul_artikel">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="image">Gambar</label>
                                            <input type="file" id="image" class="form-control" placeholder="Gambar" name="image">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="artikel">Isi Artikel</label>
                                            <textarea style="height: 12rem;" type="text-area" id="artikel" class="form-control" placeholder="Isi Artikel" name="artikel">{{ old('content', $blog->artikel) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="card rounded-4">
                    <div class="card-content rounded-4">
                        <div class="card-body row">
                            <form class="form" method="POST" action="#" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="label_video">Label Video</label>
                                            <input type="text" id="label_video" class="form-control" placeholder="Label Video" name="label_video">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="image">Gambar</label>
                                            <input type="file" id="image" class="form-control" placeholder="Gambar" name="image">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
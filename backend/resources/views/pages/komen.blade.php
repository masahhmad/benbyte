@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="container">
    <div class="page-content"> 
        <section>
            {{-- detail --}}
            <div class="col-12 pt-6">
                <div class="d-flex justify-content-center">
                    <h1>Komentar</h1>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <form class="form" method="POST" action="{{route(Auth::user()->role . '.kirim-komentar')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama_komen">Judul Artikel</label>
                                    <input type="text" id="nama_komen" class="form-control" placeholder="Nama Kelas" name="nama_komen">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea style="height: 12rem;" type="text-area" id="komentar" class="form-control" placeholder="Isi Komentar" name="komentar"></textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <a href="{{route(Auth::user()->role . '.home')}}" class="btn btn-secondary me-1 mb-1">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
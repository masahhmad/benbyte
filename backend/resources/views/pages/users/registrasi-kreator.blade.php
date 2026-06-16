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
        <section class="card">
            <div class="card-header">
                <h3>Registrasi Kreator</h3>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{route('user.kirim-registrasi-kreator', Auth::user()->id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" value="{{$user->name}}" id="nama" class="form-control" placeholder="Nama" name="nama" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="telp">No. Telp</label>
                                <input type="text" id="telp" class="form-control" placeholder="No. Telp" name="telp">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" value="{{$user->email}}" class="form-control" placeholder="Email" name="email" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="asal">Tempat Asal</label>
                                <input type="text" id="asal" class="form-control" placeholder="asal" name="asal">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
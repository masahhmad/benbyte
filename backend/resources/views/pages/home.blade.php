@extends('layouts.app')

@section('css')
    <link rel="stylesheet" crossorigin href="{{asset('mazer/assets/compiled/css/iconly.css')}}">
@endsection

@section('js')
    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
@endsection

@section('content')
@if (Auth::user()->role === 'admin')
    <div class="page-heading">
        <h2>Kelola Blog</h2>
    </div>
@else
    <div class="page-heading">
        <h2>Blogs</h2>
    </div>
@endif 
 
<div id="main-content">           
    <div class="page-content"> 
        <section class="row">
            @if (Auth::user()->role === 'admin')

                {{-- form input artikel --}}
                <div class="col-12">
                    <div class="card rounded-4">
                        <div class="card-content kelas rounded-4">
                            <div class="card-body row">
                                <form class="form" method="POST" action="{{ route ('admin.tambah-blog')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="judul_artikel">Judul Artikel</label>
                                                <input type="text" id="judul_artikel" class="form-control" placeholder="Nama Kelas" name="judul_artikel">
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
                                                <textarea style="height: 12rem;" type="text-area" id="artikel" class="form-control" placeholder="Isi Artikel" name="artikel"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /form input artikel --}}

            @endif

            {{-- artikel  --}}
            @forelse ($blogs as $blog)
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div style="height: 12rem; background-image: url('{{ Storage::url('blogs/' . $blog->gambar) }}'); background-size: cover; background-position: center;" class="card-img-top img-fluid"></div>

                            <div class="card-body">
                                <h4 class="card-title">{{$blog->judul_artikel}}</h4>
                                <p class="card-text">
                                    {{Str::words($blog->artikel, 20, '...')}}
                                </p>

                                <div class="row p-3">
                                    <a href="{{route(auth::user()->role . '.blog', $blog->id)}}" class="btn btn-primary block col-6">Lanjut Baca</a>
                                    {{-- membedakan action --}}
                                    @if (Auth::user()->role === 'admin')
                                        <div class="col-6 d-flex justify-content-end align-items-center">
                                            <a href="{{route('admin.edit-blog', $blog->id)}}" class="card-text mx-2">
                                                <i class="fa-solid fa-large fs-4 fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{route('admin.hapus-blog', $blog->id)}}">
                                                <i class="fa-solid fa-trash-can fs-4"></i>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- /membedakan action --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 d-flex justify-content-center p-5">
                    <h4>Belum Ada Blog</h4>
                </div>
            @endforelse
            {{-- /artikel --}}

        </section>
    </div>
</div>
@endsection
@extends('layouts.konten')

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<div class="container">     
    <div class="page-content"> 
        <section class="row">
            <div class="col-12 pt-6">
                <div class="card rounded-4">
                    <div class="card-content rounded-4">
                        <div class="card-body row">
                            @if (Route::currentRouteName() === 'kreator.konten-kelas')
                                <form class="form" method="POST" action="{{ route ('kreator.store-konten-kelas', [$kelas->user_id, $kelas->id])}}">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="label_id" id="label_id" value="#"> 
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="label_video">Label Video</label>
                                                <input type="text" id="label_video" class="form-control" placeholder="Label Video" name="label_video">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="link_video">Link Video</label>
                                                <input type="text" id="link_video" class="form-control" placeholder="Masukkan ID YouTube Video" name="link_video">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form class="form" method="POST" action="{{ route ('kreator.update-konten-kelas', $konten2->id)}}">
                                    @csrf
                                    @foreach ($konten as $item)
                                        <div class="row">
                                            <input type="hidden" name="label_id" id="label_id" value="#"> 
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="label_video">Label Video</label>
                                                    <input type="text" value="{{$item->label}}" id="label_video" class="form-control" name="label_video">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="link_video">Link Video</label>
                                                    <input type="text" value="{{$item->konten}}" id="link_video" class="form-control" name="link_video">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                                <a href="{{route('kreator.konten-kelas', $kelas->id)}}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @forelse ($konten as $item)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title mb-0">{{$item->label}}</h4>
                            </div>
                            <div class="embed-responsive embed-responsive-item embed-responsive-16by9 w-100">
                                <iframe src="https://www.youtube.com/embed/{{ $item->konten }}"  style="width:100%" height="300" allowfullscreen=""></iframe>
                            </div>
                            <div class="card-body">
                                <p class="card-text ">{{$user->name}}</p>
                                @if (Auth::user()->role === 'kreator')
                                    <div class="d-flex flex-row">
                                        
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('hapus-konten-{{ $item->id }}').submit();" id="editLabel" class="d-flex justify-content-end mx-2">
                                            <i class="fa-solid fs-4 fa-trash-can"></i>
                                        </a>
                                        
                                        <form id="hapus-konten-{{ $item->id }}" action="{{ route('kreator.hapus-konten', $item->id) }}" method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        
                                        <a href="{{ route ('kreator.edit-konten-kelas', $item->id)}}"><i class="fa-solid fs-4 fa-pen-to-square mx-3"></i></a>
                                    </div>
                                @endif
                            </div>  
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Belum Ada Video</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </section>
    </div>
</div>
@endsection
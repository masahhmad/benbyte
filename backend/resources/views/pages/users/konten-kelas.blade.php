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
            @forelse ($kelases as $item)
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
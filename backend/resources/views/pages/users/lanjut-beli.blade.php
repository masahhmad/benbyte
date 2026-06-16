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
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    @foreach ($kelases as $kelas)   
                        <div class="card-content">
                            <div style="height: 12rem; background-image: url({{ Storage::url('thumbnails/' . $kelas->thumbnail) }}); background-size: cover; background-position: center;" class="card-img-top img-fluid"></div>

                            <div class="card-body">

                                <h1 class="card-title">{{$kelas->nama_kelas}}</h1>

                                <p class="card-text">
                                    {{$kelas->deskripsi}}
                                </p>

                            </div>
                        </div>
                            <div class="col-12 p-4">
                                <div class="com-md-6 col-sm-12 d-flex justify-content-between">
                                    <h4>Harga Kelas : </h4>
                                </div>
                                <div class="com-md-6 col-sm-12 d-flex justify-content-between">
                                    <h4>{{$kelas->harga_format}}</h4>
                                </div>
                                <div class="com-md-6 col-sm-12 d-flex justify-content-end">
                                    <button type="button" id="pay-button" class="btn btn-primary me-1 mb-1">Beli</button>
                                    <a href="{{ url()->previous()}}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                </div>
                            </div>
                @endforeach
                </div>
            </div> 
        </section>
    </div>
</div>
@endsection

@section('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.clientKey')}}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
      // SnapToken acquired from previous step
      snap.pay("{{$data_token}}", {
        // // Optional
        // onSuccess: function(result){
        //   window.location.href = "{{route('user.lanjut-beli-sukses', $data_trans)}}";
        // },
        // // Optional
        // onPending: function(result){
        //   window.location.href = "{{route('user.lanjut-beli-sukses')}}"; 
        // },
        // // Optional
        // onError: function(result){
        //   window.location.href = "{{route('user.lanjut-beli-sukses')}}";
        // }
      });
    };
  </script>
@endsection
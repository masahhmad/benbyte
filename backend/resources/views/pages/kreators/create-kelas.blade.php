@extends('layouts.app')

@section('css')
    <link rel="stylesheet" crossorigin href="{{asset('mazer/assets/compiled/css/iconly.css')}}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/table-datatable.css') }}">
    <style>
    .card {
        margin-top: 20px;
    }
    .table {
        border-radius: 0px !important;
        overflow: hidden;
        /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); */
        width: 100%;
        margin-top: 14px !important;
        margin: auto;
        border-collapse: collapse;
    }
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    .table th {
        background-color: #306c90 !important; /* Solid color for the header */
        color: white !important;
        font-size: 1.1em !important;
        font-weight: bold !important;
        text-transform: uppercase;
        text-align: center !important; /* Center text in header */
    }
    .table tr:nth-child(even) {
        background-color: #f9f9f9; /* Light gray for even rows */
    }
    .table tr:hover {
        background-color: #e7f3ff; /* Light blue on hover */
        transition: background-color 0.3s ease; /* Smooth transition */
    }
    .table img {
        border-radius: 8px; /* Adjusted for square shape */
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    .badge {
        font-size: 0.9em;
        padding: 5px 10px;
    }
    .badge.bg-success {
        background-color: #28a745;
    }
    .badge.bg-warning {
        background-color: #ffc107;
    }
    .badge.bg-danger {
        background-color: #dc3545;
    }

    /* Responsive table */
    @media (max-width: 768px) {
        .table {
            font-size: 0.9em;
        }
        .table th, .table td {
            padding: 10px; /* Adjust padding for smaller screens */
        }
    }
    </style>
@endsection

@section('js')
    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
@endsection

@section('content')           
<div class="page-heading">
    <h3>Buat Kelas</h3>
</div> 
<div class="page-content"> 
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route ('kreator.store-kelas')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama_kelas">Nama Kelas</label>
                                            <input type="text" id="nama_kelas" class="form-control" placeholder="Nama Kelas" name="nama_kelas">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi Kelas</label>
                                            <input type="text-area" id="deskripsi" class="form-control" placeholder="Deskripsi Singkat" name="deskripsi">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="kategori">Kategori Kelas</label>
                                            <select class="form-select" id="kategori" name="kategori">:
                                                <option value="programming">Programming</option>
                                                <option value="uiux">UIUX Design</option>
                                                <option value="network">Network Engineering</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="thumbnail">Thumbnail</label>
                                            <input class="form-control" type="file" id="thumbnail" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="input" id="harga" class="form-control" placeholder="Harga" name="harga">
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
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">

                <h4 class="card-title">
                    Simple Datatable
                </h4>

            </div>
            <div class="card-body">
                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                    <div class="dataTable-top">
                        <div class="dataTable-dropdown">
                            <select class="dataTable-selector form-select">
                                <option value="5">5</option>
                                <option value="10" selected="">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                            </select>
                            <label> entries per page</label>
                        </div>
                        <div class="dataTable-search">
                            <input class="dataTable-input" placeholder="Search..." type="text">
                        </div>
                    </div>
                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                                <tr>
                                    <th data-sortable="" style="width: 13.037%;">
                                        <a href="#" class="dataTable-sorter">No</a>
                                    </th>
                                    <th data-sortable="" style="width: 46.0741%;">
                                        <a href="#" class="dataTable-sorter">Nama Kelas</a>
                                    </th>
                                    <th data-sortable="" style="width: 12.4444%;">
                                        <a href="#" class="dataTable-sorter">Karegori</a>
                                    </th>
                                    <th data-sortable="" style="width: 12.2963%;">
                                        <a href="#" class="dataTable-sorter">Status</a>
                                    </th>
                                    <th data-sortable="" style="width: 12.2963%;" colspan="3">
                                        <a href="#" class="dataTable-sorter">Action</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @forelse ($kelases as $kelas)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$kelas->nama_kelas}}</td>
                                        <td>{{$kelas->kategori}}</td>
                                        <td>
                                            <span class="badge bg-success">{{$kelas->status}}</span>
                                        </td>
                                        <td>
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('ganti-status-form-{{ $kelas->id }}').submit();">
                                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                            </a>
                                            
                                            <form id="ganti-status-form-{{ $kelas->id }}" action="{{ route('kreator.ganti-status', $kelas->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{route('kreator.delete-kelas', $kelas->id)}}"><i class="fa-solid fa-trash-can"></i></i></a>
                                        </td>
                                        <td>
                                            <a href="{{route('kreator.konten-kelas', $kelas->id)}}"><i class="fa-solid fa-arrow-right"></i></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr>
                                        <td colspan="5"><p>Belum Ada Kelas</p></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-bottom">
                        <div class="dataTable-info">Showing 1 to 10 of 26 entries</div>
                        <nav class="dataTable-pagination">
                            <ul class="dataTable-pagination-list pagination pagination-primary">
                                <li class="active page-item">
                                    <a href="#" data-page="1" class="page-link">1</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" data-page="2" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" data-page="3" class="page-link">3</a>
                                </li>
                                <li class="pager page-item">
                                    <a href="#" data-page="2" class="page-link">›</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
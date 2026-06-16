@extends('layouts.app')

@section('css')
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


    {{-- ApexCart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
    var options = {
    chart: {
        height: 280,
        type: "area"
    },
    dataLabels: {
        enabled: false
    },
    series: [
        {
        name: "Series 1",
        data: [45, 52, 38, 45, 19, 23, 2]
        }
    ],
    fill: {
        type: "gradient",
        gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        stops: [0, 90, 100]
        }
    },
    xaxis: {
        categories: [
        "01 Jan",
        "02 Jan",
        "03 Jan",
        "04 Jan",
        "05 Jan",
        "06 Jan",
        "07 Jan"
        ]
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();

    </script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header text-center text-uppercase bg-primary text-white">
                <h4 class="card-title">Peringkat Kreator</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <table class="table table-striped" id="pengaduan">
                        <thead class="table-light">
                            <tr>
                                <th>Kreator</th>
                                <th>Peringkat</th>
                                <th>Jumlah Kelas Terjual</th>
                                <th>Bergabung Sejak</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kreators as $kreator)
                                <tr>
                                    <td>{{$kreator->name}}</td>
                                    <td>#1</td>
                                    <td>1200</td>
                                    <td>{{$kreator->created_at->translatedFormat('d F Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.view-kreator', $kreator->id)}}">Lihat Profile</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.delete-kreator', $kreator->id)}}">
                                            <i class="fa-solid fa-delete-left"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Belum Ada Kreator</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection
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
    // Ambil data dari PHP
    const transactionsData = @json($transactionsPerDay);

    // Pisahkan key (tanggal) dan value (jumlah transaksi)
    const dates = Object.keys(transactionsData); // Array berisi tanggal
    const counts = Object.values(transactionsData); // Array berisi jumlah transaksi

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
        data: counts
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
        categories: dates
    }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();

    </script>
@endsection

@section('content')
<div class="row">
    @if ($revenue !== 'belum ada penjualan')
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Grafik Pembelian</h2>
                </div>
                <div class="card-body">
                    <div>
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <p>Total Seluruh Penjualan</p>
                </div>
                <div class="card-body">
                    <div>
                        <h2>{{$revenue}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <p>Komisiku</p>
                </div>
                <div class="card-body">
                    <div>
                        <h2>{{$komisi}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header mb-0">
                    <p>Penjualan Kelas Terbanyak</p>
                </div>
                <div class="card-body d-flex align-items-center">
                    <h2 class="col-9">{{$kelas_terlaris}}</h2>
                    <h4 class="col-3">{{$total_terjual}}</>
                </div>
                <div class="card-body mt-0">
                    <p>{{$kreator}}</p>
                </div>
            </div>
        </div>
    @else
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h2>Belum Ada Penjualan</h2>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
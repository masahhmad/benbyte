@extends('layouts.app')

@section('css')
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

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Kelas</h4>
            </div>
            <div class="card-content">
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>NAMA KELAS</th>
                                {{-- <th>PERINGKAT</th> --}}
                                <th>JUMLAH PENJUALAN</th>
                                <th>TANGGAL DIBUAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas_user as $kelas)
                                <tr>
                                    <td class="text-bold-500">{{$kelas->nama_kelas}}</td>
                                    {{-- <td class="text-bold-500">#1</td> --}}
                                    <td class="text-bold-500">{{$jumlah_terjual[$kelas->id]}}</td>
                                    <td class="text-bold-500">{{$kelas->created_at->translatedFormat('d F Y')}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Belum Ada Penjualan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>Keuntungan</h2>
            </div>
            <div class="card-body row">
                <div class="col-3"><h4>Total :</h4></div>
                <div class="col-9 d-flex justify-content-end"><h4>{{$total_duwit}}</h4></div>
            </div>
        </div>
    </div>
</div>
@endsection
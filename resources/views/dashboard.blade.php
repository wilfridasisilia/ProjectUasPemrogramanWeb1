@extends('Layout.main')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Total Peminjaman -->
        <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Peminjaman
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPeminjaman }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Petugas -->
        <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Petugas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPetugas }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Buku -->
        <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Buku
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBuku }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Mahasiswa -->
        <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Mahasiswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMahasiswa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section for Notifications -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Peminjaman Terbaru</div>
                            @if($peminjamanTerbaru->isEmpty() || $peminjamanTerbaru == null)
                                <div class="alert alert-info" role="alert">
                                    Tidak ada peminjaman buku terbaru.
                                </div>
                            @else
                                @foreach($peminjamanTerbaru as $peminjaman)
                                    <div class="alert alert-info" role="alert">
                                        Mahasiswa {{ $peminjaman->mahasiswa }} meminjam buku "{{ $peminjaman->buku }}" pada tanggal {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y') }}.
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart Card -->
    <div class="row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="card shadow mb-3">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman-Ketersediaan Buku</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body text-center">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    <p class="pt-4 mb-4">Jumlah buku berdasarkan status peminjaman di perpustakaan.</p>
                </div>
            </div>
        </div>

        <!-- Highcharts peminjaman buku -->
        <div class="col-sm-12 col-lg-6">
            <div class="card shadow mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lama Peminjaman Buku</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container1"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <!-- Highcharts Lama Peminjaman -->
    <div class="col-12 mt-2">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Peminjaman Buku</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body text-center">
                <figure class="highcharts-figure pt-4">
                    <div id="container"></div>
                </figure>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Setup data for Pie Chart
    const data = {
        labels: [
            @foreach($statusPeminjaman as $item)
                '{{ $item->status }}',
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach($statusPeminjaman as $item)
                    {{ $item->jumlah }},
                @endforeach
            ],
            backgroundColor: [
                'rgb(75, 192, 192)',
                'rgb(255, 99, 132)'
            ],
            hoverOffset: 4
        }]
    };

    // Config for Pie Chart
    const config = {
        type: 'pie',
        data: data,
    };

    // Render Pie Chart
    const myPieChart = new Chart(
        document.getElementById('myPieChart'),
        config
    );
</script>

{{-- Highcharts scripts --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Peminjaman Buku',
            align: 'center'
        },
        subtitle: {
            text: 'Source: Aplikasi Perpustakaan UMDP',
            align: 'center'
        },
        xAxis: {
            categories: [
                @foreach($peminjamanmhs as $item)
                    '{{ $item->judul }}',
                @endforeach
            ],
            crosshair: true,
            accessibility: {
                description: 'Buku'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Peminjaman'
            }
        },
        tooltip: {
            valueSuffix: ' Buku'
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Peminjaman Buku',
            data: [
                @foreach ($peminjamanmhs as $item)
                    {{ $item->jumlah }},
                @endforeach
            ]
        }]
    });

    Highcharts.chart('container1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Lama Peminjaman Buku Perpustakaan UMDP',
            align: 'left'
        },
        xAxis: {
            categories: [
                @foreach($lamapeminjaman as $item)
                    '{{ $item->judul }}',
                @endforeach
            ],
            title: {
                text: 'Judul Buku',
            },
            gridLineWidth: 1,
            lineWidth: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Lama Peminjaman (Hari)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            },
            gridLineWidth: 0
        },
        tooltip: {
            valueSuffix: ' Hari'
        },
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                    enabled: true
                },
                groupPadding: 0.1
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Lama Peminjaman',
            data: [
                @foreach($lamapeminjaman as $item)
                    {{ $item->lama_peminjaman }},
                @endforeach
            ]
        }]
    });
</script>
@endsection


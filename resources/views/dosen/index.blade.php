@extends('layouts.dosen')

@section('title', 'Beranda')

@section('header-title', 'Beranda')

@section('content')
    <style>
        .container {
            margin-top: 20px;
        }

        .box {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <h3>Data Barang</h3>
                    <canvas id="itemChart"></canvas>
                </div>
            </div>
            <div class="col-md-7">
                <div class="box">
                    <h3>Grafik Keluhan</h3>
                    <canvas id="complaintChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk grafik pie item
        const itemCtx = document.getElementById('itemChart').getContext('2d');
        const itemChart = new Chart(itemCtx, {
            type: 'doughnut',
            data: {
                labels: ['Barang Rusak', 'Barang Baru', 'Barang Bekas'],
                datasets: [{
                    data: [{{ $barangRusak }}, {{ $barangBaru }}, {{ $barangBekas }}],
                    backgroundColor: ['red', 'yellow', 'orange'],
                }]
            },
            options: {
                responsive: true,
            }
        });

        // Data untuk grafik garis keluhan
        const complaintCtx = document.getElementById('complaintChart').getContext('2d');
        const complaintChart = new Chart(complaintCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($complaints, 'date')) !!}, // Tanggal keluhan
                datasets: [{
                    label: 'Jumlah Keluhan',
                    data: {!! json_encode(array_column($complaints, 'count')) !!}, // Jumlah keluhan
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

@extends('layouts.app')

@section('title', 'Home Page')

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

        .user-box {
            position: static;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding:10px;
            /* background-color: #f9f9f9; */
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .detail {
            position: static;
            top: 10px;
            left: 10px;
            background-color: #3498db;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            float: left;
            margin-bottom: 1%;
        }

        .detail:hover {
            background-color: rgb(199, 205, 196);
        }

        .tambah {
            position: static;
            top: 10px;
            right: 10px;
            background-color: #ff5e00;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 89%;
            margin-bottom: 1%;
            
        }

        .tambah:hover {
            background-color: rgb(199, 205, 196);
        }

        .user-count {
            font-size: 3em;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .user-label {
            font-size: 1.2em;
            color: #7f8c8d;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <h3>Data Barang</h3>
                    <canvas id="itemChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <h3>Grafik Keluhan</h3>
                    <canvas id="complaintChart"></canvas>
                </div>
                <div class="box">
                    <h3>Pengguna</h3>
                    <button class="detail" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-list-ul" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                    </button>
                    <button class="tambah" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                        </svg>
                    </button>
                    <div class="user-box">
                        <h2 class="user-count">{{ $pengguna }}</h2>
                        <h4 class="user-label">Jumlah Pengguna</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Detail Pengguna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

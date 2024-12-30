<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Anatomy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <style>
        .hero-section {
            background: linear-gradient(45deg, #ff5e00, #fcae1e, #ff5e00, #b56727);
            /* background-color: #ff5e00; */
            padding: 50px 0;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-section h1 {
            font-size: 3em;
            font-weight: bold;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
        }

        .hero-section p {
            font-size: 1.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .parallax {
            background-image: url('{{ asset('logo/PSDKU-Tanah-Datar.jpeg') }}');
            height: 300px;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .hover-effect img:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .full-width-banner {
            background: linear-gradient(45deg, #ff5e00, #fcae1e, #ff5e00, #b56727);
            padding: 50px 0;
            text-align: center;
        }

        .lead-magnet {
            background: linear-gradient(45deg, #ff5e00, #fcae1e, #ff5e00, #b56727);
            padding: 30px 0;
            text-align: center;
        }

        footer {
            background: linear-gradient(45deg, #ff5e00, #fcae1e, #ff5e00, #b56727);
            padding: 50px 0;
            text-align: center;
        }

        .navbar-custom {
            background-color: white;
        }

        .navbar-custom .nav-link {
            /* font-weight: bold; */
            color: black;
        }

        .navbar-custom .nav-link:hover {
            color: #cccccc;
            /* Optional: Add a hover effect */
        }

        .box {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .navbar-brand p {
                font-size: 1rem;
                /* Adjust font size for smaller screens */
            }

            .icon {
                margin-top: 50px;
            }

        }
    </style>
</head>

<body>

    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('logo/logopnp.png') }}" alt="" style="max-width: 35px; float: left;">
            <p style="margin: auto; padding-left: 10px; color: black; display: inline-block;">PSDKU TANAH DATAR</p>
        </a>
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="/login">LOGIN</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        {{-- <button class="btn btn-primary">Click Here!</button> --}}
        <h3>MANAJEMEN PERALATAN DAN PERLENGKAPAN</h3>
        {{-- <p>Politeknik Negeri Padang - Tanah Datar</p> --}}
    </div>

    <!-- Parallax Image -->
    <div class="parallax"></div>

    <!-- Hover Effect Section -->
    <div class="container my-5">
        <div class="row text-center hover-effect">
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

    <!-- Full Width Banner -->
    <div class="hero-section">
        {{-- <img class="img-fluid" alt="Full Width Image"> --}}
        <h3>PSDKU - TANAH DATAR</h3>
    </div>

    <div class="container my-5">
        <div class="row text-center hover-effect">
            <div class="col-md-4 ">
                <img src="{{ asset('logo/support.png') }}"class="img-fluid" alt="Thumbnail" style="max-width: 25%;">
                <div class="mt-4 text-justify">
                    Butuh bantuan dengan manajemen inventaris Anda? Tim dukungan kami siap membantu Anda di setiap langkah. Mulai dari mengatasi masalah hingga memberikan panduan, kami berkomitmen untuk memastikan sistem Anda berjalan lancar.
                </div>
            </div>
            <div class="col-md-4 icon">
                <img src="{{ asset('logo/settings.png') }}"class="img-fluid" alt="Thumbnail" style="max-width: 25%;">
                <div class="mt-4 text-justify">
                    Sesuaikan sistem inventaris Anda sesuai dengan kebutuhan spesifik Anda. Opsi pengaturan lanjutan kami memungkinkan Anda untuk menyesuaikan setiap aspek dari proses manajemen, memastikan kinerja dan efisiensi yang optimal.
                </div>
            </div>
            <div class="col-md-4 icon">
                <img src="{{ asset('logo/complain.png') }}"class="img-fluid" alt="Thumbnail" style="max-width: 25%;">
                <div class="mt-4 text-justify">
                    Mengalami masalah? Laporkan dengan cepat melalui sistem keluhan kami. Kami menanggapi setiap masalah dengan serius dan bekerja cepat untuk menyelesaikan setiap tantangan, memastikan inventaris Anda selalu terkelola dengan baik.
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Slider/Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide my-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="slide1.jpg" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="slide2.jpg" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="slide3.jpg" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}

    <!-- Lead Magnet Section -->
    {{-- <div class="lead-magnet">
        <h2>Download Your Freebie</h2>
        <p>Freebie details</p>
        <form class="form-inline justify-content-center">
            <input type="email" class="form-control mb-2 mr-sm-2" id="email" placeholder="Enter your email">
            <button type="submit" class="btn btn-primary mb-2">Subscribe</button>
        </form>
    </div> --}}

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Develop by Wirya Ashen</p>
        {{-- <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item"><a href="#">About</a></li>
            <li class="list-inline-item"><a href="#">Services</a></li>
            <li class="list-inline-item"><a href="#">Blog</a></li>
            <li class="list-inline-item"><a href="#">Contact</a></li>
        </ul> --}}
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

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
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
</body>

</html>

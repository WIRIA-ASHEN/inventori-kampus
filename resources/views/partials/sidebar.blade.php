<style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .d-flex {
        flex: 1;
        display: flex;
        min-height: calc(100vh - 56px);
        /* 56px adalah tinggi header */
    }

    .sidebar-wrapper {
        width: 250px;
        background-color: #fafaf8;
        padding: 20px;
        border-right: 1px solid #ddd;
        display: flex;
        flex-direction: column;
        height: 100%;
        position: fixed;
        /* Ubah dari sticky ke fixed */
        top: 0;
        left: 0;
        /* Tambahkan ini */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: width 0.3s ease;
    }

    .sidebar-wrapper.minimized {
        width: 60px;
        padding: 20px 5px;
    }

    .sidebar-wrapper .sidebar {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .sidebar-wrapper.minimized .sidebar h4,
    .sidebar-wrapper.minimized .sidebar .list-group-item a {
        display: none;
    }

    .sidebar-wrapper .sidebar h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #343a40;
    }

    .sidebar-wrapper .sidebar .list-group {
        width: 100%;
    }

    .sidebar-wrapper .sidebar .list-group-item {
        border: none;
        padding: 15px 20px;
        margin-bottom: 5px;
        background-color: #ffffff;
        border-radius: 5px;
        transition: all 0.3s ease;
        text-align: center;
    }

    .sidebar-wrapper .sidebar .list-group-item:hover {
        background-color: #ff5e00;
        color: #ffffff;
    }

    .sidebar-wrapper .sidebar .list-group-item a {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .sidebar-wrapper .sidebar .list-group-item.active {
        background-color: #ff5e00;
        color: #ffffff;
        font-weight: bold;
    }

    .content-wrapper {
        padding: 20px;
        flex-grow: 1;
        background-color: #ffffff;
        margin-left: 250px;
        /* Tambahkan ini untuk mengimbangi posisi tetap sidebar */
        transition: margin-left 0.3s ease;
    }

    .sidebar-wrapper.minimized~.content-wrapper {
        margin-left: 60px;
        /* Sesuaikan dengan lebar sidebar saat diminimalkan */
    }

    .gambar {
        width: 70%;
        margin-bottom: 20px;
    }

    .sidebar-wrapper.minimized .gambar {
        width: 80%;
        margin-bottom: 10px;
    }

    .toggle-btn {
        display: none;
        background-color: #ff5e00;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        padding: 10px;
        margin-bottom: 20px;
        align-self: flex-end;
    }

    @media (max-width: 768px) {
        .toggle-btn {
            display: block;
        }

        .content-wrapper {
            padding: 10px;
            margin-left: 0;
            /* Sesuaikan margin di layar kecil */
        }

        .sidebar-wrapper {
            /* position: absolute; */
            /* Untuk memungkinkan sidebar di atas konten pada layar kecil */
            height: auto;
            /* Sesuaikan tinggi sidebar */
            width: 100%;
            /* Sesuaikan lebar sidebar */
            transition: height 0.3s ease, width 0.3s ease;
        }

        .sidebar-wrapper.minimized {
            height: 60px;
            /* Tinggi sidebar saat diminimalkan di layar kecil */
            padding: 5px;
        }
    }
</style>


<!-- resources/views/partials/sidebar.blade.php -->
<div class="sidebar-wrapper" id="sidebar">
    <button class="toggle-btn" id="toggleSidebar">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
    </button>
    <div class="sidebar">
        <img src="{{ asset('logo/logopnp.png') }}" class="gambar" alt="gambarpnp">
        <h4></h4>
        <ul class="list-group">
            <li class="list-group-item {{ request()->is('beranda') ? 'active' : '' }}">
                <a href="{{ url('/beranda') }}">Beranda</a>
            </li>
            <li
                class="list-group-item {{ request()->is('data-alat', 'tambah-barang', 'edit-barang/*', 'tambah-kategori', 'tambah-ruangan') ? 'active' : '' }}">
                <a href="{{ url('/data-alat') }}">Data Barang</a>
            </li>
            <li class="list-group-item {{ request()->is('ruangan', 'tambah_penempatanBarang', 'penempatan-barang/*/edit') ? 'active' : '' }}">
                <a href="{{ url('/ruangan') }}">Ruangan</a>
            </li>
            <li class="list-group-item {{ request()->is('pinjaman', 'peminjaman-barang/*/edit') ? 'active' : '' }}">
                <a href="{{ url('/pinjaman') }}">Pinjaman</a>
            </li>
            <li class="list-group-item {{ request()->is('keluhanadmin') ? 'active' : '' }}">
                <a href="{{ url('/keluhanadmin') }}">Keluhan</a>
            </li>

            <!-- Tambahkan item menu lainnya di sini -->
        </ul>
        <ul class="list-group mt-auto">
            <li class="list-group-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                        <path fill-rule="evenodd"
                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                    </svg>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
    function checkWindowSize() {
        if (window.innerWidth <= 768) {
            document.querySelector('.sidebar .gambar').style.display = 'none';
            document.querySelector('.sidebar h4').style.display = 'none';
            document.querySelectorAll('.sidebar .list-group-item').forEach(item => {
                item.style.display = 'none';
            });
        } else {
            document.querySelector('.sidebar .gambar').style.display = 'block';
            document.querySelector('.sidebar h4').style.display = 'block';
            document.querySelectorAll('.sidebar .list-group-item').forEach(item => {
                item.style.display = 'block';
            });
        }
    }

    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('minimized');

        if (window.innerWidth <= 768 && sidebar.classList.contains('minimized')) {
            document.querySelector('.sidebar .gambar').style.display = 'none';
            document.querySelector('.sidebar h4').style.display = 'none';
            document.querySelectorAll('.sidebar .list-group-item').forEach(item => {
                item.style.display = 'none';
            });
        } else {
            document.querySelector('.sidebar .gambar').style.display = 'block';
            document.querySelector('.sidebar h4').style.display = 'block';
            document.querySelectorAll('.sidebar .list-group-item').forEach(item => {
                item.style.display = 'block';
            });
        }
    });

    window.addEventListener('resize', checkWindowSize);
    window.addEventListener('load', checkWindowSize);
</script>

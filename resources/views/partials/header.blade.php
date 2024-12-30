<!-- resources/views/partials/header.blade.php -->
<style>
    /* resources/css/app.css */
    header {
        padding: 10px 20px;
        background-color: #f8f9fa;
    }

    header .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header .header-title {
        flex: 1;
        font-size: 24px;
        margin: 0;
    }

    header .user-info {
        display: flex;
        align-items: center;
    }

    header .user-info h5 {
        margin: 0;
        margin-right: 10px;
        font-size: 18px;
    }

    header .user-info img {
        width: 50px;
        height: 50px;
        border: 2px solid #ffff;
        border-radius: 50%;
    }

    header hr {
        margin-top: 10px;
        border: none;
        border-top: 1px solid #ddd;
    }

    @media (max-width: 768px) {

        header .header-container {
            /* flex-direction: column;
            align-items: flex-start; */
            margin-top: 30px;
        }

        header .user-info {
            margin-top: 10px;
        }

        header .user-info img {
            width: 40px;
            height: 40px;
        }

        header .header-title {
            font-size: 20px;
        }
    }
</style>
<!-- resources/views/partials/header.blade.php -->
<header>
    <div class="header-container">
        <h1 class="header-title">@yield('header-title')</h1>
        <div class="user-info">
            <h5>{{ $userName }}</h5>
            <!-- Assuming you have included Bootstrap CSS and JS -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="notificationsDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-bell" viewBox="0 0 16 16">
                        <path
                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                    </svg>
                    <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        <li>
                            <a class="dropdown-item" href="#">
                                {{ $notification->data['message'] }}
                                <br>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        </li>
                    @endforeach
                    @if (auth()->user()->unreadNotifications->isEmpty())
                        <li><a class="dropdown-item" href="#">No new notifications</a></li>
                    @else
                        <li>
                            <form action="{{ route('notifications.readAll') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-center">Mark All as Read</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
    <hr>
</header>

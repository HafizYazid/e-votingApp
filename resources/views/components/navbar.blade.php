<!-- layout utama -->
<link rel="stylesheet" href="css/navbar.css">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white-color sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-vote-yea me-2"></i>
            PEMIRA BEM
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('voting*') ? 'active' : '' }}" href="{{ route('voting') }}">Voting</a>
                </li>

                @if ($user)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ $user->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item">
                                Status:
                                @if ($user->status)
                                    <span class="text-success">Sudah Memilih</span>
                                @else
                                    <span class="text-danger">Belum Memilih</span>
                                @endif
                            </li>

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
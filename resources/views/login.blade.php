<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sistem Informasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="container-fluid h-100">
            <div class="row h-100">

                <!-- Right Side - Login Form -->
                 
                <div class="d-flex align-items-center justify-content-center">
                    <div class="login-form-container">
                        <div class="login-header text-center mb-4">
                            <div class="login-logo mb-3">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3>Login Mahasiswa</h3>
                            <p class="text-muted">Masukkan NIM dan password Anda</p>
                        </div>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form id="loginForm" class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group mb-3">
                                <label for="nim" class="form-label">
                                    <i class="fas fa-id-card me-2"></i>NIM
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nim" 
                                       name="nim" 
                                       placeholder="Masukkan NIM Anda"
                                       maxlength="7"
                                       autocomplete="off"
                                       required>
                                
                                <small class="form-text text-muted">NIM harus terdiri dari 7 digit angka</small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="password-input-container">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan password Anda"
                                           required>
                                    <button type="button" class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">Password tidak boleh kosong</small>
                            </div>
                       

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Masuk
                            </button>

                           
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
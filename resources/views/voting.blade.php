<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Voting - PEMIRA BEM REMA UPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/voting.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/data.css') }}">
    <link rel="stylesheet" href="{{ asset('css/candidat-profile.css') }}">
</head>
<body>
    <x-navbar></x-navbar>

    <!-- Dashboard Stats -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold">Dashboard Voting</h2>
                    <p class="text-muted">Pantau statistik pemilihan secara real-time</p>
                </div>
            </div>
            <div class="row g-4 text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card h-100">
                        <div class="card-body">
                            <div class="stats-icon bg-primary"><i class="fas fa-users"></i></div>
                            <h3 class="fw-bold text-primary mt-3">{{ $totalUsers }}</h3>
                            <p class="text-muted mb-0">Total Pemilih</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card h-100">
                        <div class="card-body">
                            <div class="stats-icon bg-success"><i class="fas fa-check-circle"></i></div>
                            <h3 class="fw-bold text-success mt-3">{{ $totalVoters }}</h3>
                            <p class="text-muted mb-0">Sudah Memilih</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card h-100">
                        <div class="card-body">
                            <div class="stats-icon bg-warning"><i class="fas fa-clock"></i></div>
                            <h3 class="fw-bold text-warning mt-3">{{ $totalUsers - $totalVoters }}</h3>
                            <p class="text-muted mb-0">Belum Memilih</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card stats-card h-100">
                        <div class="card-body">
                            <div class="stats-icon bg-info"><i class="fas fa-percentage"></i></div>
                            <h3 class="fw-bold text-info mt-3">{{ round(($totalVoters / max(1, $totalUsers)) * 100, 1) }}%</h3>
                            <p class="text-muted mb-0">Partisipasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Voting Section -->
    <section class="py-5 bg-light" id="voting">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold">Kandidat Ketua BEM</h2>
                    <p class="text-muted">Pilih kandidat terbaik untuk memimpin BEM REMA UPI</p>
                </div>
            </div>
            <div class="row g-4 align-items-center justify-content-center">
                @foreach($candidates as $index => $candidate)
                <div class="col-lg-4 col-md-6">
                    <div class="candidate-card p-3 bg-white rounded shadow-sm h-100">
                        <div class="candidate-header text-center mb-3">
                            <div class="candidate-number">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div class="candidate-photo text-center mb-3">
                            <img src="{{ asset('images/' . $candidate->foto) }}" alt="{{ $candidate->ketua }}" class="img-fluid " style="max-height: 200px;">
                        </div>
                        <div class="candidate-info text-center">
                            <h4 class="candidate-name">{{ $candidate->ketua }} & {{ $candidate->wakil }}</h4>
                            <p class="candidate-title text-muted">Ketua & Wakil Ketua BEM</p>
                            <div class="mb-2"><strong>Visi:</strong><p class="text-muted small">"{{ $candidate->visi }}"</p></div>
                            <div class="mb-3"><strong>Misi:</strong><p class="text-muted small">{{ $candidate->misi }}</p></div>

                            @auth
                                @if(auth()->user()->status != 1)
                                    <a href="#" class="btn btn-success btn-pilih-kandidat w-100">
                                        <i class="fas fa-vote-yea me-2"></i> Pilih Kandidat
                                    </a>
                                @else
                                    <span class="btn btn-secondary w-100 disabled">Sudah Memilih</span>
                                @endif
                            @else
                                <a href="#" class="btn btn-warning btn-pilih-kandidat w-100">
                                    <i class="fas fa-envelope me-2"></i> Login & Verifikasi Email
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal: Email -->
    <div class="modal fade" id="emailModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="emailForm">
                    <div class="modal-header"><h5 class="modal-title">Verifikasi Email</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <p>Masukkan email aktif Anda:</p>
                        <input type="email" class="form-control" name="email" required placeholder="you@example.com">
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary">Kirim OTP</button></div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: OTP -->
    <div class="modal fade" id="otpModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="otpForm">
                    <div class="modal-header"><h5 class="modal-title">Masukkan OTP</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <p>Periksa email Anda dan masukkan kode OTP:</p>
                        <input type="text" class="form-control" name="otp" required pattern="\d{6}" maxlength="6" placeholder="6-digit OTP">
                        <input type="hidden" name="email" id="otpEmail">
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-success">Verifikasi</button></div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Vote -->
    <div class="modal fade" id="voteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="voteForm">
                    <div class="modal-header"><h5 class="modal-title">Pilih Kandidat</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <div class="form-check" id="candidateOptions">
                            @foreach($candidates as $candidate)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="id_kandidat" id="kandidat{{ $candidate->id_kandidat }}" value="{{ $candidate->id_kandidat }}">
                                <label class="form-check-label" for="kandidat{{ $candidate->id_kandidat }}">{{ $candidate->ketua }} & {{ $candidate->wakil }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary">Kirim Suara</button></div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <x-footer></x-footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let emailGlobal = null;

        $(document).on('click', '.btn-pilih-kandidat', function(e) {
            e.preventDefault();
            $('#emailModal').modal('show');
        });

        $('#emailForm').submit(function(e) {
            e.preventDefault();
            let email = $(this).find('input[name="email"]').val();
            emailGlobal = email;

            $.post("/send-otp", { email }, function(res) {
                alert(res.message);
                $('#emailModal').modal('hide');
                $('#otpEmail').val(email);
                $('#otpModal').modal('show');
            }).fail(function(err) {
                alert(err.responseJSON.message || 'Gagal mengirim OTP.');
            });
        });

        $('#otpForm').submit(function(e) {
            e.preventDefault();
            let otp = $(this).find('input[name="otp"]').val();
            let email = $('#otpEmail').val();

            $.post("/verify-otp", { email, otp }, function(res) {
                alert(res.message);
                $('#otpModal').modal('hide');
                $('#voteModal').modal('show');
            }).fail(function(err) {
                alert(err.responseJSON.message || 'OTP salah atau kedaluwarsa.');
            });
        });

        $('#voteForm').submit(function(e) {
            e.preventDefault();
            let kandidat = $('input[name="id_kandidat"]:checked').val();
            if (!kandidat) return alert("Pilih salah satu kandidat terlebih dahulu.");

            $.post("/submit-vote", { id_kandidat: kandidat, email: emailGlobal }, function(res) {
                alert(res.message);
                $('#voteModal').modal('hide');
                window.location.reload();
            }).fail(function(err) {
                alert(err.responseJSON.message || 'Gagal mengirim suara.');
            });
        });
    </script>
</body>
</html>

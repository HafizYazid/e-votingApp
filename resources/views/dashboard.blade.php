<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Voting - PEMIRA BEM REMA UPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/hero.css">
    <link rel="stylesheet" href="css/chart.css">
    <link rel="stylesheet" href="css/candidat-profile.css">
</head>
<body>
    <x-navbar></x-navbar>
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-50">
                <!-- Hero Illustration - Order 1 on mobile (top), Order 2 on desktop (right) -->
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                    <div class="hero-illustration">
                        <!-- Abstract Circle Background -->
                        <div class="abstract-circles">
                            <div class="circle-bg circle-1"></div>
                            <div class="circle-bg circle-2"></div>
                            <div class="circle-bg circle-3"></div>
                            <div class="circle-bg circle-4"></div>
                        </div>
                        
                        <!-- Voting Box Illustration -->
                        <div class="voting-box-container">
                            <!-- Main Voting Box -->
                            <div class="voting-box">
                                <div class="box-front">
                                    <div class="box-slot"></div>
                                    <div class="box-logo">
                                        <i class="fas fa-vote-yea"></i>
                                    </div>
                                    <div class="box-label">KOTAK SUARA</div>
                                    <div class="box-sublabel">PEMIRA BEM REMA UPI</div>
                                </div>
                                <div class="box-top"></div>
                                <div class="box-side"></div>
                            </div>
                            
                            <!-- Floating Ballot Papers -->
                            <div class="ballot-paper ballot-1">
                                <div class="ballot-content">
                                    <div class="ballot-title">SUARA SAYA</div>
                                    <div class="ballot-options">
                                        <div class="ballot-option"></div>
                                        <div class="ballot-option active"></div>
                                        <div class="ballot-option"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ballot-paper ballot-2">
                                <div class="ballot-content">
                                    <div class="ballot-check">✓</div>
                                    <div class="ballot-text">VOTED</div>
                                </div>
                            </div>
                            
                            <!-- Floating Icons -->
                            <div class="floating-icon icon-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="floating-icon icon-2">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="floating-icon icon-3">
                                <i class="fas fa-balance-scale"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Content - Order 2 on mobile (bottom), Order 1 on desktop (left) -->
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="hero-content text-center text-lg-start">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            PEMIRA BEM<br>
                            <span class="text-gradient">REMA UPI</span>
                        </h1>
                        <p class="lead text-white-50 mb-4">Demi regenerasi, demi bersama</p>
                        
                        <!-- Button and Contact Info Container -->
                        <div class="hero-actions">
                            <!-- Learn More Button -->
                            <div class="hero-button-container mb-3 mb-lg-0">
                                <button class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-play me-2"></i>LEARN MORE
                                </button>
                            </div>
                            
                            <!-- Contact Info -->
                            <div class="contact-info text-white">
                                <div class="contact-item d-flex align-items-center justify-content-center justify-content-lg-start mb-2">
                                    <i class="fas fa-globe me-2"></i>
                                    <span>www.reallygreatsite.com</span>
                                    <i class="fas fa-phone ms-3 me-2"></i>
                                    <span>123-456-7890</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Candidate Profiles Section -->
    <section class="candidate-profiles py-5 bg-white" id="candidates">
        <div class="container align">
            <!-- Section Header -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title fw-bold mb-3">
                        <i class="fas fa-users me-3 text-primary"></i>
                        Kandidat PEMIRA BEM REMA UPI
                    </h2>
                    <p class="section-subtitle text-muted mb-4">
                        Kenali visi, misi, dan program kerja dari setiap kandidat
                    </p>
                   
                </div>
            </div>

            <!-- Candidates Cards -->
            <div class="row g-4 align-items-center justify-content-center">
                @foreach ($candidate as $index => $k)
                <div class="col-lg-4 col-md-6">
                    <div class="candidate-card">
                        <div class="candidate-header">
                            <div class="candidate-number">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        
                        <div class="candidate-photo">
                            <img src="{{ asset('images/' . $k->foto) }}" alt="{{ $k->ketua }}" class="img-fluid">
                        </div>
                        
                        <div class="candidate-info">
                            <h4 class="candidate-name">{{ $k->ketua }} & {{ $k->wakil }}</h4>
                            <p class="candidate-title"> Calon Ketua & Calon Wakil Ketua BEM</p>
                            <p class="text-muted small text-center">"{{ $k->visi }}"</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- Call to Action -->
            <div class="row mt-5">
                <div class="col-12 text-center align-items-center justify-content-center">
                    <div class="cta-section">
                        <h5 class="fw-bold mb-3">Sudah Menentukan Pilihan?</h5>
                        <p class="text-white mb-4 ">Pastikan untuk memberikan suara Anda sebelum periode voting berakhir</p>
                        <a href="{{ url('/voting') }}" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-vote-yea me-2"></i>Vote Sekarang
                        </a>

                        <button class="btn btn-primary btn-lg">
                            <i class="fas fa-info-circle me-2"></i>Panduan Voting
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Real-time Results -->
    <section class="py-5 bg-light" id="results">
    <div class="container">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-info-circle me-2 text-info"></i>
                        Info Pemilihan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                Periode Voting:
                            </span>
                            <span class="fw-bold">{{ $stats['voting_period']['formatted'] }}</span>
                        </div>
                    </div>
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                <i class="fas fa-hourglass-half me-2 text-warning"></i>
                                Waktu Tersisa:
                                <span class="fw-bold {{ $stats['time_remaining']['expired'] ? 'text-danger' : 'text-success' }}" id="timer">
                                    {{ $stats['time_remaining']['formatted'] }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                <i class="fas fa-vote-yea me-2 text-success"></i>
                                Total Suara:
                            </span>
                            <span class="fw-bold">{{ number_format($stats['total_votes']) }} suara</span>
                        </div>
                    </div>
                    <div class="info-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                <i class="fas fa-bullseye me-2 text-info"></i>
                                Target Partisipasi:
                            </span>
                            <span class="fw-bold text-success">{{ $stats['target_participation'] }}%</span>
                        </div>
                    </div>
                    
                    <!-- Progress Bar untuk Target -->
                    <div class="progress-section mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="text-muted">Progress Partisipasi</small>
                            <small class="text-muted">{{ $stats['participation_rate'] }}% / {{ $stats['target_participation'] }}%</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            @php
                                $progressPercent = ($stats['participation_rate'] / $stats['target_participation']) * 100;
                                $progressPercent = min($progressPercent, 100); // Max 100%
                            @endphp
                            <div class="progress-bar bg-gradient" role="progressbar" 
                                    style="width: {{ $progressPercent }}%;" 
                                    aria-valuenow="{{ $progressPercent }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Live Status -->
                    <div class="live-status mb-3">
                        <div class="d-flex align-items-center">
                            <span class="live-indicator me-2"></span>
                            <small class="text-success fw-bold">
                                {{ $stats['time_remaining']['expired'] ? 'SELESAI - Voting Berakhir' : 'LIVE - Sedang Berlangsung' }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="alert alert-info border-0">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>
                            @if($stats['time_remaining']['expired'])
                                Hasil final telah tersedia. Periode voting berakhir pada {{ $stats['voting_period']['formatted'] }}.
                            @else
                                Hasil sementara akan diumumkan setelah periode voting berakhir pada {{ $stats['voting_period']['end_date'] }} pukul 23:59 WIB.
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <x-footer></x-footer>

    @php
        // Define colors for chart
        $colors = ['#1a0f91', '#ff847b', '#91b3fa', '#4BC0C0', '#FF6384', '#36A2EB'];
    @endphp



    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const endTimestamp = {{ $stats['time_remaining']['end_timestamp'] ?? 'null' }};

        if (endTimestamp === null) {
            document.getElementById("timer").innerText = "Waktu tidak tersedia";
            return;
        }

        function updateCountdown() {
            const now = Math.floor(Date.now() / 1000);
            const distance = endTimestamp - now;

            if (distance <= 0) {
                document.getElementById("timer").innerText = "Voting Telah Berakhir";
                clearInterval(timerInterval);
                return;
            }

            const days = Math.floor(distance / (60 * 60 * 24));
            const hours = Math.floor((distance % (60 * 60 * 24)) / (60 * 60));
            const minutes = Math.floor((distance % (60 * 60)) / 60);
            const seconds = distance % 60;

            document.getElementById("timer").innerText =
                `${days} Hari ${hours} Jam ${minutes} Menit ${seconds} Detik`;
        }

        updateCountdown();
        const timerInterval = setInterval(updateCountdown, 1000);
    });
</script>


<!-- Chart.js Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('votingChart').getContext('2d');
        
        // Data dari PHP
        const votingData = @json($votingResults);
        const chartColors = @json(array_slice($colors, 0, count($votingResults)));
        
        const labels = votingData.map(item => item.nama_kandidat);
        const data = votingData.map(item => item.total_votes);
        
        const votingChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: chartColors,
                    borderColor: Array(chartColors.length).fill('#ffffff'),
                    borderWidth: 3,
                    hoverBorderWidth: 5,
                    hoverBorderColor: '#333333'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value.toLocaleString()} suara (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                layout: {
                    padding: 20
                }
            }
        });
        
        // Update chart every 30 seconds (real-time)
        setInterval(function() {
            updateVotingData();
        }, 30000);
        
        function updateVotingData() {
            fetch('/api/voting-data')
                .then(response => response.json())
                .then(data => {
                    // Update chart data
                    const newData = data.voting_results.map(item => item.total_votes);
                    votingChart.data.datasets[0].data = newData;
                    votingChart.update('none');
                    
                    // Update legend numbers
                    updateLegendNumbers(data);
                })
                .catch(error => {
                    console.error('Error fetching voting data:', error);
                });
        }
        
        function updateLegendNumbers(data) {
            const votingResults = data.voting_results;
            const totalVotes = data.total_votes;
            
            // Update individual candidate stats
            document.querySelectorAll('.legend-item:not(.total)').forEach((el, index) => {
                if (index < votingResults.length) {
                    const voteCount = el.querySelector('.vote-count');
                    const votePercentage = el.querySelector('.vote-percentage');
                    
                    if (voteCount) {
                        voteCount.textContent = `${votingResults[index].total_votes.toLocaleString()} suara`;
                    }
                    
                    if (votePercentage) {
                        votePercentage.textContent = `(${votingResults[index].percentage}%)`;
                    }
                }
            });
            
            // Update total votes
            const totalElement = document.querySelector('.legend-item.total .vote-count');
            if (totalElement) {
                totalElement.textContent = `${totalVotes.toLocaleString()} suara`;
            }
            
            // Update participation rate in info section
            const participationRate = data.participation_rate;
            document.querySelector('.progress-section small:last-child').textContent = 
                `${participationRate}% / {{ $stats['target_participation'] }}%`;
                
            const progressBar = document.querySelector('.progress-bar');
            const progressPercent = Math.min((participationRate / {{ $stats['target_participation'] }}) * 100, 100);
            progressBar.style.width = `${progressPercent}%`;
            progressBar.setAttribute('aria-valuenow', progressPercent);
        }
    });
    </script>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
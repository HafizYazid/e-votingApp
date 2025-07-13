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
<main class="container py-5">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="fw-bold mb-0">
                    <i class="fas fa-chart-pie me-2 text-primary"></i>
                    Hasil Voting Real-time
                </h5>
            </div>
            <div class="card-body">
                <!-- Pie Chart Container -->
                <div class="chart-container">
                    <canvas id="votingChart" width="400" height="400"></canvas>
                </div>

                <!-- Chart Legend/Keterangan -->
                <div class="chart-legend mt-4">
                    <div class="row g-3">
                        @foreach($votingResults as $index => $kandidat)
                        <div class="col-md-6">
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: {{ $colors[$index % count($colors)] }};"></span>
                                <div class="legend-info">
                                    <div class="legend-label">
                                        Kandidat {{ chr(65 + $index) }} - {{ $kandidat->nama_kandidat ?? ($kandidat->ketua . ' & ' . $kandidat->wakil) }}
                                    </div>
                                    <div class="legend-stats">
                                        <span class="vote-count">{{ number_format($kandidat->total_votes) }} suara</span>
                                        <span class="vote-percentage">({{ $kandidat->percentage }}%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-md-6">
                            <div class="legend-item total">
                                <span class="legend-color total-color"></span>
                                <div class="legend-info">
                                    <div class="legend-label fw-bold">Total Suara</div>
                                    <div class="legend-stats">
                                        <span class="vote-count fw-bold">{{ number_format($stats['total_votes']) }} suara</span>
                                        <span class="vote-percentage">(100%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div> <!-- chart-legend -->
            </div> <!-- card-body -->
        </div> <!-- card -->
    </div> <!-- col -->
</main>
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
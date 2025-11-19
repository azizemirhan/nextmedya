@extends('admin.layouts.master')

@section('title', 'Google reCAPTCHA Güvenlik')

@section('content')
    <div class="recaptcha-security-dashboard">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="header-left">
                <h1>
                    <i class="fas fa-shield-alt"></i>
                    Google Güvenlik Kontrol Paneli
                </h1>
                <p class="subtitle">reCAPTCHA v3 İzleme ve Analiz</p>
            </div>
            <div class="header-right">
                <!-- Period Filter -->
                <div class="filter-group">
                    <select id="periodFilter" class="form-select">
                        <option value="today" {{ $period === 'today' ? 'selected' : '' }}>Bugün</option>
                        <option value="week" {{ $period === 'week' ? 'selected' : '' }}>Bu Hafta</option>
                        <option value="month" {{ $period === 'month' ? 'selected' : '' }}>Bu Ay</option>
                        <option value="all" {{ $period === 'all' ? 'selected' : '' }}>Tüm Zamanlar</option>
                    </select>
                </div>

                <!-- Form Type Filter -->
                <div class="filter-group">
                    <select id="formTypeFilter" class="form-select">
                        <option value="all" {{ $formType === 'all' ? 'selected' : '' }}>Tüm Formlar</option>
                        <option value="contact" {{ $formType === 'contact' ? 'selected' : '' }}>İletişim Formu</option>
                        <option value="newsletter" {{ $formType === 'newsletter' ? 'selected' : '' }}>Newsletter</option>
                        <option value="comment" {{ $formType === 'comment' ? 'selected' : '' }}>Yorumlar</option>
                        <option value="other" {{ $formType === 'other' ? 'selected' : '' }}>Diğer</option>
                    </select>
                </div>

                <button class="btn btn-primary" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt"></i> Yenile
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <!-- Toplam Doğrulama -->
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Toplam Doğrulama</div>
                    <div class="stat-value">{{ number_format($stats['total']) }}</div>
                    <div class="stat-change {{ $stats['change_percentage'] >= 0 ? 'positive' : 'negative' }}">
                        <i class="fas fa-{{ $stats['change_percentage'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                        {{ abs($stats['change_percentage']) }}% önceki periyoda göre
                    </div>
                </div>
            </div>

            <!-- Başarı Oranı -->
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Başarı Oranı</div>
                    <div class="stat-value">%{{ $stats['success_rate'] }}</div>
                    <div class="stat-detail">
                        {{ number_format($stats['successful']) }} başarılı / {{ number_format($stats['failed']) }} başarısız
                    </div>
                </div>
            </div>

            <!-- Ortalama Skor -->
            <div class="stat-card">
                <div class="stat-icon {{ $stats['avg_score'] >= 0.7 ? 'bg-success' : ($stats['avg_score'] >= 0.5 ? 'bg-warning' : 'bg-danger') }}">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Ortalama Skor</div>
                    <div class="stat-value">{{ $stats['avg_score'] }}</div>
                    <div class="stat-progress">
                        <div class="progress">
                            <div class="progress-bar {{ $stats['avg_score'] >= 0.7 ? 'bg-success' : ($stats['avg_score'] >= 0.5 ? 'bg-warning' : 'bg-danger') }}"
                                 style="width: {{ $stats['avg_score'] * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bot Oranı -->
            <div class="stat-card">
                <div class="stat-icon {{ $stats['bot_rate'] < 5 ? 'bg-success' : ($stats['bot_rate'] < 15 ? 'bg-warning' : 'bg-danger') }}">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Bot Oranı</div>
                    <div class="stat-value">%{{ $stats['bot_rate'] }}</div>
                    <div class="stat-detail">
                        {{ number_format($stats['low_score_count']) }} düşük skor tespit edildi
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="charts-row">
            <!-- Hourly/Daily Activity Chart -->
            <div class="chart-card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-chart-line"></i>
                        {{ $period === 'today' ? 'Saatlik' : 'Günlük' }} Aktivite
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="80"></canvas>
                </div>
            </div>

            <!-- Score Distribution -->
            <div class="chart-card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-chart-pie"></i>
                        Skor Dağılımı
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="scoreDistributionChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <!-- Form Type Stats -->
        @if(count($formStats) > 0)
            <div class="form-stats-card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-clipboard-list"></i>
                        Form Tipi İstatistikleri
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-stats-grid">
                        @foreach($formStats as $formType => $stat)
                            <div class="form-stat-item">
                                <div class="form-stat-header">
                                    <span class="form-type-badge">{{ ucfirst($formType) }}</span>
                                    <span class="form-stat-total">{{ number_format($stat['total']) }} gönderim</span>
                                </div>
                                <div class="form-stat-body">
                                    <div class="stat-row">
                                        <span>Ortalama Skor:</span>
                                        <strong class="{{ $stat['avg_score'] >= 0.7 ? 'text-success' : ($stat['avg_score'] >= 0.5 ? 'text-warning' : 'text-danger') }}">
                                            {{ $stat['avg_score'] }}
                                        </strong>
                                    </div>
                                    <div class="stat-row">
                                        <span>Başarı Oranı:</span>
                                        <strong>%{{ $stat['success_rate'] }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Bottom Row: Recent Logs and Top IPs -->
        <div class="bottom-row">
            <!-- Recent Activity -->
            <div class="recent-logs-card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-clock"></i>
                        Son Aktiviteler
                    </h3>
                </div>
                <div class="card-body">
                    <div class="logs-table-wrapper">
                        <table class="logs-table">
                            <thead>
                            <tr>
                                <th>Zaman</th>
                                <th>IP</th>
                                <th>Form</th>
                                <th>Skor</th>
                                <th>Durum</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recentLogs as $log)
                                <tr>
                                    <td>
                                    <span class="time-badge">
                                        {{ $log->created_at->format('H:i:s') }}
                                    </span>
                                        <small class="text-muted d-block">
                                            {{ $log->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>
                                        <code>{{ $log->ip_address }}</code>
                                    </td>
                                    <td>
                                    <span class="form-badge form-badge-{{ $log->form_type }}">
                                        {{ ucfirst($log->form_type) }}
                                    </span>
                                    </td>
                                    <td>
                                    <span class="score-badge score-{{ $log->score >= 0.7 ? 'high' : ($log->score >= 0.5 ? 'medium' : 'low') }}">
                                        {{ number_format($log->score, 2) }}
                                    </span>
                                    </td>
                                    <td>
                                        @if($log->success)
                                            <span class="status-badge status-success">
                                            <i class="fas fa-check"></i> Başarılı
                                        </span>
                                        @else
                                            <span class="status-badge status-failed">
                                            <i class="fas fa-times"></i> Başarısız
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Henüz kayıt bulunmuyor
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top IPs -->
            <div class="top-ips-card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-network-wired"></i>
                        En Aktif IP Adresleri
                    </h3>
                </div>
                <div class="card-body">
                    <div class="ip-list">
                        @forelse($topIps as $ipStat)
                            <div class="ip-item">
                                <div class="ip-header">
                                    <code class="ip-address">{{ $ipStat['ip_address'] }}</code>
                                    <span class="risk-badge risk-{{ $ipStat['risk_level'] }}">
                                {{ ucfirst($ipStat['risk_level']) }} Risk
                            </span>
                                </div>
                                <div class="ip-stats">
                                    <div class="ip-stat">
                                        <i class="fas fa-redo"></i>
                                        {{ $ipStat['total'] }} deneme
                                    </div>
                                    <div class="ip-stat">
                                        <i class="fas fa-star"></i>
                                        Ort: {{ $ipStat['avg_score'] }}
                                    </div>
                                    <div class="ip-stat">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $ipStat['failed_count'] }} başarısız
                                    </div>
                                </div>
                                @if($ipStat['risk_level'] === 'high')
                                    <div class="ip-actions">
                                        <button class="btn btn-sm btn-danger" onclick="blockIp('{{ $ipStat['ip_address'] }}')">
                                            <i class="fas fa-ban"></i> Engelle
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-center text-muted">Henüz veri yok</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Suspicious Activities Alert -->
        @if($suspiciousActivities->count() > 0)
            <div class="alert-card alert-danger">
                <div class="alert-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Şüpheli Aktiviteler ({{ $suspiciousActivities->count() }})</h3>
                </div>
                <div class="alert-body">
                    @foreach($suspiciousActivities->take(5) as $activity)
                        <div class="suspicious-item">
                            <div class="suspicious-info">
                                <code>{{ $activity->ip_address }}</code>
                                <span class="suspicious-time">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="suspicious-details">
                                <span class="score-badge score-low">{{ number_format($activity->score, 2) }}</span>
                                <span class="form-badge form-badge-{{ $activity->form_type }}">{{ ucfirst($activity->form_type) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            .recaptcha-security-dashboard {
                padding: 24px;
                background: #f5f7fa;
            }

            .dashboard-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
                padding: 20px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            }

            .dashboard-header h1 {
                font-size: 28px;
                margin: 0;
                color: #1a1a2e;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .dashboard-header h1 i {
                color: #667eea;
            }

            .subtitle {
                color: #666;
                margin: 5px 0 0 0;
                font-size: 14px;
            }

            .header-right {
                display: flex;
                gap: 12px;
                align-items: center;
            }

            .filter-group select {
                padding: 8px 16px;
                border: 2px solid #e1e8ed;
                border-radius: 8px;
                font-size: 14px;
            }

            /* Stats Grid */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }

            .stat-card {
                background: white;
                border-radius: 12px;
                padding: 24px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                display: flex;
                gap: 20px;
            }

            .stat-icon {
                width: 60px;
                height: 60px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                color: white;
            }

            .stat-icon.bg-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            .stat-icon.bg-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
            .stat-icon.bg-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
            .stat-icon.bg-danger { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }

            .stat-content {
                flex: 1;
            }

            .stat-label {
                font-size: 13px;
                color: #666;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 8px;
            }

            .stat-value {
                font-size: 32px;
                font-weight: 700;
                color: #1a1a2e;
                line-height: 1;
                margin-bottom: 8px;
            }

            .stat-change {
                font-size: 13px;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .stat-change.positive { color: #11998e; }
            .stat-change.negative { color: #f5576c; }

            .stat-detail {
                font-size: 13px;
                color: #999;
            }

            .stat-progress {
                margin-top: 8px;
            }

            .progress {
                height: 6px;
                background: #f0f0f0;
                border-radius: 3px;
                overflow: hidden;
            }

            .progress-bar {
                height: 100%;
                transition: width 0.3s ease;
            }

            /* Charts */
            .charts-row {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 20px;
                margin-bottom: 30px;
            }

            .chart-card,
            .form-stats-card,
            .recent-logs-card,
            .top-ips-card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                overflow: hidden;
            }

            .card-header {
                padding: 20px;
                border-bottom: 1px solid #f0f0f0;
            }

            .card-header h3 {
                font-size: 18px;
                font-weight: 600;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 10px;
                color: #1a1a2e;
            }

            .card-body {
                padding: 20px;
            }

            /* Bottom Row */
            .bottom-row {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 20px;
                margin-bottom: 30px;
            }

            /* Logs Table */
            .logs-table {
                width: 100%;
                font-size: 14px;
            }

            .logs-table th {
                text-align: left;
                padding: 12px;
                background: #f8f9fa;
                font-weight: 600;
                color: #666;
                font-size: 13px;
                text-transform: uppercase;
            }

            .logs-table td {
                padding: 12px;
                border-bottom: 1px solid #f0f0f0;
            }

            .time-badge {
                font-weight: 600;
                color: #1a1a2e;
            }

            .form-badge {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 12px;
                font-size: 12px;
                font-weight: 600;
            }

            .form-badge-contact { background: #e3f2fd; color: #1976d2; }
            .form-badge-newsletter { background: #f3e5f5; color: #7b1fa2; }
            .form-badge-comment { background: #fff3e0; color: #e65100; }
            .form-badge-other { background: #f5f5f5; color: #666; }

            .score-badge {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 12px;
                font-weight: 700;
                font-size: 13px;
            }

            .score-high { background: #e8f5e9; color: #2e7d32; }
            .score-medium { background: #fff3e0; color: #ef6c00; }
            .score-low { background: #ffebee; color: #c62828; }

            .status-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 4px 12px;
                border-radius: 12px;
                font-size: 12px;
                font-weight: 600;
            }

            .status-success { background: #e8f5e9; color: #2e7d32; }
            .status-failed { background: #ffebee; color: #c62828; }

            /* IP List */
            .ip-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .ip-item {
                padding: 16px;
                background: #f8f9fa;
                border-radius: 8px;
                border-left: 4px solid #667eea;
            }

            .ip-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
            }

            .ip-address {
                font-size: 14px;
                font-weight: 600;
            }

            .risk-badge {
                padding: 4px 10px;
                border-radius: 12px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
            }

            .risk-low { background: #e8f5e9; color: #2e7d32; }
            .risk-medium { background: #fff3e0; color: #ef6c00; }
            .risk-high { background: #ffebee; color: #c62828; }

            .ip-stats {
                display: flex;
                gap: 16px;
                font-size: 13px;
                color: #666;
            }

            .ip-stat {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .ip-actions {
                margin-top: 12px;
                padding-top: 12px;
                border-top: 1px solid #e0e0e0;
            }

            /* Alert Card */
            .alert-card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                border-left: 4px solid #f5576c;
                margin-bottom: 30px;
            }

            .alert-header {
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 12px;
                background: #fff5f5;
            }

            .alert-header i {
                color: #f5576c;
                font-size: 24px;
            }

            .alert-header h3 {
                margin: 0;
                font-size: 18px;
                color: #1a1a2e;
            }

            .alert-body {
                padding: 20px;
            }

            .suspicious-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px;
                background: #fff9f9;
                border-radius: 8px;
                margin-bottom: 8px;
            }

            .suspicious-info {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .suspicious-time {
                font-size: 12px;
                color: #999;
            }

            .suspicious-details {
                display: flex;
                gap: 8px;
            }

            /* Form Stats Grid */
            .form-stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 16px;
            }

            .form-stat-item {
                padding: 16px;
                background: #f8f9fa;
                border-radius: 8px;
                border-left: 4px solid #667eea;
            }

            .form-stat-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
            }

            .form-type-badge {
                font-weight: 700;
                color: #667eea;
            }

            .form-stat-total {
                font-size: 13px;
                color: #999;
            }

            .stat-row {
                display: flex;
                justify-content: space-between;
                padding: 6px 0;
                font-size: 14px;
            }

            @media (max-width: 1200px) {
                .charts-row,
                .bottom-row {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 768px) {
                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .dashboard-header {
                    flex-direction: column;
                    gap: 20px;
                }

                .header-right {
                    width: 100%;
                    flex-direction: column;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
        <script>
            // Activity Chart
            const activityCtx = document.getElementById('activityChart').getContext('2d');
            const activityData = @json($period === 'today' ? $charts['hourly'] : $charts['daily']);

            new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: activityData.map(d => d.{{ $period === 'today' ? 'hour' : 'date_formatted' }}),
                    datasets: [
                        {
                            label: 'Toplam',
                            data: activityData.map(d => d.total),
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            tension: 0.4,
                            fill: true,
                        },
                        {
                            label: 'Başarılı',
                            data: activityData.map(d => d.successful),
                            borderColor: '#11998e',
                            backgroundColor: 'rgba(17, 153, 142, 0.1)',
                            tension: 0.4,
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Score Distribution Chart
            const scoreCtx = document.getElementById('scoreDistributionChart').getContext('2d');
            const scoreData = @json($charts['score_distribution']);

            new Chart(scoreCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Bot (0.0-0.29)', 'Şüpheli (0.3-0.49)', 'Orta (0.5-0.69)', 'İyi (0.7-0.89)', 'Mükemmel (0.9-1.0)'],
                    datasets: [{
                        data: [scoreData.very_low, scoreData.low, scoreData.medium, scoreData.high, scoreData.very_high],
                        backgroundColor: [
                            '#f5576c',
                            '#f093fb',
                            '#ffd93d',
                            '#6bcf7f',
                            '#11998e'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });

            // Filter change handlers
            document.getElementById('periodFilter').addEventListener('change', function() {
                updateFilters();
            });

            document.getElementById('formTypeFilter').addEventListener('change', function() {
                updateFilters();
            });

            function updateFilters() {
                const period = document.getElementById('periodFilter').value;
                const formType = document.getElementById('formTypeFilter').value;
                window.location.href = `?period=${period}&form_type=${formType}`;
            }

            // Block IP function
            function blockIp(ip) {
                if (confirm(`${ip} adresini engellemek istediğinizden emin misiniz?`)) {
                    fetch('{{ route("admin.security.recaptcha.block-ip") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ip: ip })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.reload();
                            }
                        });
                }
            }
        </script>
    @endpush
@endsection
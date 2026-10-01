@extends('layouts.agent')

@section('content')
<div class="portal-page-container">
    <!-- Page Header -->
    <div class="page-header-row">
        <div class="page-title-group">
            <h1 class="page-heading">Earnings & Commission</h1>
            <p class="page-subheading">Track your deals and payouts</p>
        </div>
        <div class="page-actions-group">
            <button class="btn btn-outline" data-toast="Downloading payout statement PDF for FY 2023-24..." title="Download Statement">
                {!! \App\Support\Icon::render('download', 'icon', 16) !!}
                <span>Download Statement</span>
            </button>
        </div>
    </div>

    <!-- 4 Top Stat Cards Grid -->
    <div class="earnings-stat-grid">
        <!-- Card 1: Total Earned (Solid Orange Card) -->
        <div class="earnings-stat-card card-gradient-orange">
            <div class="stat-watermark-icon">
                {!! \App\Support\Icon::render('wallet', 'watermark-svg', 28) !!}
            </div>
            <div class="earnings-stat-title">Total Earned</div>
            <div class="earnings-stat-value">{{ $stats['total_earned']['value'] }}</div>
            <div class="earnings-stat-sub">{{ $stats['total_earned']['sub'] }}</div>
            <div class="earnings-stat-trend">
                <span class="trend-pill-white">
                    <strong>{{ $stats['total_earned']['trend'] }}</strong> {{ $stats['total_earned']['trend_context'] }}
                </span>
            </div>
        </div>

        <!-- Card 2: Pending Payout (White Card) -->
        <div class="earnings-stat-card card-white">
            <div class="stat-watermark-icon watermark-gray">
                {!! \App\Support\Icon::render('clock', 'watermark-svg', 28) !!}
            </div>
            <div class="earnings-stat-title text-muted">Pending Payout</div>
            <div class="earnings-stat-value text-dark">{{ $stats['pending_payout']['value'] }}</div>
            <div class="earnings-stat-sub text-muted">{{ $stats['pending_payout']['sub'] }}</div>
            <div class="earnings-stat-trend">
                <span class="trend-pill-green">
                    <strong>{{ $stats['pending_payout']['trend'] }}</strong> <span class="trend-sub">{{ $stats['pending_payout']['trend_context'] }}</span>
                </span>
            </div>
        </div>

        <!-- Card 3: Deals Closed (Solid Green Card) -->
        <div class="earnings-stat-card card-solid-green">
            <div class="stat-watermark-icon">
                {!! \App\Support\Icon::render('check-circle', 'watermark-svg', 28) !!}
            </div>
            <div class="earnings-stat-title">Deals Closed</div>
            <div class="earnings-stat-value">{{ $stats['deals_closed']['value'] }}</div>
            <div class="earnings-stat-sub">{{ $stats['deals_closed']['sub'] }}</div>
            <div class="earnings-stat-trend">
                <span class="trend-pill-white">
                    <strong>{{ $stats['deals_closed']['trend'] }}</strong> {{ $stats['deals_closed']['trend_context'] }}
                </span>
            </div>
        </div>

        <!-- Card 4: Avg. Commission (White Card) -->
        <div class="earnings-stat-card card-white">
            <div class="stat-watermark-icon watermark-gray">
                {!! \App\Support\Icon::render('trending-up', 'watermark-svg', 28) !!}
            </div>
            <div class="earnings-stat-title text-muted">Avg. Commission</div>
            <div class="earnings-stat-value text-dark">{{ $stats['avg_commission']['value'] }}</div>
            <div class="earnings-stat-sub text-muted">{{ $stats['avg_commission']['sub'] }}</div>
            <div class="earnings-stat-trend">
                <span class="trend-pill-green">
                    <strong>{{ $stats['avg_commission']['trend'] }}</strong> <span class="trend-sub">{{ $stats['avg_commission']['trend_context'] }}</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Middle Section: 2 Columns (Monthly Trend + Commission Summary) -->
    <div class="earnings-middle-grid">
        <!-- Monthly Earnings Chart Card -->
        <div class="card monthly-chart-card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Monthly Earnings</h3>
                    <p class="card-subtitle">Your commission trend</p>
                </div>
                <div class="chart-filter-select" data-toast="Showing trend for Last 6 months">
                    {!! \App\Support\Icon::render('calendar', 'icon', 14) !!}
                    <span>Last 6 months</span>
                </div>
            </div>

            <!-- Custom Bar Chart Container -->
            <div class="chart-bars-wrap">
                <div class="chart-bars-grid">
                    @foreach($chart as $bar)
                    <div class="chart-bar-column">
                        <div class="bar-pill-track">
                            <div class="bar-pill-fill" style="height: {{ $bar['height'] }}%;" data-tooltip="{{ $bar['month'] }}: {{ $bar['amount'] }}">
                                <span class="bar-tooltip-popup">{{ $bar['amount'] }}</span>
                            </div>
                        </div>
                        <div class="bar-label">{{ $bar['month'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Commission Summary Card -->
        <div class="card commission-summary-card">
            <div class="card-header" style="margin-bottom: 0.75rem;">
                <h3 class="card-title">Commission Summary</h3>
            </div>

            <div class="commission-rows-list">
                <div class="commission-row">
                    <span class="comm-label">Base Rate</span>
                    <span class="comm-value font-bold">{{ $summary['base_rate'] }}</span>
                </div>

                <div class="commission-row">
                    <span class="comm-label">Bonus Rate</span>
                    <span class="comm-value font-bold text-success">{{ $summary['bonus_rate'] }}</span>
                </div>

                <div class="commission-row">
                    <span class="comm-label">Deals for Bonus</span>
                    <span class="comm-value font-bold">{{ $summary['deals_for_bonus'] }}</span>
                </div>

                <div class="commission-row tier-row">
                    <span class="comm-label" style="font-weight: 700; color: var(--navy);">Current Tier</span>
                    <span class="tier-pill">
                        {!! \App\Support\Icon::render('arrow-up-right', 'tier-icon', 13) !!}
                        <span>{{ $summary['current_tier'] }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Transaction History Table Card -->
    <div class="card transaction-history-card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Transaction History</h3>
                <p class="card-subtitle">All your commission payouts</p>
            </div>
            <a href="javascript:void(0)" class="view-all-link" data-toast="Showing all historic commission records">View All</a>
        </div>

        <div class="table-responsive">
            <table class="leads-table transactions-table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Property</th>
                        <th>Buyer</th>
                        <th>Deal Value</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tx)
                    <tr>
                        <td class="cell-lead-id">
                            <span class="lead-id-text">{{ $tx['id'] }}</span>
                        </td>
                        <td>
                            <strong style="color: var(--text); font-weight: 700;">{{ $tx['property'] }}</strong>
                        </td>
                        <td>
                            <span style="color: var(--text-secondary); font-weight: 500;">{{ $tx['buyer'] }}</span>
                        </td>
                        <td>
                            <span style="font-weight: 600; color: var(--text);">{{ $tx['deal_value'] }}</span>
                        </td>
                        <td>
                            <div class="commission-cell-wrap">
                                <span class="commission-amt">{{ $tx['commission'] }}</span>
                                <span class="commission-rate">{{ $tx['commission_rate'] }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $txStatusClass = match(strtolower($tx['status_type'])) {
                                    'paid' => 'tx-badge-paid',
                                    'processing' => 'tx-badge-processing',
                                    'pending' => 'tx-badge-pending',
                                    default => 'tx-badge-paid'
                                };
                            @endphp
                            <span class="tx-status-pill {{ $txStatusClass }}">
                                {{ $tx['status'] }}
                            </span>
                        </td>
                        <td>
                            <span class="tx-date-text">{{ $tx['date'] }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

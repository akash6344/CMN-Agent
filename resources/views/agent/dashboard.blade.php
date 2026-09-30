@extends('layouts.agent')

@section('content')
<!-- Top Greeting Header -->
<div class="page-greeting-row">
    <h1>Good Morning, Rahul! 👋</h1>
    <p>Here's what's happening with your leads and deals today.</p>
</div>

<!-- Stat Row 1: 4 Metric Cards -->
<div class="stat-row-1">
    @foreach($stats['row1'] as $stat)
        <div class="stat-metric-card">
            <div class="stat-watermark-icon">
                {!! \App\Support\Icon::render($stat['icon'], 'icon', 22) !!}
            </div>
            <span class="stat-card-title">{{ $stat['label'] }}</span>
            <div class="stat-card-val">{{ $stat['value'] }}</div>
            <span class="stat-card-sub">{{ $stat['sub'] }}</span>
            <div class="stat-card-trend {{ $stat['trend_type'] === 'up' ? 'is-up' : 'is-down' }}">
                @if($stat['trend_type'] === 'up')
                    {!! \App\Support\Icon::render('trending-up', 'icon', 12) !!}
                @else
                    {!! \App\Support\Icon::render('trending-down', 'icon', 12) !!}
                @endif
                <span>{{ $stat['trend'] }}</span>
            </div>
        </div>
    @endforeach
</div>

<!-- Stat Row 2: 2 Large Banner Cards -->
<div class="stat-row-2">
    @foreach($stats['row2'] as $banner)
        <div class="banner-card {{ $banner['color'] === 'green' ? 'is-green' : 'is-orange' }}">
            <div class="banner-icon-well">
                {!! \App\Support\Icon::render($banner['icon'], 'icon', 26) !!}
            </div>
            <span class="banner-title">{{ $banner['label'] }}</span>
            <div class="banner-val">{{ $banner['value'] }}</div>
            <span class="banner-sub">{{ $banner['sub'] }}</span>
            <div class="banner-trend">
                {!! \App\Support\Icon::render('trending-up', 'icon', 12) !!}
                <span>{{ $banner['trend'] }}</span>
            </div>
        </div>
    @endforeach
</div>

<!-- Middle Section: Recent Leads + Activity Feed -->
<div class="two-col-grid">
    <!-- Recent Leads -->
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">Recent Leads</h2>
                <div class="card-subtitle">Manage your assigned leads</div>
            </div>
            <a href="javascript:void(0)" class="view-all-link" onclick="openComingSoon('Lead Management')">View All</a>
        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Lead ID</th>
                        <th>Buyer</th>
                        <th>Property</th>
                        <th>Status</th>
                        <th>Next Action</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentLeads as $lead)
                        <tr>
                            <td style="font-weight: 600; color: var(--text-secondary);">{{ $lead['id'] }}</td>
                            <td>
                                <div class="buyer-cell">
                                    <span class="buyer-name">{{ $lead['buyer_name'] }}</span>
                                    <span class="buyer-contact">{{ $lead['phone'] }}</span>
                                </div>
                            </td>
                            <td style="font-weight: 600; color: var(--text);">{{ $lead['property'] }}</td>
                            <td>
                                <span class="chip chip-{{ $lead['status_type'] }}">
                                    <span class="chip-dot">•</span> {{ $lead['status'] }}
                                </span>
                            </td>
                            <td>
                                <div class="next-action-cell">
                                    <span class="next-action-title">{{ $lead['next_action_title'] }}</span>
                                    <span class="next-action-time">{{ $lead['next_action_time'] }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="table-action-btns" style="justify-content: flex-end;">
                                    <a href="tel:9845012345" class="action-icon-btn call-btn" title="Call Buyer" data-toast="Calling {{ $lead['buyer_name'] }}...">
                                        {!! \App\Support\Icon::render('phone', 'icon', 13) !!}
                                    </a>
                                    <a href="https://wa.me/919845012345" target="_blank" class="action-icon-btn whatsapp-btn" title="WhatsApp" data-toast="Opening WhatsApp...">
                                        {!! \App\Support\Icon::render('whatsapp', 'icon', 13) !!}
                                    </a>
                                    <a href="mailto:buyer@example.com" class="action-icon-btn mail-btn" title="Email" data-toast="Opening email composer...">
                                        {!! \App\Support\Icon::render('mail', 'icon', 13) !!}
                                    </a>
                                    <button class="action-icon-btn" title="View Lead" onclick="openComingSoon('Lead Details & History')">
                                        {!! \App\Support\Icon::render('eye', 'icon', 13) !!}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">Activity Feed</h2>
                <div class="card-subtitle">Recent updates & alerts</div>
            </div>
            <a href="javascript:void(0)" class="view-all-link" onclick="openComingSoon('Activity History')">View All</a>
        </div>

        <div class="activity-feed-list">
            @foreach($activityFeed as $feed)
                <div class="activity-feed-item">
                    <div class="feed-icon-well" style="background: {{ $feed['icon_bg'] }}; color: {{ $feed['icon_color'] }};">
                        {!! \App\Support\Icon::render($feed['icon'], 'icon', 16) !!}
                    </div>
                    <div class="feed-content">
                        <div class="feed-top">
                            <span class="feed-title">{{ $feed['title'] }}</span>
                            <span class="feed-time">{{ $feed['time'] }}</span>
                        </div>
                        <p class="feed-desc">{{ $feed['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Bottom Section: Live Negotiations + Upcoming Visits -->
<div class="two-col-grid">
    <!-- Live Negotiations -->
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">
                    <span>Live Negotiations</span>
                    <span class="chip chip-success" style="font-size: 0.7rem; font-weight: 700;">• 3 Active</span>
                </h2>
                <div class="card-subtitle">Smart Bargain deals in progress</div>
            </div>
        </div>

        <div class="negotiations-list">
            @foreach($liveNegotiations as $deal)
                <div class="deal-card">
                    <div class="deal-header">
                        <div>
                            <div class="deal-title">{{ $deal['property'] }}</div>
                            <div class="deal-meta">Deal #{{ $deal['id'] }} • {{ $deal['time_ago'] }}</div>
                        </div>
                        <span class="chip chip-{{ $deal['status_type'] }}">{{ $deal['status'] }}</span>
                    </div>

                    <div class="deal-band-wrap">
                        <div class="deal-offer-col">
                            <span class="deal-offer-label">Buyer Offer</span>
                            <span class="deal-offer-val">{{ $deal['buyer_offer'] }}</span>
                        </div>

                        <div class="deal-gap-badge">
                            <span>→</span>
                            <span>Gap: {{ $deal['gap'] }}</span>
                        </div>

                        <div class="deal-offer-col" style="text-align: right;">
                            <span class="deal-offer-label">Seller Ask</span>
                            <span class="deal-ask-val">{{ $deal['seller_ask'] }}</span>
                        </div>
                    </div>

                    @if(!empty($deal['action_primary']))
                        <div class="deal-actions">
                            <button class="btn btn-primary btn-sm" style="flex: 1;" data-toast="Offer forwarded to seller portal" data-toast-type="success">
                                {{ $deal['action_primary'] }}
                            </button>
                            <button class="btn btn-outline btn-sm" onclick="openComingSoon('Counter Offer Form')">
                                {{ $deal['action_secondary'] }}
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Upcoming Visits -->
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">Upcoming Visits</h2>
                <div class="card-subtitle">Scheduled site visits</div>
            </div>
            <button class="btn btn-primary btn-sm" onclick="openComingSoon('Schedule Visit')">
                {!! \App\Support\Icon::render('plus', 'icon', 13) !!}
                <span>Schedule</span>
            </button>
        </div>

        <div class="visits-list">
            @foreach($upcomingVisits as $visit)
                <div class="visit-card">
                    <div class="visit-top">
                        <div>
                            <div class="visit-prop-title">{{ $visit['property'] }}</div>
                            <div class="visit-loc">
                                {!! \App\Support\Icon::render('pin', 'icon', 12) !!}
                                <span>{{ $visit['location'] }}</span>
                            </div>
                        </div>
                        <span class="chip chip-{{ $visit['status_type'] }}">
                            @if($visit['status'] === 'Confirmed')
                                {!! \App\Support\Icon::render('check', 'icon', 12) !!}
                            @else
                                {!! \App\Support\Icon::render('clock', 'icon', 12) !!}
                            @endif
                            {{ $visit['status'] }}
                        </span>
                    </div>

                    <div class="visit-bottom">
                        <div style="display: flex; align-items: center; gap: 0.35rem;">
                            {!! \App\Support\Icon::render('users', 'icon', 12) !!}
                            <span style="font-weight: 600; color: var(--text);">{{ $visit['client_name'] }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.35rem;">
                            {!! \App\Support\Icon::render('clock', 'icon', 12) !!}
                            <span>{{ $visit['time_slot'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Coming Soon Popup Modal -->
<div class="modal-overlay {{ !empty($comingSoonSection) ? 'is-active' : '' }}" id="coming-soon-modal">
    <div class="modal-card">
        <div class="modal-header">
            <h3 class="modal-title" id="coming-soon-title">{{ $comingSoonSection ?? 'Feature' }} — Coming Soon</h3>
            <button class="modal-close-btn modal-close-trigger">&times;</button>
        </div>
        <div class="modal-body" style="text-align: center; padding: 2rem 1.5rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                {!! \App\Support\Icon::render('sparkles', 'icon', 28) !!}
            </div>
            <h4 style="font-size: 1.15rem; font-weight: 700; color: var(--text); margin-bottom: 0.5rem;" id="coming-soon-heading">
                Under Active Development
            </h4>
            <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6;" id="coming-soon-desc">
                The <strong id="coming-soon-feature-name">{{ $comingSoonSection ?? 'requested module' }}</strong> is currently being integrated for the agent portal release. Stay tuned!
            </p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn btn-primary modal-close-trigger" style="min-width: 120px;">
                Got it
            </button>
        </div>
    </div>
</div>
@endsection

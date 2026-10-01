<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'CMNHousing' }} · Agent Portal</title>
    
    <!-- Design System Assets -->
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <!-- Sidebar Backdrop Overlay for Mobile/Tablet -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Sidebar Navigation -->
        <aside class="sidebar" id="agent-sidebar">
            <div class="sidebar-header">
                <div class="brand-wrap">
                    <div class="brand-icon">
                        {!! \App\Support\Icon::render('building', 'icon', 20) !!}
                    </div>
                    <div class="brand-info">
                        <span class="brand-title">CMNHousing</span>
                        <span class="brand-sub">Agent Portal</span>
                    </div>
                </div>
                <button class="sidebar-toggle-btn" id="sidebar-toggle" aria-label="Toggle navigation">
                    {!! \App\Support\Icon::render('x', 'icon', 18) !!}
                </button>
            </div>

            <div class="sidebar-body">
                <div class="nav-section">
                    <div class="nav-section-title">Main Menu</div>
                    <ul class="nav-list">
                        @foreach($navItems as $item)
                            <li>
                                @if(!empty($item['is_coming_soon']))
                                    <a href="javascript:void(0)" class="nav-link" onclick="openComingSoon('{{ $item['feature'] ?? $item['label'] }}')">
                                        {!! \App\Support\Icon::render($item['icon'], 'icon', 18) !!}
                                        <span>{{ $item['label'] }}</span>
                                    </a>
                                @else
                                    <a href="{{ route($item['route']) }}" class="nav-link {{ $active === $item['id'] ? 'is-active' : '' }}">
                                        {!! \App\Support\Icon::render($item['icon'], 'icon', 18) !!}
                                        <span>{{ $item['label'] }}</span>
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="nav-section" style="margin-top: auto;">
                    <div class="nav-section-title">Settings</div>
                    <ul class="nav-list">
                        @foreach($footNavItems as $item)
                            <li>
                                <a href="javascript:void(0)" class="nav-link" onclick="openComingSoon('{{ $item['feature'] ?? $item['label'] }}')">
                                    {!! \App\Support\Icon::render($item['icon'], 'icon', 18) !!}
                                    <span>{{ $item['label'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="user-profile-card">
                    <div class="user-avatar">
                        {{ $agent['initials'] ?? 'RA' }}
                        <span class="online-dot"></span>
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ $agent['name'] ?? 'Rahul Agarwal' }}</div>
                        <div class="user-role">{{ $agent['role'] ?? 'Senior Agent' }}</div>
                    </div>
                    <button class="user-action-btn" data-toast="Signed out of session" title="Sign out">
                        {!! \App\Support\Icon::render('logout', 'icon', 16) !!}
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Shell -->
        <div class="main-wrapper">
            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <button class="mobile-hamburger-btn" id="mobile-hamburger-btn" aria-label="Toggle Menu">
                        {!! \App\Support\Icon::render('menu', 'icon', 20) !!}
                    </button>
                    <div class="topbar-search">
                        <span class="search-icon">
                            {!! \App\Support\Icon::render('search', 'icon', 16) !!}
                        </span>
                        <input type="text" placeholder="Search leads, properties..." id="global-search-input">
                    </div>
                </div>

                <div class="topbar-right">
                    <div class="dropdown-select-btn" data-toast="Filter applied: Today's Leads">
                        <span>Today's Leads</span>
                        {!! \App\Support\Icon::render('chevron-down', 'icon', 14) !!}
                    </div>

                    <button class="topbar-icon-btn" onclick="openComingSoon('Notifications Desk')" title="Notifications">
                        {!! \App\Support\Icon::render('bell', 'icon', 18) !!}
                        @if(($agent['unread_notifications'] ?? 0) > 0)
                            <span class="badge-dot">{{ $agent['unread_notifications'] }}</span>
                        @endif
                    </button>

                    <button class="topbar-icon-btn" onclick="openComingSoon('Agent Messages Desk')" title="Messages">
                        {!! \App\Support\Icon::render('message', 'icon', 18) !!}
                    </button>
                </div>
            </header>

            <!-- Main Page View Content -->
            <main class="page-container">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Global Toast Container -->
    <div class="toast-container">
        <div id="toast" class="toast" role="alert"></div>
    </div>

    @yield('modals')
</body>
</html>

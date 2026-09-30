<?php

namespace App\Support;

class DemoAgentData
{
    public static function agent(): array
    {
        return [
            'name' => 'Rahul Agarwal',
            'first_name' => 'Rahul',
            'role' => 'Senior Agent',
            'initials' => 'RA',
            'email' => 'rahul.agarwal@cmnhousing.com',
            'phone' => '+91 98450 12345',
            'unread_notifications' => 3,
        ];
    }

    public static function navItems(): array
    {
        return [
            [
                'id' => 'dashboard',
                'label' => 'Dashboard',
                'route' => 'agent.dashboard',
                'icon' => 'dashboard',
            ],
            [
                'id' => 'leads',
                'label' => 'Leads',
                'route' => 'agent.dashboard',
                'icon' => 'users',
                'is_coming_soon' => true,
                'feature' => 'Lead Management',
            ],
            [
                'id' => 'properties',
                'label' => 'Properties',
                'route' => 'agent.dashboard',
                'icon' => 'building',
                'is_coming_soon' => true,
                'feature' => 'Property Portfolio',
            ],
            [
                'id' => 'bargain',
                'label' => 'Bargain & Deals',
                'route' => 'agent.dashboard',
                'icon' => 'handshake',
                'is_coming_soon' => true,
                'feature' => 'Smart Bargain & Deals',
            ],
            [
                'id' => 'visits',
                'label' => 'Site Visits',
                'route' => 'agent.dashboard',
                'icon' => 'calendar',
                'is_coming_soon' => true,
                'feature' => 'Site Visits Coordinator',
            ],
            [
                'id' => 'earnings',
                'label' => 'Earnings',
                'route' => 'agent.dashboard',
                'icon' => 'wallet',
                'is_coming_soon' => true,
                'feature' => 'Earnings & Commission Payouts',
            ],
            [
                'id' => 'analytics',
                'label' => 'Analytics',
                'route' => 'agent.dashboard',
                'icon' => 'chart',
                'is_coming_soon' => true,
                'feature' => 'Performance Analytics',
            ],
        ];
    }

    public static function footNavItems(): array
    {
        return [
            [
                'id' => 'notifications',
                'label' => 'Notifications',
                'route' => 'agent.dashboard',
                'icon' => 'bell',
                'is_coming_soon' => true,
                'feature' => 'Notifications Desk',
            ],
            [
                'id' => 'settings',
                'label' => 'Settings',
                'route' => 'agent.dashboard',
                'icon' => 'settings',
                'is_coming_soon' => true,
                'feature' => 'Agent Profile & Settings',
            ],
        ];
    }

    public static function dashboardStats(): array
    {
        return [
            'row1' => [
                [
                    'label' => 'New Leads Today',
                    'value' => '12',
                    'sub' => '5 pending response',
                    'trend' => '↑ 18% vs last week',
                    'trend_type' => 'up',
                    'icon' => 'user-plus',
                ],
                [
                    'label' => 'Follow-ups Due',
                    'value' => '8',
                    'sub' => '3 urgent',
                    'trend' => '↓ 5% vs last week',
                    'trend_type' => 'down',
                    'icon' => 'phone',
                ],
                [
                    'label' => 'Active Properties',
                    'value' => '24',
                    'sub' => 'In your portfolio',
                    'trend' => '↑ 12% vs last week',
                    'trend_type' => 'up',
                    'icon' => 'building',
                ],
                [
                    'label' => 'Live Negotiations',
                    'value' => '6',
                    'sub' => 'Smart Bargain deals',
                    'trend' => '↑ 25% vs last week',
                    'trend_type' => 'up',
                    'icon' => 'handshake',
                ],
            ],
            'row2' => [
                [
                    'label' => 'Deals Closed',
                    'value' => '15',
                    'sub' => 'This month',
                    'trend' => '↑ 40% vs last week',
                    'color' => 'green',
                    'icon' => 'check-circle',
                ],
                [
                    'label' => 'Commission Earned',
                    'value' => '₹2.8L',
                    'sub' => '₹45K pending',
                    'trend' => '↑ 22% vs last week',
                    'color' => 'orange',
                    'icon' => 'wallet',
                ],
            ]
        ];
    }

    public static function recentLeads(): array
    {
        return [
            [
                'id' => 'L001',
                'buyer_name' => 'Priya Sharma',
                'phone' => '98XX-XXX-XX1',
                'property' => 'Green Valley 3BHK',
                'status' => 'New',
                'status_type' => 'info',
                'next_action_title' => 'Initial Call',
                'next_action_time' => 'Today',
            ],
            [
                'id' => 'L002',
                'buyer_name' => 'Amit Patel',
                'phone' => '97XX-XXX-XX2',
                'property' => 'Skyline Towers 2BHK',
                'status' => 'Contacted',
                'status_type' => 'warning',
                'next_action_title' => 'Schedule Visit',
                'next_action_time' => 'Today',
            ],
            [
                'id' => 'L003',
                'buyer_name' => 'Ravi Kumar',
                'phone' => '99XX-XXX-XX3',
                'property' => 'Palm Heights 4BHK',
                'status' => 'Visit Scheduled',
                'status_type' => 'peach',
                'next_action_title' => 'Visit Tomorrow',
                'next_action_time' => 'Yesterday',
            ],
            [
                'id' => 'L004',
                'buyer_name' => 'Sneha Reddy',
                'phone' => '98XX-XXX-XX4',
                'property' => 'Urban Edge 2BHK',
                'status' => 'In Negotiation',
                'status_type' => 'mint',
                'next_action_title' => 'Await Payment',
                'next_action_time' => '2 days ago',
            ],
            [
                'id' => 'L005',
                'buyer_name' => 'Vikram Singh',
                'phone' => '96XX-XXX-XX5',
                'property' => 'Sunrise Apartments',
                'status' => 'New',
                'status_type' => 'info',
                'next_action_title' => 'Initial Call',
                'next_action_time' => 'Today',
            ],
        ];
    }

    public static function activityFeed(): array
    {
        return [
            [
                'title' => 'New Lead Assigned',
                'desc' => 'Priya Sharma interested in Gr...',
                'time' => '5 mins ago',
                'icon' => 'user-plus',
                'icon_bg' => '#eff6ff',
                'icon_color' => '#3b82f6',
            ],
            [
                'title' => 'Bargain Response Received',
                'desc' => 'Seller accepted counter off...',
                'time' => '30 mins ago',
                'icon' => 'message',
                'icon_bg' => '#f1f5f9',
                'icon_color' => '#475569',
            ],
            [
                'title' => 'Site Visit Confirmed',
                'desc' => 'Ravi Kumar confirmed visit fo...',
                'time' => '1 hour ago',
                'icon' => 'calendar',
                'icon_bg' => '#fffbeb',
                'icon_color' => '#d97706',
            ],
            [
                'title' => 'Follow-up Due',
                'desc' => 'Call Amit Patel about proper...',
                'time' => '2 hours ago',
                'icon' => 'phone',
                'icon_bg' => '#ffedd5',
                'icon_color' => '#ea580c',
            ],
            [
                'title' => 'Commission Credited',
                'desc' => '₹35,000 for Urban Edge deal',
                'time' => 'Yesterday',
                'icon' => 'wallet',
                'icon_bg' => '#ecfdf5',
                'icon_color' => '#16a34a',
            ],
        ];
    }

    public static function liveNegotiations(): array
    {
        return [
            [
                'id' => 'D001',
                'property' => 'Green Valley 3BHK',
                'time_ago' => '2 hours ago',
                'buyer_offer' => '₹85L',
                'gap' => '₹7L',
                'seller_ask' => '₹92L',
                'status' => 'Pending',
                'status_type' => 'warning',
                'action_primary' => 'Forward to Seller',
                'action_secondary' => 'Counter',
            ],
            [
                'id' => 'D002',
                'property' => 'Skyline Towers 2BHK',
                'time_ago' => '30 mins ago',
                'buyer_offer' => '₹62L',
                'gap' => '₹3L',
                'seller_ask' => '₹65L',
                'status' => '→ Counter',
                'status_type' => 'info',
            ],
            [
                'id' => 'D003',
                'property' => 'Palm Heights 4BHK',
                'time_ago' => 'Yesterday',
                'buyer_offer' => '₹1.2Cr',
                'gap' => '₹5L',
                'seller_ask' => '₹1.25Cr',
                'status' => 'Accepted',
                'status_type' => 'success',
            ],
        ];
    }

    public static function upcomingVisits(): array
    {
        return [
            [
                'id' => 'V001',
                'property' => 'Palm Heights 4BHK',
                'location' => 'Whitefield, Bangalore',
                'client_name' => 'Ravi Kumar',
                'time_slot' => 'Tomorrow • 10:00 AM',
                'status' => 'Confirmed',
                'status_type' => 'success',
            ],
            [
                'id' => 'V002',
                'property' => 'Green Valley 3BHK',
                'location' => 'Electronic City',
                'client_name' => 'Priya Sharma',
                'time_slot' => 'Jan 20 • 2:30 PM',
                'status' => 'Pending',
                'status_type' => 'warning',
            ],
            [
                'id' => 'V003',
                'property' => 'Skyline Towers 2BHK',
                'location' => 'Marathahalli',
                'client_name' => 'Amit Patel',
                'time_slot' => 'Jan 21 • 11:00 AM',
                'status' => 'Confirmed',
                'status_type' => 'success',
            ],
        ];
    }
}

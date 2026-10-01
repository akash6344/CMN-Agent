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
                'route' => 'agent.leads',
                'icon' => 'users',
                'is_coming_soon' => false,
            ],
            [
                'id' => 'properties',
                'label' => 'Properties',
                'route' => 'agent.properties',
                'icon' => 'building',
                'is_coming_soon' => false,
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
                'route' => 'agent.earnings',
                'icon' => 'wallet',
                'is_coming_soon' => false,
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

    public static function leadsList(): array
    {
        return [
            [
                'id' => 'L001',
                'buyer_name' => 'Priya Sharma',
                'phone' => '98XX-XXX-XX1',
                'email' => 'pri***@gmail.com',
                'property' => 'Green Valley 3BHK',
                'interest_note' => 'Looking for immediate possession',
                'budget' => '₹80L - ₹95L',
                'status' => 'New',
                'status_code' => 'new',
                'source' => 'Website',
                'date' => 'Today, 10:30 AM',
            ],
            [
                'id' => 'L002',
                'buyer_name' => 'Amit Patel',
                'phone' => '97XX-XXX-XX2',
                'email' => 'ami***@gmail.com',
                'property' => 'Skyline Towers 2BHK',
                'interest_note' => 'Prefers higher floors',
                'budget' => '₹55L - ₹70L',
                'status' => 'Contacted',
                'status_code' => 'contacted',
                'source' => 'MagicBricks',
                'date' => 'Today, 9:15 AM',
            ],
            [
                'id' => 'L003',
                'buyer_name' => 'Ravi Kumar',
                'phone' => '99XX-XXX-XX3',
                'email' => 'rav***@yahoo.com',
                'property' => 'Palm Heights 4BHK',
                'interest_note' => 'Site visit scheduled for tomorrow',
                'budget' => '₹1.1Cr - ₹1.3Cr',
                'status' => 'Visit Scheduled',
                'status_code' => 'visit',
                'source' => 'Referral',
                'date' => 'Yesterday',
            ],
            [
                'id' => 'L004',
                'buyer_name' => 'Sneha Reddy',
                'phone' => '98XX-XXX-XX4',
                'email' => 'sne***@gmail.com',
                'property' => 'Urban Edge 2BHK',
                'interest_note' => 'Negotiation in progress',
                'budget' => '₹45L - ₹55L',
                'status' => 'In Negotiation',
                'status_code' => 'deal',
                'source' => '99acres',
                'date' => '2 days ago',
            ],
            [
                'id' => 'L005',
                'buyer_name' => 'Vikram Singh',
                'phone' => '96XX-XXX-XX5',
                'email' => 'vik***@outlook.com',
                'property' => 'Sunrise Apartments',
                'interest_note' => 'Interested in east-facing units',
                'budget' => '₹60L - ₹75L',
                'status' => 'New',
                'status_code' => 'new',
                'source' => 'Walk-in',
                'date' => 'Today, 11:45 AM',
            ],
            [
                'id' => 'L006',
                'buyer_name' => 'Meera Iyer',
                'phone' => '95XX-XXX-XX6',
                'email' => 'mee***@gmail.com',
                'property' => 'Lake View Residency',
                'interest_note' => 'Ready to move in',
                'budget' => '₹90L - ₹1.1Cr',
                'status' => 'Contacted',
                'status_code' => 'contacted',
                'source' => 'Website',
                'date' => '3 days ago',
            ],
            [
                'id' => 'L007',
                'buyer_name' => 'Rohan Gupta',
                'phone' => '94XX-XXX-XX7',
                'email' => 'roh***@gmail.com',
                'property' => 'Royal Palms 3BHK',
                'interest_note' => 'Loan pre-approved, closing soon',
                'budget' => '₹1.5Cr - ₹1.8Cr',
                'status' => 'Deal Agreed',
                'status_code' => 'deal',
                'source' => 'Direct Call',
                'date' => '4 days ago',
            ],
            [
                'id' => 'L008',
                'buyer_name' => 'Ananya Verma',
                'phone' => '93XX-XXX-XX8',
                'email' => 'ana***@gmail.com',
                'property' => 'Cyber City Heights',
                'interest_note' => 'Registration completed',
                'budget' => '₹70L - ₹85L',
                'status' => 'Closed',
                'status_code' => 'closed',
                'source' => 'Housing.com',
                'date' => '5 days ago',
            ],
        ];
    }

    public static function propertiesList(): array
    {
        return [
            [
                'id' => 'P001',
                'title' => 'Green Valley 3BHK',
                'location' => 'Electronic City, Bangalore',
                'price' => '₹92 Lakhs',
                'price_val' => 9200000,
                'beds' => 3,
                'baths' => 2,
                'sqft' => '1,450 sqft',
                'status' => 'Active',
                'status_type' => 'active',
                'leads_count' => 5,
                'image' => '/images/properties/green-valley.jpg',
            ],
            [
                'id' => 'P002',
                'title' => 'Skyline Towers 2BHK',
                'location' => 'Marathahalli, Bangalore',
                'price' => '₹65 Lakhs',
                'price_val' => 6500000,
                'beds' => 2,
                'baths' => 2,
                'sqft' => '1,100 sqft',
                'status' => 'Active',
                'status_type' => 'active',
                'leads_count' => 8,
                'image' => '/images/properties/skyline-towers.jpg',
            ],
            [
                'id' => 'P003',
                'title' => 'Palm Heights 4BHK',
                'location' => 'Whitefield, Bangalore',
                'price' => '₹1.25 Cr',
                'price_val' => 12500000,
                'beds' => 4,
                'baths' => 3,
                'sqft' => '2,800 sqft',
                'status' => 'Active',
                'status_type' => 'active',
                'leads_count' => 3,
                'image' => '/images/properties/palm-heights.jpg',
            ],
            [
                'id' => 'P004',
                'title' => 'Silver Springs 3BHK',
                'location' => 'Sarjapur Road, Bangalore',
                'price' => '₹88 Lakhs',
                'price_val' => 8800000,
                'beds' => 3,
                'baths' => 2,
                'sqft' => '1,520 sqft',
                'status' => 'Pending Approval',
                'status_type' => 'pending',
                'leads_count' => null,
                'image' => '/images/properties/silver-springs.jpg',
            ],
            [
                'id' => 'P005',
                'title' => 'Urban Edge 2BHK',
                'location' => 'HSR Layout, Bangalore',
                'price' => '₹58 Lakhs',
                'price_val' => 5800000,
                'beds' => 2,
                'baths' => 2,
                'sqft' => '1,050 sqft',
                'status' => 'Active',
                'status_type' => 'active',
                'leads_count' => 12,
                'image' => '/images/properties/urban-edge.jpg',
            ],
            [
                'id' => 'P006',
                'title' => 'Prestige Haven Penthouse',
                'location' => 'Indiranagar, Bangalore',
                'price' => '₹2.10 Cr',
                'price_val' => 21000000,
                'beds' => 4,
                'baths' => 4,
                'sqft' => '3,200 sqft',
                'status' => 'Rejected',
                'status_type' => 'rejected',
                'leads_count' => null,
                'image' => '/images/properties/prestige-haven.jpg',
            ],
        ];
    }

    public static function earningsData(): array
    {
        return [
            'stats' => [
                'total_earned' => [
                    'label' => 'Total Earned',
                    'value' => '₹2,38,400',
                    'sub' => 'This month',
                    'trend' => '↑ 22%',
                    'trend_context' => 'vs last week',
                    'card_type' => 'orange',
                    'icon' => 'wallet',
                ],
                'pending_payout' => [
                    'label' => 'Pending Payout',
                    'value' => '₹1,09,200',
                    'sub' => '2 deals awaiting',
                    'trend' => '↑ 15%',
                    'trend_context' => 'vs last week',
                    'card_type' => 'white',
                    'icon' => 'clock',
                ],
                'deals_closed' => [
                    'label' => 'Deals Closed',
                    'value' => '5',
                    'sub' => 'This month',
                    'trend' => '↑ 40%',
                    'trend_context' => 'vs last week',
                    'card_type' => 'green',
                    'icon' => 'check-circle',
                ],
                'avg_commission' => [
                    'label' => 'Avg. Commission',
                    'value' => '₹47,680',
                    'sub' => 'Per deal',
                    'trend' => '↑ 8%',
                    'trend_context' => 'vs last week',
                    'card_type' => 'white',
                    'icon' => 'trending-up',
                ],
            ],
            'chart' => [
                ['month' => 'Aug', 'amount' => '₹1,45,000', 'height' => 52],
                ['month' => 'Sep', 'amount' => '₹1,80,000', 'height' => 64],
                ['month' => 'Oct', 'amount' => '₹1,65,000', 'height' => 58],
                ['month' => 'Nov', 'amount' => '₹2,10,000', 'height' => 76],
                ['month' => 'Dec', 'amount' => '₹2,60,000', 'height' => 95],
                ['month' => 'Jan', 'amount' => '₹2,38,400', 'height' => 88],
            ],
            'summary' => [
                'base_rate' => '0.6%',
                'bonus_rate' => '+0.1%',
                'deals_for_bonus' => '3 more',
                'current_tier' => 'Silver',
            ],
            'transactions' => [
                [
                    'id' => 'T001',
                    'property' => 'Urban Edge 2BHK',
                    'buyer' => 'Sneha Reddy',
                    'deal_value' => '₹58 Lakhs',
                    'commission' => '₹35,000',
                    'commission_rate' => '0.6%',
                    'status' => 'Paid',
                    'status_type' => 'paid',
                    'date' => 'Jan 15, 2024',
                ],
                [
                    'id' => 'T002',
                    'property' => 'Sunrise Apartments 3BHK',
                    'buyer' => 'Karthik Nair',
                    'deal_value' => '₹72 Lakhs',
                    'commission' => '₹43,200',
                    'commission_rate' => '0.6%',
                    'status' => 'Paid',
                    'status_type' => 'paid',
                    'date' => 'Jan 10, 2024',
                ],
                [
                    'id' => 'T003',
                    'property' => 'Green Valley 3BHK',
                    'buyer' => 'Priya Sharma',
                    'deal_value' => '₹85 Lakhs',
                    'commission' => '₹51,000',
                    'commission_rate' => '0.6%',
                    'status' => 'Processing',
                    'status_type' => 'processing',
                    'date' => 'Jan 18, 2024',
                ],
                [
                    'id' => 'T004',
                    'property' => 'Palm Heights 4BHK',
                    'buyer' => 'Ravi Kumar',
                    'deal_value' => '₹1.2 Cr',
                    'commission' => '₹72,000',
                    'commission_rate' => '0.6%',
                    'status' => 'Pending',
                    'status_type' => 'pending',
                    'date' => 'Expected Jan 25',
                ],
                [
                    'id' => 'T005',
                    'property' => 'Skyline Towers 2BHK',
                    'buyer' => 'Amit Patel',
                    'deal_value' => '₹62 Lakhs',
                    'commission' => '₹37,200',
                    'commission_rate' => '0.6%',
                    'status' => 'Pending',
                    'status_type' => 'pending',
                    'date' => 'Expected Jan 28',
                ],
            ],
        ];
    }
}

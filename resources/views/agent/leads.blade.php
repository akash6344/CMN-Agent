@extends('layouts.agent')

@section('content')
<div class="portal-page-container">
    <!-- Page Header -->
    <div class="page-header-row">
        <div class="page-title-group">
            <h1 class="page-heading">Lead Management</h1>
            <p class="page-subheading">Track and manage your assigned leads</p>
        </div>
        <div class="page-actions-group">
            <button class="btn btn-outline" data-toast="Exporting leads report CSV..." title="Export leads">
                {!! \App\Support\Icon::render('download', 'icon', 16) !!}
                <span>Export</span>
            </button>
            <button class="btn btn-primary" onclick="openModal('add-lead-modal')" title="Add new lead">
                {!! \App\Support\Icon::render('plus', 'icon', 16) !!}
                <span>Add Lead</span>
            </button>
        </div>
    </div>

    <!-- Search & Filter Tabs Toolbar -->
    <div class="leads-toolbar-row">
        <div class="leads-search-box">
            <span class="leads-search-icon">
                {!! \App\Support\Icon::render('search', 'icon', 16) !!}
            </span>
            <input type="text" id="lead-search-input" placeholder="Search by name, property, or ID..." autocomplete="off">
            <button type="button" class="clear-search-btn" id="clear-search-btn" style="display: none;">&times;</button>
        </div>

        <div class="leads-filter-pills" id="lead-filter-pills">
            <button type="button" class="filter-pill is-active" data-filter="all">All</button>
            <button type="button" class="filter-pill" data-filter="new">New</button>
            <button type="button" class="filter-pill" data-filter="contacted">Contacted</button>
            <button type="button" class="filter-pill" data-filter="visit">Visit</button>
            <button type="button" class="filter-pill" data-filter="deal">Deal</button>
            <button type="button" class="filter-pill" data-filter="closed">Closed</button>
        </div>
    </div>

    <!-- Leads Table Card -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="leads-table" id="leads-data-table">
                <thead>
                    <tr>
                        <th class="col-lead-id">Lead ID</th>
                        <th class="col-buyer">Buyer Details</th>
                        <th class="col-prop">Property Interest</th>
                        <th class="col-budget">Budget</th>
                        <th class="col-status">Status</th>
                        <th class="col-source">Source</th>
                        <th class="col-date">Date</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody id="leads-table-body">
                    @forelse($leads as $lead)
                    <tr class="lead-row" 
                        data-id="{{ strtolower($lead['id']) }}" 
                        data-name="{{ strtolower($lead['buyer_name']) }}" 
                        data-prop="{{ strtolower($lead['property']) }}" 
                        data-status="{{ strtolower($lead['status_code'] ?? 'all') }}">
                        <td class="cell-lead-id">
                            <span class="lead-id-text">{{ $lead['id'] }}</span>
                        </td>
                        <td class="cell-buyer">
                            <div class="buyer-info-wrap">
                                <div class="buyer-name">{{ $lead['buyer_name'] }}</div>
                                <div class="buyer-meta">{{ $lead['phone'] }}</div>
                                <div class="buyer-meta">{{ $lead['email'] }}</div>
                            </div>
                        </td>
                        <td class="cell-prop">
                            <div class="prop-interest-wrap">
                                <div class="prop-title">{{ $lead['property'] }}</div>
                                <div class="prop-note">{{ $lead['interest_note'] }}</div>
                            </div>
                        </td>
                        <td class="cell-budget">
                            <span class="budget-tag">{{ $lead['budget'] }}</span>
                        </td>
                        <td class="cell-status">
                            @php
                                $statusClass = match(strtolower($lead['status_code'] ?? '')) {
                                    'new' => 'badge-new',
                                    'contacted' => 'badge-contacted',
                                    'visit' => 'badge-visit',
                                    'deal' => 'badge-deal',
                                    'closed' => 'badge-closed',
                                    default => 'badge-new',
                                };
                            @endphp
                            <span class="status-pill {{ $statusClass }}">
                                <span class="status-dot"></span>
                                <span>{{ $lead['status'] }}</span>
                            </span>
                        </td>
                        <td class="cell-source">
                            <span class="source-text">{{ $lead['source'] }}</span>
                        </td>
                        <td class="cell-date">
                            <span class="date-text">{{ $lead['date'] }}</span>
                        </td>
                        <td class="cell-actions">
                            <div class="action-buttons-group">
                                <button class="lead-action-btn call-action" 
                                        data-toast="Initiating call to {{ $lead['buyer_name'] }}..." 
                                        title="Call {{ $lead['buyer_name'] }}">
                                    {!! \App\Support\Icon::render('phone', 'icon', 14) !!}
                                </button>
                                <button class="lead-action-btn whatsapp-action" 
                                        data-toast="Opening WhatsApp conversation with {{ $lead['buyer_name'] }}..." 
                                        title="Chat on WhatsApp">
                                    {!! \App\Support\Icon::render('whatsapp', 'icon', 14) !!}
                                </button>
                                <button class="lead-action-btn mail-action" 
                                        data-toast="Opening email composer for {{ $lead['email'] }}..." 
                                        title="Send Email">
                                    {!! \App\Support\Icon::render('mail', 'icon', 14) !!}
                                </button>
                                <button class="lead-action-btn view-action" 
                                        onclick="viewLeadDetails('{{ $lead['id'] }}', '{{ addslashes($lead['buyer_name']) }}', '{{ $lead['phone'] }}', '{{ $lead['email'] }}', '{{ addslashes($lead['property']) }}', '{{ addslashes($lead['interest_note']) }}', '{{ $lead['budget'] }}', '{{ $lead['status'] }}', '{{ $lead['source'] }}', '{{ $lead['date'] }}')" 
                                        title="View Details">
                                    {!! \App\Support\Icon::render('eye', 'icon', 14) !!}
                                </button>
                                <button class="lead-action-btn more-action" 
                                        data-toast="Lead options for {{ $lead['id'] }}" 
                                        title="More Options">
                                    {!! \App\Support\Icon::render('more-vertical', 'icon', 14) !!}
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-table-state">
                            <p>No leads found matching your criteria.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="no-leads-match" class="empty-table-state" style="display: none; padding: 3rem 1rem; text-align: center;">
            <div style="color: var(--text-muted); font-size: 0.95rem; font-weight: 500;">No leads found matching your search or filter.</div>
            <button class="btn btn-outline btn-sm" style="margin-top: 0.75rem;" onclick="resetLeadFilters()">Reset Filters</button>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Add Lead Modal -->
<div class="modal-overlay" id="add-lead-modal">
    <div class="modal-card modal-card-md">
        <div class="modal-header">
            <div class="modal-title-wrap">
                <h3 class="modal-title">Add New Buyer Lead</h3>
                <p class="modal-subtitle">Assign a prospective buyer lead to your CMNHousing pipeline</p>
            </div>
            <button class="modal-close-trigger" onclick="closeModal('add-lead-modal')">&times;</button>
        </div>
        <form id="add-lead-form" onsubmit="handleAddLeadSubmit(event)">
            <div class="modal-body">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="new-lead-name">Buyer Full Name *</label>
                        <input type="text" class="form-input" id="new-lead-name" placeholder="e.g. Rajesh Khurana" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="new-lead-phone">Phone Number *</label>
                        <input type="tel" class="form-input" id="new-lead-phone" placeholder="98XXXXXXXX" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="new-lead-email">Email Address</label>
                        <input type="email" class="form-input" id="new-lead-email" placeholder="rajesh@example.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="new-lead-source">Lead Source</label>
                        <select class="form-select" id="new-lead-source">
                            <option value="Website">Website</option>
                            <option value="MagicBricks">MagicBricks</option>
                            <option value="99acres">99acres</option>
                            <option value="Housing.com">Housing.com</option>
                            <option value="Referral">Referral</option>
                            <option value="Walk-in">Walk-in</option>
                            <option value="Direct Call">Direct Call</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="new-lead-property">Property Interest</label>
                        <select class="form-select" id="new-lead-property">
                            <option value="Green Valley 3BHK">Green Valley 3BHK (Electronic City)</option>
                            <option value="Skyline Towers 2BHK">Skyline Towers 2BHK (Marathahalli)</option>
                            <option value="Palm Heights 4BHK">Palm Heights 4BHK (Whitefield)</option>
                            <option value="Silver Springs 3BHK">Silver Springs 3BHK (Sarjapur)</option>
                            <option value="Urban Edge 2BHK">Urban Edge 2BHK (HSR Layout)</option>
                            <option value="Prestige Haven Penthouse">Prestige Haven Penthouse (Indiranagar)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="new-lead-budget">Budget Range</label>
                        <input type="text" class="form-input" id="new-lead-budget" placeholder="e.g. ₹75L - ₹90L">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="new-lead-notes">Notes / Buyer Requirement</label>
                    <textarea class="form-textarea" id="new-lead-notes" rows="2" placeholder="e.g. Looking for east-facing, immediate possession, loan pre-approved"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('add-lead-modal')">Cancel</button>
                <button type="submit" class="btn btn-primary">{!! \App\Support\Icon::render('plus', 'icon', 15) !!}<span>Create Lead</span></button>
            </div>
        </form>
    </div>
</div>

<!-- View Lead Detail Modal -->
<div class="modal-overlay" id="view-lead-modal">
    <div class="modal-card modal-card-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="modal-lead-name">Buyer Details</h3>
                <p class="modal-subtitle" id="modal-lead-id">Lead Profile</p>
            </div>
            <button class="modal-close-trigger" onclick="closeModal('view-lead-modal')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="lead-detail-summary-card">
                <div class="lead-detail-row">
                    <div class="lead-detail-item">
                        <span class="detail-label">Phone</span>
                        <span class="detail-value" id="modal-lead-phone">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value" id="modal-lead-email">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Source</span>
                        <span class="detail-value" id="modal-lead-source">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Date Assigned</span>
                        <span class="detail-value" id="modal-lead-date">-</span>
                    </div>
                </div>
            </div>

            <div class="lead-detail-section">
                <h4 class="section-heading">Property & Requirement</h4>
                <div class="lead-detail-row">
                    <div class="lead-detail-item">
                        <span class="detail-label">Interested Property</span>
                        <span class="detail-value" id="modal-lead-prop" style="font-weight: 700; color: var(--navy);">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Budget</span>
                        <span class="detail-value" id="modal-lead-budget" style="font-weight: 700; color: var(--teal-dark);">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value" id="modal-lead-status">-</span>
                    </div>
                </div>
                <div style="margin-top: 0.75rem;">
                    <span class="detail-label">Buyer Notes</span>
                    <div class="detail-notes-box" id="modal-lead-notes">-</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeModal('view-lead-modal')">Close</button>
            <button type="button" class="btn btn-primary" data-toast="Quick follow-up logged">{!! \App\Support\Icon::render('phone', 'icon', 14) !!}<span>Log Call</span></button>
        </div>
    </div>
</div>
@endsection

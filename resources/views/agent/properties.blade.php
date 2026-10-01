@extends('layouts.agent')

@section('content')
<div class="portal-page-container">
    <!-- Page Header -->
    <div class="page-header-row">
        <div class="page-title-group">
            <h1 class="page-heading">Property Portfolio</h1>
            <p class="page-subheading">Manage your assigned properties</p>
        </div>
        <div class="page-actions-group">
            <button class="btn btn-primary" onclick="openModal('submit-property-modal')" title="Submit new property">
                {!! \App\Support\Icon::render('plus', 'icon', 16) !!}
                <span>Submit Property</span>
            </button>
        </div>
    </div>

    <!-- Search & View Toggle Toolbar -->
    <div class="properties-toolbar-row">
        <div class="properties-search-box">
            <span class="properties-search-icon">
                {!! \App\Support\Icon::render('search', 'icon', 16) !!}
            </span>
            <input type="text" id="property-search-input" placeholder="Search properties..." autocomplete="off">
        </div>

        <div class="view-toggle-wrap">
            <button type="button" class="view-toggle-btn is-active" id="view-grid-btn" title="Grid View" onclick="setPropertyView('grid')">
                {!! \App\Support\Icon::render('grid', 'icon', 18) !!}
            </button>
            <button type="button" class="view-toggle-btn" id="view-list-btn" title="List View" onclick="setPropertyView('list')">
                {!! \App\Support\Icon::render('list', 'icon', 18) !!}
            </button>
        </div>
    </div>

    <!-- Properties Grid View -->
    <div class="properties-grid" id="properties-grid-container">
        @foreach($properties as $prop)
        <div class="property-card" 
             data-title="{{ strtolower($prop['title']) }}" 
             data-location="{{ strtolower($prop['location']) }}" 
             data-price="{{ $prop['price_val'] ?? 0 }}"
             data-status="{{ strtolower($prop['status']) }}">
            <div class="prop-card-media">
                <img src="{{ $prop['image'] }}" alt="{{ $prop['title'] }}" class="prop-card-img" loading="lazy">
                
                <!-- Floating Badges on Image -->
                <div class="prop-floating-badges">
                    @php
                        $statusBadgeClass = match(strtolower($prop['status'])) {
                            'active' => 'badge-active',
                            'pending approval' => 'badge-pending',
                            'rejected' => 'badge-rejected',
                            default => 'badge-active'
                        };
                    @endphp
                    <span class="prop-status-badge {{ $statusBadgeClass }}">
                        <span class="badge-dot"></span>
                        <span>{{ $prop['status'] }}</span>
                    </span>

                    @if(!empty($prop['leads_count']))
                        <span class="prop-leads-badge">
                            {{ $prop['leads_count'] }} leads
                        </span>
                    @endif
                </div>
            </div>

            <div class="prop-card-body">
                <div class="prop-title-row">
                    <h3 class="prop-card-title">{{ $prop['title'] }}</h3>
                    <button class="prop-card-menu-btn" data-toast="Options for {{ $prop['title'] }}" title="Options">
                        {!! \App\Support\Icon::render('more-vertical', 'icon', 16) !!}
                    </button>
                </div>

                <div class="prop-location-row">
                    <span class="location-icon">
                        {!! \App\Support\Icon::render('pin', 'icon', 14) !!}
                    </span>
                    <span class="location-text">{{ $prop['location'] }}</span>
                </div>

                <div class="prop-price-row">
                    <span class="price-val">{{ $prop['price'] }}</span>
                </div>

                <div class="prop-specs-row">
                    <div class="spec-item">
                        {!! \App\Support\Icon::render('bed', 'spec-icon', 15) !!}
                        <span>{{ $prop['beds'] }} Beds</span>
                    </div>
                    <div class="spec-item">
                        {!! \App\Support\Icon::render('bath', 'spec-icon', 15) !!}
                        <span>{{ $prop['baths'] }} Baths</span>
                    </div>
                    <div class="spec-item">
                        {!! \App\Support\Icon::render('maximize', 'spec-icon', 15) !!}
                        <span>{{ $prop['sqft'] }}</span>
                    </div>
                </div>

                <div class="prop-card-actions">
                    <button class="btn btn-primary btn-action-half" 
                            onclick="viewPropertyDetails('{{ $prop['id'] }}', '{{ addslashes($prop['title']) }}', '{{ addslashes($prop['location']) }}', '{{ $prop['price'] }}', '{{ $prop['beds'] }} Beds • {{ $prop['baths'] }} Baths • {{ $prop['sqft'] }}', '{{ $prop['status'] }}', '{{ $prop['image'] }}', '{{ $prop['leads_count'] ?? 0 }}')">
                        {!! \App\Support\Icon::render('eye', 'icon', 15) !!}
                        <span>View</span>
                    </button>
                    <button class="btn btn-outline btn-action-half" 
                            onclick="openEditPropertyModal('{{ $prop['id'] }}', '{{ addslashes($prop['title']) }}', '{{ addslashes($prop['location']) }}', '{{ $prop['price'] }}', '{{ $prop['beds'] }}', '{{ $prop['baths'] }}', '{{ $prop['sqft'] }}')">
                        {!! \App\Support\Icon::render('edit', 'icon', 15) !!}
                        <span>Edit</span>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Properties List Table View (Hidden by Default, Toggleable) -->
    <div class="table-card" id="properties-list-container" style="display: none;">
        <div class="table-responsive">
            <table class="leads-table">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Specs</th>
                        <th>Status</th>
                        <th>Active Leads</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $prop)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <img src="{{ $prop['image'] }}" style="width: 44px; height: 44px; border-radius: 8px; object-fit: cover;">
                                <div>
                                    <div style="font-weight: 700; color: var(--text);">{{ $prop['title'] }}</div>
                                    <div style="font-size: 0.7rem; color: var(--text-muted);">{{ $prop['id'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $prop['location'] }}</td>
                        <td style="font-weight: 700; color: var(--navy);">{{ $prop['price'] }}</td>
                        <td>{{ $prop['beds'] }} BHK • {{ $prop['sqft'] }}</td>
                        <td>
                            <span class="status-pill {{ $statusBadgeClass }}">
                                <span class="status-dot"></span>
                                <span>{{ $prop['status'] }}</span>
                            </span>
                        </td>
                        <td>
                            @if(!empty($prop['leads_count']))
                                <span class="prop-leads-badge" style="position: static;">{{ $prop['leads_count'] }} leads</span>
                            @else
                                <span style="color: var(--text-muted); font-size: 0.8rem;">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons-group">
                                <button class="lead-action-btn view-action" onclick="viewPropertyDetails('{{ $prop['id'] }}', '{{ addslashes($prop['title']) }}', '{{ addslashes($prop['location']) }}', '{{ $prop['price'] }}', '{{ $prop['beds'] }} Beds • {{ $prop['baths'] }} Baths • {{ $prop['sqft'] }}', '{{ $prop['status'] }}', '{{ $prop['image'] }}', '{{ $prop['leads_count'] ?? 0 }}')">
                                    {!! \App\Support\Icon::render('eye', 'icon', 14) !!}
                                </button>
                                <button class="lead-action-btn" onclick="openEditPropertyModal('{{ $prop['id'] }}', '{{ addslashes($prop['title']) }}', '{{ addslashes($prop['location']) }}', '{{ $prop['price'] }}', '{{ $prop['beds'] }}', '{{ $prop['baths'] }}', '{{ $prop['sqft'] }}')">
                                    {!! \App\Support\Icon::render('edit', 'icon', 14) !!}
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Submit Property Modal -->
<div class="modal-overlay" id="submit-property-modal">
    <div class="modal-card modal-card-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Submit New Property</h3>
                <p class="modal-subtitle">Add a residential listing to your portfolio for admin verification</p>
            </div>
            <button class="modal-close-trigger" onclick="closeModal('submit-property-modal')">&times;</button>
        </div>
        <form id="submit-prop-form" onsubmit="handleSubmitProperty(event)">
            <div class="modal-body">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Property Title *</label>
                        <input type="text" class="form-input" id="prop-title" placeholder="e.g. Prestige Lakefront 3BHK" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Location / Micro-market *</label>
                        <input type="text" class="form-input" id="prop-location" placeholder="e.g. Bellandur, Bangalore" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Asking Price (₹) *</label>
                        <input type="text" class="form-input" id="prop-price" placeholder="e.g. ₹95 Lakhs" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Carpet / Super Built-up Area *</label>
                        <input type="text" class="form-input" id="prop-sqft" placeholder="e.g. 1,620 sqft" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Bedrooms (BHK)</label>
                        <select class="form-select" id="prop-beds">
                            <option value="1">1 BHK</option>
                            <option value="2">2 BHK</option>
                            <option value="3" selected>3 BHK</option>
                            <option value="4">4 BHK</option>
                            <option value="5">5+ BHK / Penthouse</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bathrooms</label>
                        <select class="form-select" id="prop-baths">
                            <option value="1">1 Bath</option>
                            <option value="2">2 Baths</option>
                            <option value="3" selected>3 Baths</option>
                            <option value="4">4 Baths</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload High-Res Photographs</label>
                    <div class="upload-dropzone" onclick="window.showToast('Select image files to upload')">
                        {!! \App\Support\Icon::render('download', 'upload-icon', 24) !!}
                        <div style="font-weight: 600; font-size: 0.85rem; color: var(--navy);">Click to upload property photos</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">PNG, JPG or WebP up to 10MB</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('submit-property-modal')">Cancel</button>
                <button type="submit" class="btn btn-primary">{!! \App\Support\Icon::render('plus', 'icon', 15) !!}<span>Submit for Approval</span></button>
            </div>
        </form>
    </div>
</div>

<!-- View Property Details Modal -->
<div class="modal-overlay" id="view-property-modal">
    <div class="modal-card modal-card-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="view-modal-prop-title">Property Details</h3>
                <p class="modal-subtitle" id="view-modal-prop-loc">Location</p>
            </div>
            <button class="modal-close-trigger" onclick="closeModal('view-property-modal')">&times;</button>
        </div>
        <div class="modal-body">
            <div class="prop-detail-image-wrap">
                <img id="view-modal-prop-img" src="" alt="Property" style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius-sm);">
            </div>
            <div class="lead-detail-summary-card" style="margin-top: 1rem;">
                <div class="lead-detail-row">
                    <div class="lead-detail-item">
                        <span class="detail-label">Price</span>
                        <span class="detail-value" id="view-modal-prop-price" style="font-weight: 800; color: var(--navy); font-size: 1.15rem;">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Configuration</span>
                        <span class="detail-value" id="view-modal-prop-specs">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value" id="view-modal-prop-status">-</span>
                    </div>
                    <div class="lead-detail-item">
                        <span class="detail-label">Pipeline Leads</span>
                        <span class="detail-value" id="view-modal-prop-leads" style="font-weight: 700; color: #d97706;">-</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeModal('view-property-modal')">Close</button>
            <a href="{{ route('agent.leads') }}" class="btn btn-primary">{!! \App\Support\Icon::render('users', 'icon', 14) !!}<span>View Associated Leads</span></a>
        </div>
    </div>
</div>

<!-- Edit Property Modal -->
<div class="modal-overlay" id="edit-property-modal">
    <div class="modal-card modal-card-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Edit Property Listing</h3>
                <p class="modal-subtitle">Update pricing and details</p>
            </div>
            <button class="modal-close-trigger" onclick="closeModal('edit-property-modal')">&times;</button>
        </div>
        <form onsubmit="handleEditPropertySubmit(event)">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Property Title</label>
                    <input type="text" class="form-input" id="edit-prop-title" required>
                </div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Asking Price</label>
                        <input type="text" class="form-input" id="edit-prop-price" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-input" id="edit-prop-location" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal('edit-property-modal')">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

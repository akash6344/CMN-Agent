// CMNHousing Agent Portal — Client ES Module
document.addEventListener('DOMContentLoaded', () => {
    // Toast system
    const toastEl = document.getElementById('toast');
    let toastTimeout = null;

    window.showToast = (message, type = 'info') => {
        if (!toastEl) return;
        toastEl.textContent = message;
        toastEl.className = `toast is-on toast-${type}`;
        
        if (toastTimeout) clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            toastEl.className = 'toast';
        }, 3200);
    };

    // Generic Toast Triggers
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-toast]');
        if (btn) {
            e.preventDefault();
            const msg = btn.getAttribute('data-toast');
            const type = btn.getAttribute('data-toast-type') || 'info';
            window.showToast(msg, type);
        }
    });

    // Modal helpers
    window.openModal = (modalId) => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeModal = (modalId) => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('is-active');
            document.body.style.overflow = '';
        }
    };

    // Coming Soon Modal Opener
    window.openComingSoon = (featureName = 'This feature') => {
        const titleEl = document.getElementById('coming-soon-title');
        const nameEl = document.getElementById('coming-soon-feature-name');
        
        if (titleEl) titleEl.textContent = `${featureName} — Coming Soon`;
        if (nameEl) nameEl.textContent = featureName;
        
        window.openModal('coming-soon-modal');
    };

    // Close modal on backdrop or close button
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay || e.target.closest('.modal-close-trigger') || e.target.closest('.modal-close-btn')) {
                overlay.classList.remove('is-active');
                document.body.style.overflow = '';
            }
        });
    });

    // Sidebar Mobile & Overlay Controls
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const hamburgerBtn = document.getElementById('mobile-hamburger-btn');
    const sidebarToggleBtn = document.getElementById('sidebar-toggle');

    const openSidebar = () => {
        if (sidebar) sidebar.classList.add('is-open');
        if (sidebarOverlay) sidebarOverlay.classList.add('is-active');
        document.body.style.overflow = 'hidden';
    };

    const closeSidebar = () => {
        if (sidebar) sidebar.classList.remove('is-open');
        if (sidebarOverlay) sidebarOverlay.classList.remove('is-active');
        document.body.style.overflow = '';
    };

    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (sidebar && sidebar.classList.contains('is-open')) closeSidebar();
            else openSidebar();
        });
    }

    if (sidebarToggleBtn) {
        sidebarToggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            closeSidebar();
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // Global Search Filter on Topbar
    const globalSearch = document.getElementById('global-search-input');
    if (globalSearch) {
        globalSearch.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                window.showToast(`Search results for "${globalSearch.value}"`);
            }
        });
    }

    // --------------------------------------------------------------------------
    // LEADS MANAGEMENT SCRIPT
    // --------------------------------------------------------------------------
    const leadSearchInput = document.getElementById('lead-search-input');
    const clearSearchBtn = document.getElementById('clear-search-btn');
    const filterPills = document.querySelectorAll('#lead-filter-pills .filter-pill');
    let currentLeadFilter = 'all';

    function filterLeadsTable() {
        const rows = document.querySelectorAll('#leads-table-body .lead-row');
        const term = leadSearchInput ? leadSearchInput.value.toLowerCase().trim() : '';
        let visibleCount = 0;

        if (clearSearchBtn) {
            clearSearchBtn.style.display = term ? 'block' : 'none';
        }

        rows.forEach(row => {
            const name = row.getAttribute('data-name') || '';
            const prop = row.getAttribute('data-prop') || '';
            const id = row.getAttribute('data-id') || '';
            const status = row.getAttribute('data-status') || '';

            const matchesSearch = !term || name.includes(term) || prop.includes(term) || id.includes(term);
            const matchesFilter = (currentLeadFilter === 'all') || (status === currentLeadFilter);

            if (matchesSearch && matchesFilter) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noMatchEl = document.getElementById('no-leads-match');
        if (noMatchEl) {
            noMatchEl.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }

    if (leadSearchInput) {
        leadSearchInput.addEventListener('input', filterLeadsTable);
    }

    if (clearSearchBtn && leadSearchInput) {
        clearSearchBtn.addEventListener('click', () => {
            leadSearchInput.value = '';
            filterLeadsTable();
            leadSearchInput.focus();
        });
    }

    filterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            filterPills.forEach(p => p.classList.remove('is-active'));
            pill.classList.add('is-active');
            currentLeadFilter = pill.getAttribute('data-filter');
            filterLeadsTable();
        });
    });

    window.resetLeadFilters = () => {
        if (leadSearchInput) leadSearchInput.value = '';
        currentLeadFilter = 'all';
        filterPills.forEach(p => {
            if (p.getAttribute('data-filter') === 'all') p.classList.add('is-active');
            else p.classList.remove('is-active');
        });
        filterLeadsTable();
    };

    window.viewLeadDetails = (id, name, phone, email, prop, notes, budget, status, source, date) => {
        const nameEl = document.getElementById('modal-lead-name');
        const idEl = document.getElementById('modal-lead-id');
        const phoneEl = document.getElementById('modal-lead-phone');
        const emailEl = document.getElementById('modal-lead-email');
        const sourceEl = document.getElementById('modal-lead-source');
        const dateEl = document.getElementById('modal-lead-date');
        const propEl = document.getElementById('modal-lead-prop');
        const budgetEl = document.getElementById('modal-lead-budget');
        const statusEl = document.getElementById('modal-lead-status');
        const notesEl = document.getElementById('modal-lead-notes');

        if (nameEl) nameEl.textContent = name;
        if (idEl) idEl.textContent = `Lead ID: ${id}`;
        if (phoneEl) phoneEl.textContent = phone;
        if (emailEl) emailEl.textContent = email || 'Not provided';
        if (sourceEl) sourceEl.textContent = source;
        if (dateEl) dateEl.textContent = date;
        if (propEl) propEl.textContent = prop;
        if (budgetEl) budgetEl.textContent = budget;
        if (statusEl) statusEl.textContent = status;
        if (notesEl) notesEl.textContent = notes || 'No specific notes recorded.';

        window.openModal('view-lead-modal');
    };

    window.handleAddLeadSubmit = (e) => {
        e.preventDefault();
        const name = document.getElementById('new-lead-name').value;
        const phone = document.getElementById('new-lead-phone').value;
        const email = document.getElementById('new-lead-email').value;
        const property = document.getElementById('new-lead-property').value;
        const budget = document.getElementById('new-lead-budget').value || '₹70L - ₹85L';
        const source = document.getElementById('new-lead-source').value;
        const notes = document.getElementById('new-lead-notes').value || 'Interested in floor plans';

        const tbody = document.getElementById('leads-table-body');
        if (tbody) {
            const newId = `L00${tbody.children.length + 1}`;
            const newRow = document.createElement('tr');
            newRow.className = 'lead-row';
            newRow.setAttribute('data-id', newId.toLowerCase());
            newRow.setAttribute('data-name', name.toLowerCase());
            newRow.setAttribute('data-prop', property.toLowerCase());
            newRow.setAttribute('data-status', 'new');

            newRow.innerHTML = `
                <td class="cell-lead-id"><span class="lead-id-text">${newId}</span></td>
                <td class="cell-buyer">
                    <div class="buyer-info-wrap">
                        <div class="buyer-name">${name}</div>
                        <div class="buyer-meta">${phone}</div>
                        <div class="buyer-meta">${email || 'contact@client.com'}</div>
                    </div>
                </td>
                <td class="cell-prop">
                    <div class="prop-interest-wrap">
                        <div class="prop-title">${property}</div>
                        <div class="prop-note">${notes}</div>
                    </div>
                </td>
                <td class="cell-budget"><span class="budget-tag">${budget}</span></td>
                <td class="cell-status">
                    <span class="status-pill badge-new">
                        <span class="status-dot"></span>
                        <span>New</span>
                    </span>
                </td>
                <td class="cell-source"><span class="source-text">${source}</span></td>
                <td class="cell-date"><span class="date-text">Just now</span></td>
                <td class="cell-actions">
                    <div class="action-buttons-group">
                        <button class="lead-action-btn call-action" data-toast="Initiating call to ${name}..." title="Call">
                            <svg class="icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </button>
                        <button class="lead-action-btn whatsapp-action" data-toast="Opening WhatsApp conversation..." title="WhatsApp">
                            <svg class="icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </button>
                        <button class="lead-action-btn mail-action" data-toast="Opening email composer..." title="Email">
                            <svg class="icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </button>
                        <button class="lead-action-btn view-action" onclick="viewLeadDetails('${newId}', '${name.replace(/'/g, "\\'")}', '${phone}', '${email}', '${property.replace(/'/g, "\\'")}', '${notes.replace(/'/g, "\\'")}', '${budget}', 'New', '${source}', 'Just now')" title="View">
                            <svg class="icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </td>
            `;
            tbody.insertBefore(newRow, tbody.firstChild);
        }

        window.closeModal('add-lead-modal');
        window.showToast(`Lead created for ${name} successfully!`, 'success');
        document.getElementById('add-lead-form').reset();
    };

    // --------------------------------------------------------------------------
    // PROPERTY PORTFOLIO SCRIPT
    // --------------------------------------------------------------------------
    const propertySearchInput = document.getElementById('property-search-input');
    const propertiesGridContainer = document.getElementById('properties-grid-container');
    const propertiesListContainer = document.getElementById('properties-list-container');
    const viewGridBtn = document.getElementById('view-grid-btn');
    const viewListBtn = document.getElementById('view-list-btn');

    window.setPropertyView = (viewType) => {
        if (viewType === 'grid') {
            if (propertiesGridContainer) propertiesGridContainer.style.display = 'grid';
            if (propertiesListContainer) propertiesListContainer.style.display = 'none';
            if (viewGridBtn) viewGridBtn.classList.add('is-active');
            if (viewListBtn) viewListBtn.classList.remove('is-active');
        } else {
            if (propertiesGridContainer) propertiesGridContainer.style.display = 'none';
            if (propertiesListContainer) propertiesListContainer.style.display = 'block';
            if (viewGridBtn) viewGridBtn.classList.remove('is-active');
            if (viewListBtn) viewListBtn.classList.add('is-active');
        }
    };

    if (propertySearchInput) {
        propertySearchInput.addEventListener('input', () => {
            const term = propertySearchInput.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.property-card');
            cards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                const loc = card.getAttribute('data-location') || '';
                if (!term || title.includes(term) || loc.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    window.viewPropertyDetails = (id, title, loc, price, specs, status, img, leadsCount) => {
        const titleEl = document.getElementById('view-modal-prop-title');
        const locEl = document.getElementById('view-modal-prop-loc');
        const priceEl = document.getElementById('view-modal-prop-price');
        const specsEl = document.getElementById('view-modal-prop-specs');
        const statusEl = document.getElementById('view-modal-prop-status');
        const leadsEl = document.getElementById('view-modal-prop-leads');
        const imgEl = document.getElementById('view-modal-prop-img');

        if (titleEl) titleEl.textContent = title;
        if (locEl) locEl.textContent = `${loc} • ID: ${id}`;
        if (priceEl) priceEl.textContent = price;
        if (specsEl) specsEl.textContent = specs;
        if (statusEl) statusEl.textContent = status;
        if (leadsEl) leadsEl.textContent = leadsCount > 0 ? `${leadsCount} Active Leads` : '0 Leads Assigned';
        if (imgEl) imgEl.src = img;

        window.openModal('view-property-modal');
    };

    window.openEditPropertyModal = (id, title, loc, price, beds, baths, sqft) => {
        const titleInput = document.getElementById('edit-prop-title');
        const priceInput = document.getElementById('edit-prop-price');
        const locInput = document.getElementById('edit-prop-location');

        if (titleInput) titleInput.value = title;
        if (priceInput) priceInput.value = price;
        if (locInput) locInput.value = loc;

        window.openModal('edit-property-modal');
    };

    window.handleEditPropertySubmit = (e) => {
        e.preventDefault();
        window.closeModal('edit-property-modal');
        window.showToast('Property listing updated successfully!', 'success');
    };

    window.handleSubmitProperty = (e) => {
        e.preventDefault();
        const title = document.getElementById('prop-title').value;
        window.closeModal('submit-property-modal');
        window.showToast(`Property "${title}" submitted for verification!`, 'success');
        document.getElementById('submit-prop-form').reset();
    };
});

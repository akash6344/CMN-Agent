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
        }, 3000);
    };

    // Generic Toast Triggers
    document.querySelectorAll('[data-toast]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const msg = btn.getAttribute('data-toast');
            const type = btn.getAttribute('data-toast-type') || 'info';
            window.showToast(msg, type);
        });
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
            if (e.target === overlay || e.target.closest('.modal-close-trigger')) {
                overlay.classList.remove('is-active');
                document.body.style.overflow = '';
            }
        });
    });

    // Sidebar Mobile Toggle
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('is-open');
        });
    }

    // Global Search Filter on Dashboard
    const globalSearch = document.getElementById('global-search-input');
    if (globalSearch) {
        globalSearch.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                window.showToast(`Search results for "${globalSearch.value}" (filtered on dashboard)`);
            }
        });
    }
});

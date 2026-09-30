# CMNHousing — Agent Portal

Official Agent Portal for CMNHousing built with **Laravel 12**, **Blade**, **Vite 7**, and **Vanilla CSS**.

---

## 🏛️ Architecture & Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | Laravel 12 (PHP ^8.2) |
| **Templates** | Blade (Server-rendered components & partials) |
| **Styling** | Custom Single CSS Design System (`resources/css/styles.css`) |
| **JavaScript** | Vanilla ES Modules (`resources/js/app.js`) |
| **Build Tool** | Vite 7 (`laravel-vite-plugin`) |
| **Icons & Charts** | Custom Inline SVG helper (`App\Support\Icon`) & SVG chart generators |

---

## 🚀 Key Modules & Pages

1. **Dashboard** (`/agent/dashboard`):
   - Live Negotiations with Smart Bargain deal cards (Buyer Offer, Gap calculation, Seller Ask).
   - Upcoming Site Visits list with status badges & schedule workflow.
   - Monthly bonus target progress & Current Agent Tier indicator.

2. **Lead Management** (`/agent/leads`):
   - Comprehensive data table with masked contact information, property interest, and budget in ₹ Lakh/Crore.
   - Filter tabs (`All`, `New`, `Contacted`, `Visit`, `Deal`, `Closed`) & live search.
   - Instant action triggers: Direct Call, WhatsApp integration, Email composer, and "+ Add Lead" modal.

3. **Property Portfolio** (`/agent/properties`):
   - Card grid with status chips (`Active`, `Pending Approval`, `Rejected`), lead counts, specs (Beds, Baths, Area in sqft).
   - Grid / List view toggle and "+ Submit Property" modal.

4. **Earnings & Commission** (`/agent/earnings`):
   - Stat overview: Total Earned, Pending Payout, Deals Closed, Avg Commission per deal.
   - SVG Bar Chart of monthly earnings with hover tooltips.
   - Commission Summary card with Base Rate (0.6%), Bonus Rate (+0.1%), and Silver Tier progress.
   - Transaction History table with payout status (`Paid`, `Processing`, `Pending`).

5. **Smart Bargain Desk** (`/agent/bargain`):
   - Sweet-spot counter-offer calculator, active negotiation sessions, and closing pipeline tracker.

6. **Site Visits** (`/agent/visits`):
   - Property tour coordinator with map sending and visit completion actions.

7. **Performance Analytics** (`/agent/analytics`):
   - Lead conversion funnel, closing ratios, deal velocity, and SVG acquisition channel donut chart.

---

## 🛠️ Local Development Setup

```bash
# 1. Install Composer dependencies
composer install

# 2. Setup environment and generate app key
cp .env.example .env
php artisan key:generate

# 3. Install NPM dependencies & build assets
npm install
npm run build

# 4. Start Laravel local server
php artisan serve
```

Run test suite:
```bash
php artisan test
```

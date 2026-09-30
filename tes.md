# CMNHousing — Architecture & Design Requirements

**Purpose:** Hand this file to Antigravity (or any AI builder) so a **new product for the same company** is built with the **same tech stack, architecture, and design system** as the existing CMNHousing Builder Portal.

**Reference product:** CMNHousing · Builder Portal (Laravel 12 + Blade + Vite)

---

## 0. Non-negotiable stack (do not substitute)

| Layer | Must use | Do **not** use |
|--------|----------|----------------|
| Backend | **Laravel 12**, PHP **^8.2** | Next.js, Node API, Django, Rails |
| Templates | **Blade** (server-rendered) | Vue, React, Inertia, Livewire, Alpine as the page framework |
| Assets | **Vite 7** + `laravel-vite-plugin` | Webpack-only, CDN CSS frameworks as the system |
| JS | **Vanilla ES modules** (`resources/js/app.js`) for UI behavior | SPA frameworks, heavy state libraries |
| CSS | **One custom stylesheet** with CSS variables (`resources/css/styles.css`) | Tailwind, Bootstrap, shadcn, Material, CSS-in-JS |
| Icons | Inline SVG helper (stroke, `currentColor`, 24×24) | Icon font packs as primary |
| Charts | Custom SVG helpers + Blade partials | Chart.js / Recharts unless explicitly requested later |
| Data | Controllers → arrays / Eloquent → Blade | REST-only SPA with separate frontend app |
| Auth (later) | Laravel session / web guard | Clerk, Auth0, NextAuth as default |

**Product shape:** Builder / partner **portal** (admin-style shell) + optional **public project preview** (consumer site layout).

---

## 1. Product context

Build a sibling CMNHousing experience for the same company (Indian real-estate / housing). Domain language to preserve:

- RERA, BHK, carpet vs built-up area
- Pricing in **₹ Lakh / Crore**
- Possession dates, towers, units, land area
- **Smart Bargain** (min / target / max negotiated price band)
- Lead pipeline: New → Contacted → Site Visit (and similar)
- Project workflow: `draft` → `under_review` → `published` / `archived`

Demo org persona pattern: builder name + role (e.g. “Premium Partner”) + initials avatar in the sidebar foot.

---

## 2. Architecture to mirror

```
Browser (Blade + vanilla JS)
    │
    ├─ GET pages ──► Http/Controllers/... ──► Support demo data and/or Eloquent
    │                      │
    │                      └─► layouts.* + views + partials
    │
    └─ POST JSON / multipart ──► Wizard (or feature) controller
                                   └─► Models + Storage disk('public')
```

### 2.1 Folder conventions

```
app/
  Http/Controllers/<Area>/     # e.g. Builder/
  Models/                      # Eloquent
  Support/                     # Demo*Data, Icon, ChartHelper (static helpers)
resources/
  css/styles.css               # Entire design system
  js/app.js                    # Sidebar, modals, toasts, wizard AJAX
  views/
    layouts/                   # builder.blade.php, site.blade.php
    <area>/                    # pages
    <area>/partials/           # reusable UI slices
routes/web.php                 # Named web routes (no SPA router)
database/migrations/           # Eloquent tables when persisting
```

### 2.2 Request / page pattern

1. Named route in `routes/web.php`
2. Controller method loads data (`Demo*Data` and/or Eloquent)
3. Pass at least: `pageTitle`, `pageSub`, `active` (sidebar highlight), plus page payload
4. View `@extends('layouts.builder')` (or `layouts.site`) and `@include` partials
5. Incomplete actions may use toast stubs (`data-toast="…"`) instead of full backends

### 2.3 Layouts

**`layouts.builder` (portal shell)**

- Sticky navy sidebar: brand mark, main nav, foot nav, org card
- Topbar: menu toggle, `pageTitle` + `pageSub`, global search, primary CTA, notifications icon + badge
- Main `@yield('content')`
- Global `#modal` backdrop + `#toast`
- CSRF meta: `<meta name="csrf-token" content="{{ csrf_token() }}">`
- Vite: `@vite(['resources/css/styles.css', 'resources/js/app.js'])`

**`layouts.site` (public / consumer)**

- Lighter marketing header (Buy / Rent / New Projects style)
- Used for project listing preview, not the portal chrome

### 2.4 Persistence strategy (match existing hybrid)

| Area | Pattern |
|------|---------|
| Most dashboard screens | Demo data class (`App\Support\Demo*Data`) until MySQL is ready |
| Core create flows (e.g. multi-step wizard) | Real Eloquent + file uploads |
| Lists that mix both | Eloquent rows **prepended** to demo rows is acceptable |

Wizard / multi-step saves: JSON `fetch` POSTs with `X-CSRF-TOKEN`, Laravel `$request->validate()`, return JSON. File uploads: `multipart/form-data` → `Storage::disk('public')`.

### 2.5 Models pattern (when DB-backed)

Example domain from reference portal (adapt names if product differs, keep pattern):

- Parent entity (`ProjectDetail`) `hasMany` units, media, documents; optional `belongsTo` User
- Status accessors: `status_label`, `status_class`, currency label helpers
- Media categories and document types as constrained string enums
- Review gate before publish

---

## 3. Design system (must match visually)

### 3.1 Brand tokens (copy into `:root`)

```css
:root {
  --navy: #131d34;
  --navy-mid: #1a2744;
  --navy-hover: #243354;
  --teal: #30b5a6;
  --teal-dark: #2a9d90;
  --page: #f6f7f9;

  --white: #ffffff;
  --text: #1a2438;
  --text-secondary: #5b6578;
  --text-muted: #8a94a6;
  --border: #e6eaf0;
  --border-strong: #d5dbe6;

  --success: #22c55e;
  --success-bg: #ecfdf3;
  --danger: #ef4444;
  --danger-bg: #fef2f2;
  --warning: #f59e0b;
  --warning-bg: #fffbeb;
  --info: #3b82f6;
  --info-bg: #eff6ff;

  --teal-soft: #e7f7f5;
  --teal-softer: #f3fbfa;
  --mint: #d1fae5;
  --lavender-bg: #eef2ff;
  --sky-bg: #e0f2fe;
  --peach-bg: #ffedd5;

  --sidebar-w: 248px;
  --sidebar-collapsed: 76px;
  --header-h: 76px;
  --radius: 16px;
  --radius-sm: 10px;
  --radius-xs: 8px;
  --shadow: 0 1px 2px rgba(19, 29, 52, 0.04), 0 8px 24px rgba(19, 29, 52, 0.04);
  --shadow-lg: 0 16px 40px rgba(19, 29, 52, 0.12);
  --font: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  --ease: 0.2s ease;
}
```

**Look:** Navy sidebar + light gray page + teal primary CTAs. Soft white cards, 16px radius, navy-tinted shadows. **Avoid** purple gradients, cream/serif “AI landing” looks, dark-mode-first themes, glow effects, pill spam.

### 3.2 UI primitives to implement as CSS + Blade partials

| Primitive | Classes / notes |
|-----------|-----------------|
| Buttons | `.btn`, `.btn-primary`, `.btn-outline`, `.btn-ghost`, `.btn-warning`, `.btn-sm`, `.btn-block` |
| Cards | `.card` + domain cards (`stat-card`, `project-card`, `lead-card`, …) |
| Chips | `.chip` + status modifiers (live, hold, new, counter, …) |
| Stats | `.stat-grid` + tone icon wells (`icon-mint`, `icon-sky`, `icon-peach`, …) |
| Metrics | `.metric-grid` / metric cards |
| Forms | `.form-grid`, `.form-grid-2`, `.field`, shared `form-field` partial |
| Tables | `.table-wrap` + `.data-table` + row partials |
| Toolbar | `.page-toolbar`, search, `.status-tabs` / `.status-tab.is-active` |
| Icon buttons | `.icon-btn` + `.badge-count` |
| Feedback | Toast (`.toast.is-on`), modal backdrop, coming-soon centered card |

### 3.3 Composition rules

1. Pages are **thin**; UI is composed from **partials**.
2. Every portal page has **title + subtitle** in the topbar.
3. List pages follow: **toolbar (search + status tabs + primary action) → cards/table**.
4. Unfinished nav destinations use a **coming-soon** page (clock icon + short copy), not broken links.
5. Motion: short CSS transitions (`--ease`); no heavy animation libraries.
6. Responsive: collapse sidebar to overlay on smaller breakpoints (~980 / 720 / 640).
7. Focus ring: teal (`:focus-visible`).
8. Empty media / upload zones: dashed borders, clear affordance.

---

## 4. Reference screen inventory (design + build against this IA)

Mirror this information architecture unless the new product’s scope explicitly differs. Keep the **same shell** even if some screens start as demo/coming-soon.

### Builder portal nav

| ID | Label | Typical content |
|----|-------|-----------------|
| overview | Overview | Stat grid, hot units, recent leads, activity feed, deal cards |
| projects | Projects | Grid/list of projects, status chips, Add Project |
| listings | Listings | Unit inventory table / rows |
| leads | Leads | Lead table + status tabs |
| bargain | Smart Bargain | Coming soon **or** bargain inbox when ready |
| ads | Ads & Promotions | Campaign cards + ad metrics |
| analytics | Analytics | SVG area/bar/donut charts + legends |
| documents | Documents | Compliance banner + document cards |
| notifications | Notifications (foot) | Filterable notification cards |
| settings | Settings (foot) | Tabbed profile / company / preferences (toggles) |

### Core real flow to design carefully: Post Project wizard

5 steps with horizontal stepper + sticky aside (tips, live preview, bargain, promo):

1. **Basic Details** — name, tagline, builder, location, maps, type, status, possession, RERA, towers, units, land, description, highlights  
2. **Units & Pricing** — unit cards + Smart Bargain min/target/max  
3. **Amenities** — checkbox grid + “Other”  
4. **Media & Plans** — photos, floor plans, docs, video / virtual tour URLs  
5. **Review & Submit** — terms → submit for review → redirect to projects  

Wizard JSON endpoints pattern: `/builder/projects/wizard/{basic|units|amenities|media|upload|draft|submit}` (+ GET show).

### Public surface

- Project preview page: hero/gallery, RERA / Smart Bargain badges, BHK panels, amenities, enquire CTAs (toasts OK for stubs).

---

## 5. Implementation instructions for Antigravity

### Phase A — Shell & design system (start here)

1. Scaffold Laravel 12 + Vite; wire `styles.css` + `app.js`.
2. Implement CSS tokens and primitives from §3.
3. Build `layouts.builder` + sidebar + topbar + toast/modal.
4. Wire named routes + empty/demo pages for each nav item so navigation works end-to-end.
5. Build reusable partials: `stat-card`, `form-field`, `status-tabs`, `toolbar-search`, row/card variants as needed.

### Phase B — High-fidelity screens (demo data)

1. `Demo*Data` support class with `shell()` (builder + navItems + footItems) and per-page methods.
2. Fill Overview, Projects, Listings, Leads, Ads, Analytics, Documents, Notifications, Settings with demo arrays.
3. Match navy/teal visual density of the reference portal (soft cards, tone icons, chips).

### Phase C — Persisted wizard (if product includes posting)

1. Migrations + Eloquent models for parent + units + media + documents.
2. Blade wizard UI + vanilla JS step navigation and live preview.
3. JSON save endpoints + multipart upload + draft + submit-for-review.
4. Public preview layout consuming real or demo project payload.

### Phase D — Auth & MySQL

1. Replace demo data gradually with Eloquent.
2. Add session auth + middleware; bind `user_id` on owned records.
3. Prefer MySQL in production; SQLite is fine for local scaffold.

---

## 6. Tooling & quality bar

- Editor: 4-space indent, UTF-8, LF (`.editorconfig`)
- PHP: Laravel Pint; tests with PHPUnit Feature/Unit as features land
- No requirement for ESLint/Prettier unless you add a larger JS surface
- Local run: `composer install` → `.env` + `key:generate` → `npm install` → `npm run build` → `php artisan serve`  
  Dev HMR: `npm run dev` + `php artisan serve` (or `composer dev`)
- README must document stack as **Laravel + Blade + Vite** (not a React app)

---

## 7. Deliverables checklist for Antigravity

Produce, in order:

- [ ] Working Laravel 12 app with Vite assets
- [ ] Design tokens + portal shell matching navy/teal system
- [ ] All nav routes reachable (real UI or coming-soon)
- [ ] Partial-based pages (not one-off monolithic markup)
- [ ] Demo data layer for non-persisted screens
- [ ] (If in scope) 5-step project wizard with JSON APIs + uploads
- [ ] (If in scope) Public project preview layout
- [ ] README with setup matching this stack

---

## 8. Prompt snippet (paste into Antigravity)

```text
Build a new CMNHousing product for the same company using the architecture
and design system in ANTIGRAVITY_REQUIREMENTS.md.

Hard constraints:
- Laravel 12 + Blade + Vite 7 + vanilla JS
- Single custom CSS file with the exact navy/teal tokens
- No React, Vue, Inertia, Livewire, or Tailwind
- Portal shell: navy sidebar + topbar + toast/modal
- Pages via controllers + Blade partials + Demo*Data (Eloquent for wizard)

Start with Phase A (shell + design system), then Phase B screens.
Match Indian real-estate domain language (RERA, BHK, ₹ L/Cr, Smart Bargain).
```

---

## 9. What “same architecture” means in one sentence

**Server-rendered Laravel Blade portal, navy/teal custom CSS design system, controller-fed demo or Eloquent data, vanilla JS for interactions, and a dual layout (builder portal + public site preview)—not a React SPA.**

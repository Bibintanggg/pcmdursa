<aside class="sidebar font-sans min-h-screen sticky" id="sidebar" >
    <div class="toggle-btn" onclick="toggleSidebar()">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M7.5 2L3.5 6L7.5 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    {{-- LOGO --}}
    <div class="logo">
        <div class="logo-icon">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                <rect x="2" y="2" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.9"/>
                <rect x="10" y="2" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.5"/>
                <rect x="2" y="10" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.5"/>
                <rect x="10" y="10" width="6" height="6" rx="1.5" fill="white" fill-opacity="0.9"/>
            </svg>
        </div>
        <div class="logo-text">
            <h1>PCM Duren Sawit 01</h1>
            <p>Admin Panel</p>
        </div>
    </div>

    {{-- NAV --}}
    <nav>
        <div class="section-label">Menu</div>

        <a href="/admin/dashboard" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-label="Dashboard">
            <div class="nav-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <rect x="1.5" y="1.5" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
                    <rect x="9" y="1.5" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
                    <rect x="1.5" y="9" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
                    <rect x="9" y="9" width="5.5" height="5.5" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
                </svg>
            </div>
            <span class="nav-label">Dashboard</span>
        </a>

        {{-- DROPDOWN PROFILE --}}
        <div class="dropdown" x-data="{ open: {{ request()->routeIs('admin.profile-organisasi*') || request()->routeIs('admin.kelola-organisasi*') ? 'true' : 'false' }} }">
            <div class="dropdown-toggle nav-item" @click="open = !open" :class="{ 'active': open }" data-label="Profile">
                <div class="nav-icon">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="5.5" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                        <path d="M2.5 13.5C2.5 11.015 5.015 9 8 9C10.985 9 13.5 11.015 13.5 13.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="nav-label">Profile</span>
                <svg class="dropdown-arrow" :class="{ 'rotate': open }" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M3 4.5L6 7.5L9 4.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="dropdown-menu" x-show="open" x-collapse>
                <a href="/admin/profile-organisasi" class="dropdown-item {{ request()->routeIs('admin.profile-organisasi') ? 'active' : '' }}">
                    <span>Profile Organisasi</span>
                </a>
                <a href="/admin/struktur-organisasi" class="dropdown-item {{ request()->routeIs('admin.struktur-organisasi') ? 'active' : '' }}">
                    <span>Struktur Organisasi</span>
                </a>
            </div>
        </div>

        <a href="/admin/articles" class="nav-item {{ request()->routeIs('admin.articles') ? 'active' : '' }}" data-label="Artikel">
            <div class="nav-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M8 1.5V3M8 13V14.5M14.5 8H13M3 8H1.5M12.95 3.05L11.89 4.11M4.11 11.89L3.05 12.95M12.95 12.95L11.89 11.89M4.11 4.11L3.05 3.05" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="nav-label">Artikel</span>
        </a>



        <a href="/admin/berita" class="nav-item {{ request()->routeIs('admin.berita') ? 'active' : '' }}" data-label="Berita">
            <div class="nav-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <rect x="1.5" y="2.5" width="13" height="11" rx="1.5" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M4.5 5.5H11.5M4.5 8H9M4.5 10.5H7.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="nav-label">Berita</span>
        </a>

        <a href="#" class="nav-item {{ request()->routeIs('program') ? 'active' : '' }}" data-label="Program">
            <div class="nav-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 1.5L9.545 5.635L14 6.09L10.75 9.08L11.705 13.5L8 11.27L4.295 13.5L5.25 9.08L2 6.09L6.455 5.635L8 1.5Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="nav-label">Program</span>
        </a>
    </nav>

    {{-- FOOTER USER --}}
    <div class="sidebar-footer">
        <div class="user-card">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'Ad', 0, 2)) }}</div>
            <div class="user-info">
                <p>{{ auth()->user()->name ?? 'Admin' }}</p>
                <p>{{ auth()->user()->email ?? 'admin@mail.com' }}</p>
            </div>
        </div>
    </div>
</aside>

{{-- OVERLAY (mobile) --}}
<div id="overlay" class="overlay" onclick="toggleSidebar()"></div>

<style>
    .sidebar {
        width: 240px;
        min-width: 240px;
        background: #fff;
        border-right: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        transition: width 0.3s cubic-bezier(.4,0,.2,1), min-width 0.3s cubic-bezier(.4,0,.2,1);
        overflow: hidden;
        position: sticky;
    }

    .sidebar.collapsed {
        width: 60px;
        min-width: 60px;
    }

    /* TOGGLE */
    .toggle-btn {
        position: absolute;
        top: 18px;
        right: -11px;
        width: 22px;
        height: 22px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        transition: transform 0.3s ease, background 0.15s;
        z-index: 10;
    }

    .toggle-btn:hover {
        background: #f8fafc;
        color: #334155;
    }

    .sidebar.collapsed .toggle-btn {
        transform: rotate(180deg);
    }

    /* LOGO */
    .logo {
        height: 58px;
        display: flex;
        align-items: center;
        padding: 0 14px;
        gap: 10px;
        border-bottom: 1px solid #f1f5f9;
        flex-shrink: 0;
    }

    .logo-icon {
        width: 32px;
        height: 32px;
        background: #059669;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .logo-text {
        overflow: hidden;
        white-space: nowrap;
        transition: opacity 0.2s;
    }

    .logo-text h1 {
        font-size: 13px;
        font-weight: 600;
        color: #0f172a;
    }

    .logo-text p {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 1px;
    }

    .sidebar.collapsed .logo-text {
        opacity: 0;
        pointer-events: none;
    }

    /* NAV */
    nav {
        flex: 1;
        padding: 10px 8px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .section-label {
        font-size: 10px;
        font-weight: 600;
        color: #cbd5e1;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        padding: 10px 8px 4px;
        white-space: nowrap;
        overflow: hidden;
        transition: opacity 0.2s;
    }

    .sidebar.collapsed .section-label {
        opacity: 0;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 8px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
        overflow: hidden;
        position: relative;
        margin-bottom: 1px;
        text-decoration: none;
    }

    .nav-item:hover {
        background: #f8fafc;
    }

    .nav-item.active {
        background: #ecfdf5;
    }

    .sidebar.collapsed .nav-item {
        justify-content: center;
        padding: 8px 0;
    }

    .nav-icon {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background 0.15s;
        color: #94a3b8;
    }

    .nav-item:hover .nav-icon {
        background: #f1f5f9;
        color: #334155;
    }

    .nav-item.active .nav-icon {
        background: #d1fae5;
        color: #059669;
    }

    .nav-label {
        font-size: 13px;
        font-weight: 400;
        color: #64748b;
        overflow: hidden;
        flex: 1;
        transition: opacity 0.2s, color 0.15s;
    }

    /* DROPDOWN STYLES */
    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        justify-content: space-between;
    }

    .dropdown-arrow {
        transition: transform 0.2s ease;
        color: #94a3b8;
        flex-shrink: 0;
    }

    .dropdown-arrow.rotate {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        overflow: hidden;
        padding-left: 28px;
        margin-top: 2px;
        margin-bottom: 2px;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 8px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        color: #64748b;
        transition: background 0.15s, color 0.15s;
        white-space: nowrap;
    }

    .dropdown-item:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .dropdown-item.active {
        background: #ecfdf5;
        color: #059669;
        font-weight: 500;
    }

    .sidebar.collapsed .dropdown {
        position: relative;
    }

    .sidebar.collapsed .dropdown-toggle .nav-label,
    .sidebar.collapsed .dropdown-arrow {
        display: none;
    }

    .sidebar.collapsed .dropdown-menu {
        position: absolute;
        left: 50px;
        top: 0;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 4px;
        min-width: 160px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        z-index: 100;
    }

    .sidebar.collapsed .dropdown-menu .dropdown-item {
        white-space: nowrap;
        padding: 8px 12px;
    }

    .nav-item.active .nav-label {
        color: #059669;
        font-weight: 500;
    }

    .nav-item:hover .nav-label {
        color: #0f172a;
    }

    .sidebar.collapsed .nav-label {
        opacity: 0;
        width: 0;
    }

    .badge {
        font-size: 10px;
        font-weight: 500;
        background: #d1fae5;
        color: #065f46;
        padding: 2px 6px;
        border-radius: 20px;
        flex-shrink: 0;
        transition: opacity 0.2s;
    }

    .sidebar.collapsed .badge {
        display: none;
    }

    .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #059669;
        flex-shrink: 0;
    }

    .sidebar.collapsed .dot {
        display: none;
    }

    /* Tooltip saat collapsed */
    .sidebar.collapsed .nav-item::after {
        content: attr(data-label);
        position: absolute;
        left: 50px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        padding: 5px 10px;
        font-size: 12px;
        color: #0f172a;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.15s;
        z-index: 100;
    }

    .sidebar.collapsed .nav-item:hover::after {
        opacity: 1;
    }

    .divider {
        height: 1px;
        background: #f1f5f9;
        margin: 6px 4px;
    }

    /* FOOTER */
    .sidebar-footer {
        padding: 8px;
        border-top: 1px solid #f1f5f9;
        flex-shrink: 0;
    }

    .user-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 8px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.15s;
        overflow: hidden;
    }

    .user-card:hover {
        background: #f8fafc;
    }

    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #d1fae5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 500;
        color: #059669;
        flex-shrink: 0;
    }

    .user-info {
        overflow: hidden;
        transition: opacity 0.2s;
    }

    .user-info p:first-child {
        font-size: 13px;
        font-weight: 500;
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-info p:last-child {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar.collapsed .user-info {
        opacity: 0;
        width: 0;
    }

    /* OVERLAY mobile */
    .overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 40;
    }

    .overlay.active {
        display: block;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            z-index: 50;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .toggle-btn {
            display: none;
        }
    }
</style>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        } else {
            sidebar.classList.toggle('collapsed');
        }
    }
</script>

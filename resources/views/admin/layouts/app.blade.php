<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
 /* public/css/app.css */

/* == VARIABLES & GLOBAL STYLES == */
:root {
    --orange: #f97316;
    --orange-dark: #ea580c;
    --dark-blue: #0f172a; 
    --slate: #475569;
    --slate-light: #94a3b8;
    --bg-main: #f1f5f9; 
    --white: #ffffff;
    --sidebar-width: 260px;
    --default-border-radius: 1rem;
    --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
body {
    background-color: var(--bg-main);
    font-family: 'Poppins', sans-serif;
    color: var(--dark-blue);
}

/* == SIDEBAR STYLES == */
.sidebar {
    width: var(--sidebar-width);
    background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%);
    color: var(--white);
    padding: 1.5rem 1rem;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 1100;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #e2e8f0;
}
.sidebar-nav {
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
}
.sidebar-mobile { 
    background-color: var(--orange); 
    color: var(--white); 
}
.sidebar-mobile .btn-close { 
    filter: invert(1) grayscale(100%) brightness(200%); 
}
.sidebar-nav .logo { 
    font-weight: 700; 
    font-size: 1.8rem; 
    text-align: center; 
    margin-bottom: 2rem;
    letter-spacing: 1px; 
    color: var(--white); 
    flex-shrink: 0;
}
.sidebar-nav .nav {
    flex-shrink: 0;
}
.sidebar-nav .nav-link {
    color: rgba(255, 255, 255, 0.85);
    padding: 0.7rem 1.2rem;
    margin-bottom: 0.3rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    font-weight: 500;
    font-size: 0.9rem;
    transition: var(--default-transition);
}
.sidebar-nav .nav-link i { 
    margin-right: 1rem; 
    font-size: 1.2rem;
}
.sidebar-nav .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: var(--white);
}
.sidebar-nav .nav-link.active {
    background-color: var(--white);
    color: var(--orange-dark);
    font-weight: 600;
}
.sidebar-nav .user-profile {
    margin-top: auto;
    background-color: rgba(0,0,0,0.15);
    padding: 1rem;
    border-radius: var(--default-border-radius);
    flex-shrink: 0;
}

/* == MAIN WRAPPER & HEADER == */
.main-wrapper {
    flex-grow: 1;
    overflow-y: auto;
}
@media (min-width: 992px) {
    .main-wrapper { 
        margin-left: var(--sidebar-width); 
    }
}
.main-header {
    background-color: var(--white);
    padding: 1.5rem 2.5rem;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 1000;
}
.main-header .h2 { 
    color: var(--dark-blue); 
}
.main-content {
    padding: 2.5rem;
}

/* == COMPONENT: CARDS == */
.card-base {
    background-color: var(--white);
    border-radius: var(--default-border-radius);
    padding: 2rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03);
    transition: var(--default-transition);
}
.card-base:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07);
}
.stat-card .icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: var(--white);
    background-image: linear-gradient(135deg, var(--color-from) 0%, var(--color-to) 100%);
    box-shadow: 0 4px 12px -2px var(--color-to);
}
.stat-card h3 {
    font-weight: 700;
    color: var(--dark-blue);
    font-size: 2.25rem;
}
.stat-card small {
    color: var(--slate);
    font-weight: 500;
}
.stat-card .percentage { 
    font-size: 0.9rem; 
}
.activity-card {
    color: white;
    background-image: linear-gradient(135deg, var(--orange-dark) 0%, var(--orange) 100%);
}
.activity-item { 
    display: flex; 
    align-items: flex-start; 
    margin-bottom: 1.5rem; 
}
.activity-item:last-child { 
    margin-bottom: 0; 
}
.activity-item .icon { 
    background-color: rgba(255,255,255,0.15); 
    width: 45px; 
    height: 45px; 
    border-radius: 0.75rem; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    margin-right: 1rem; 
    flex-shrink: 0; 
}
.activity-list-wrapper { 
    overflow-y: auto; 
    flex-grow: 1; 
    padding-right: 10px; 
}
.activity-list-wrapper::-webkit-scrollbar { 
    width: 6px; 
}
.activity-list-wrapper::-webkit-scrollbar-track { 
    background: rgba(0,0,0,0.1); 
    border-radius: 3px; 
}
.activity-list-wrapper::-webkit-scrollbar-thumb { 
    background: rgba(255,255,255,0.4); 
    border-radius: 3px; 
}

/* == COMPONENT: TABLES == */
.table-custom { 
    border-collapse: separate;
    border-spacing: 0 1rem;
    margin-top: -1rem;
}
.table-custom thead th {
    border: none;
    font-weight: 600;
    color: var(--slate-light);
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.8px;
    padding: 1rem 1.5rem;
}
.table-custom tbody tr {
    background-color: var(--white);
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    transition: var(--default-transition);
}
.table-custom tbody tr:hover {
    transform: translateY(-4px);
    box-shadow: 0 7px 14px 0 rgb(0 0 0 / 0.07), 0 3px 6px 0 rgb(0 0 0 / 0.05);
}
.table-custom tbody td {
    border: none;
    padding: 1.25rem 1.5rem;
    vertical-align: middle;
}
.table-custom tbody td:first-child { 
    border-top-left-radius: 0.75rem; 
    border-bottom-left-radius: 0.75rem; 
}
.table-custom tbody td:last-child { 
    border-top-right-radius: 0.75rem; 
    border-bottom-right-radius: 0.75rem; 
}
.table-custom .badge { 
    padding: 0.5em 0.9em; 
    font-weight: 500; 
    font-size: 0.8rem; 
}
.table-custom .btn { 
    border-radius: 0.5rem; 
}
    </style>
</head>
<body>
    <div class="admin-layout d-flex">
        
        <div class="d-none d-lg-flex">
             @include('admin.partials.sidebar')
        </div>

        <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
            <div class="offcanvas-body p-0">
                @include('admin.partials.sidebar')
            </div>
        </div>

        <div class="w-100">
            <nav class="navbar d-lg-none navbar-mobile">
                <div class="container-fluid">
                    <button class="btn btn-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="logo text-orange" style="color: var(--orange); font-weight: bold;">Job Recruitment</div>
                </div>
            </nav>

            <main class="main-wrapper">
                @yield('content')
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
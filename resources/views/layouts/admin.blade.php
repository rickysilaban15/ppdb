<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin PPDB') - SMK N 2 Siatas Barita</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --gold: #D4AF37;
            --gold-light: #F7EF8A;
            --gold-dark: #B8941F;
            --burgundy: #800020;
            --burgundy-light: #A52C4A;
            --burgundy-dark: #5D0016;
            --charcoal: #2C2C2C;
            --charcoal-light: #3C3C3C;
            --sidebar-bg: linear-gradient(180deg, #2C001E 0%, #4B0035 100%);
            --card-bg: #fff;
            --border-gold: 2px solid var(--gold);
            --text-white: #ffffff;
            --text-dark: #2C2C2C;
            --shadow: 0 4px 20px rgba(0,0,0,0.1);
            --shadow-gold: 0 0 15px rgba(212, 175, 55, 0.3);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: var(--text-dark);
            overflow-x: hidden;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            color: #e0e0e0;
        }

        body.dark-mode .stat-card,
        body.dark-mode .navbar-premium,
        body.dark-mode .card,
        body.dark-mode .table {
            background-color: #2d2d2d;
            color: #e0e0e0;
        }

        body.dark-mode .page-header {
            border-bottom-color: #444;
        }

        body.dark-mode .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Enhanced Loading Spinner */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(44, 0, 30, 0.95) 0%, rgba(75, 0, 53, 0.95) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader {
            width: 80px;
            height: 80px;
            border: 6px solid rgba(212, 175, 55, 0.2);
            border-radius: 50%;
            border-top-color: var(--gold);
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
            filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.5));
        }

        .loader-text {
            color: var(--gold);
            margin-top: 20px;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Enhanced Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: all var(--transition-speed) cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1050;
            border-right: 1px solid rgba(255,255,255,0.1);
            padding-top: 1rem;
            transform: translateX(-100%);
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
        }

        #sidebar.mobile-show {
            transform: translateX(0);
        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        #sidebar.collapsed .sidebar-brand span,
        #sidebar.collapsed .sidebar-subtitle,
        #sidebar.collapsed .sidebar-menu a span,
        #sidebar.collapsed .sidebar-menu .badge {
            display: none;
        }

        #sidebar.collapsed .sidebar-menu a {
            justify-content: center;
            padding: 14px 0;
        }

        #sidebar.collapsed .sidebar-menu i {
            margin-right: 0;
            font-size: 1.4rem;
        }

        #sidebar.collapsed .sidebar-header {
            padding: 1.5rem 0;
            text-align: center;
        }

        .sidebar-header {
            padding: 1.5rem 1.5rem 1rem;
            text-align: center;
            border-bottom: var(--border-gold);
            transition: all var(--transition-speed) ease;
            position: relative;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
        }

        .sidebar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--gold) !important;
            text-decoration: none;
            display: block;
            letter-spacing: 1px;
            transition: all var(--transition-speed) ease;
            text-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
        }

        .sidebar-brand i {
            display: inline-block;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .sidebar-brand:hover {
            transform: scale(1.08);
            text-shadow: 0 4px 20px rgba(212, 175, 55, 0.6);
        }

        .sidebar-subtitle {
            font-size: 0.9rem;
            color: var(--gold-light);
            margin-top: 0.25rem;
            transition: all var(--transition-speed) ease;
            opacity: 0.9;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1.5rem 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 8px 12px;
            position: relative;
        }

        .sidebar-menu a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            border-radius: 12px;
            transition: all var(--transition-speed) cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
            font-weight: 500;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .sidebar-menu a:hover::before {
            left: 100%;
        }

        .sidebar-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: all var(--transition-speed) ease;
            transform: translateX(-50%);
        }

        .sidebar-menu a:hover::after,
        .sidebar-menu a.active::after {
            width: 80%;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.15);
            color: var(--gold);
            border-color: var(--gold);
            transform: translateX(5px) scale(1.02);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.1) 100%);
            color: #FFF;
            font-weight: 600;
        }

        .sidebar-menu i {
            width: 28px;
            margin-right: 14px;
            text-align: center;
            font-size: 1.2rem;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-menu a:hover i,
        .sidebar-menu a.active i {
            transform: scale(1.3) rotate(5deg);
            filter: drop-shadow(0 0 5px rgba(212, 175, 55, 0.5));
        }

        .sidebar-menu .badge {
            margin-left: auto;
            background: var(--gold);
            color: #2C001E;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 5px 10px;
            border-radius: 20px;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .sidebar-menu a:hover .badge,
        .sidebar-menu a.active .badge {
            background: #FFF;
            color: var(--burgundy);
            transform: scale(1.15) rotate(-5deg);
        }

        /* Enhanced Sidebar Overlay */
        #sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-speed) ease;
        }

        #sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Enhanced Navbar */
        .navbar-premium {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.1);
            padding: 1rem 1.25rem;
            border-bottom: 3px solid var(--gold);
            z-index: 1060;
            transition: all var(--transition-speed) ease;
            position: sticky;
            top: 0;
        }

        body.dark-mode .navbar-premium {
            background: rgba(45, 45, 45, 0.95);
            border-bottom-color: var(--gold);
        }

        .navbar-premium .navbar-brand {
            color: var(--burgundy) !important;
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            transition: all var(--transition-speed) ease;
        }

        .navbar-premium .navbar-brand:hover {
            transform: scale(1.05);
            text-shadow: 0 2px 10px rgba(128, 0, 32, 0.3);
        }

        .navbar-premium .navbar-brand i {
            color: var(--gold);
            margin-right: 10px;
            animation: spin-slow 10s linear infinite;
        }

        @keyframes spin-slow {
            to { transform: rotate(360deg); }
        }

        /* Enhanced Toggle Button */
        #sidebarToggle {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            border: none;
            color: var(--burgundy);
            padding: 10px 15px;
            border-radius: 10px;
            transition: all var(--transition-speed) ease;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        #sidebarToggle:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.5);
        }

        #sidebarToggle:active {
            transform: translateY(0) scale(0.95);
        }

        /* Enhanced User Dropdown */
        .user-dropdown .dropdown-toggle {
            color: var(--text-dark);
            font-weight: 600;
            border: 2px solid var(--gold);
            border-radius: 30px;
            padding: 10px 18px;
            transition: all var(--transition-speed) ease;
            display: flex;
            align-items: center;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        body.dark-mode .user-dropdown .dropdown-toggle {
            color: #e0e0e0;
            background: #2d2d2d;
        }

        .user-dropdown .dropdown-toggle:hover {
            background: var(--gold);
            color: #2C001E;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
            border-color: var(--gold-dark);
        }

        .user-dropdown .dropdown-toggle img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            margin-right: 10px;
            border: 3px solid var(--gold);
            transition: all var(--transition-speed) ease;
        }

        .user-dropdown .dropdown-toggle:hover img {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.6);
        }

        .user-dropdown .dropdown-menu {
            border: 2px solid var(--gold);
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 0.5rem 0;
            min-width: 220px;
            right: 0;
            left: auto;
        }

        .user-dropdown .dropdown-item {
            padding: 12px 20px;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
        }

        .user-dropdown .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.2) 100%);
            color: var(--burgundy);
            padding-left: 25px;
        }

        .user-dropdown .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        /* Content Area */
        #content {
            margin-left: 0;
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
            padding-top: 0;
        }

        body.dark-mode #content {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
        }

        #content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Enhanced Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem 0;
            border-bottom: 2px solid #dee2e6;
            position: relative;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100px;
            height: 2px;
            background: var(--gold);
            animation: slide-right 2s ease-in-out infinite;
        }

        @keyframes slide-right {
            0%, 100% { width: 100px; }
            50% { width: 200px; }
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        body.dark-mode .page-title {
            color: #e0e0e0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .page-title i {
            margin-right: 15px;
            color: var(--gold);
            font-size: 1.8rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .page-date {
            font-size: 0.95rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        body.dark-mode .page-date {
            color: #a0a0a0;
        }

        /* Enhanced Dashboard Cards */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            padding: 1.75rem;
            transition: all var(--transition-speed) cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
            border-left: 6px solid #0d6efd;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .stat-card:hover::before {
            top: -60%;
            right: -60%;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .stat-card.primary { 
            border-left-color: #0d6efd;
            background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
        }
        .stat-card.success { 
            border-left-color: #198754;
            background: linear-gradient(135deg, #ffffff 0%, #f0fff4 100%);
        }
        .stat-card.warning { 
            border-left-color: #ffc107;
            background: linear-gradient(135deg, #ffffff 0%, #fffbf0 100%);
        }
        .stat-card.info { 
            border-left-color: #17a2b8;
            background: linear-gradient(135deg, #ffffff 0%, #f0feff 100%);
        }
        .stat-card.danger { 
            border-left-color: #dc3545;
            background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);
        }

        body.dark-mode .stat-card {
            background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        }

        .stat-card h6 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #6c757d;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        body.dark-mode .stat-card h6 {
            color: #a0a0a0;
        }

        .stat-card .value {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            font-family: 'Playfair Display', serif;
        }

        body.dark-mode .stat-card .value {
            color: #e0e0e0;
        }

        .stat-card .badge {
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .stat-card .icon {
            font-size: 3rem;
            opacity: 0.2;
            position: absolute;
            bottom: 15px;
            right: 20px;
            transition: all var(--transition-speed) ease;
        }

        .stat-card:hover .icon {
            opacity: 0.4;
            transform: scale(1.2) rotate(10deg);
        }

        .stat-card.primary .icon { color: #0d6efd; }
        .stat-card.success .icon { color: #198754; }
        .stat-card.warning .icon { color: #ffc107; }
        .stat-card.info .icon { color: #17a2b8; }
        .stat-card.danger .icon { color: #dc3545; }

        /* Enhanced Quick Actions */
        .quick-actions {
            background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-light) 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(128, 0, 32, 0.3);
            position: relative;
            overflow: hidden;
        }

        .quick-actions::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: shine 3s ease-in-out infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            50%, 100% { left: 100%; }
        }

        .btn-action {
            padding: 14px 24px;
            font-weight: 700;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all var(--transition-speed) cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transition: width 0.6s ease, height 0.6s ease, top 0.6s ease, left 0.6s ease;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .btn-action:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-action:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .btn-action:active {
            transform: translateY(-2px) scale(1.02);
        }

        /* ================================
           ENHANCED RESPONSIVE ICONS
           ================================ */
        .navbar-nav {
            gap: 8px;
        }

        .notification-bell,
        .dark-mode-toggle,
        .user-dropdown {
            position: relative;
        }

        /* Enhanced Notification Bell */
        .notification-bell {
            position: relative;
            margin-right: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            transition: all var(--transition-speed) ease;
        }

        .notification-bell:hover {
            background: rgba(212, 175, 55, 0.1);
        }

        .notification-bell .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: var(--burgundy);
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 800;
            border: 3px solid white;
            animation: pulse-badge 2s ease-in-out infinite;
            z-index: 1;
        }

        @keyframes pulse-badge {
            0%, 100% { 
                transform: scale(1); 
                box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.7);
            }
            50% { 
                transform: scale(1.1); 
                box-shadow: 0 0 0 10px rgba(212, 175, 55, 0);
            }
        }

        .notification-bell i {
            font-size: 1.3rem;
            color: var(--burgundy);
            transition: all var(--transition-speed) ease;
        }

        .notification-bell:hover i {
            color: var(--gold);
            transform: scale(1.2) rotate(15deg);
            filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.5));
        }

        /* Enhanced Dark Mode Toggle */
        .dark-mode-toggle {
            background: transparent;
            border: 2px solid var(--gold);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            margin-left: 8px;
            transition: all var(--transition-speed) ease;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(212, 175, 55, 0.2);
        }

        .dark-mode-toggle:hover {
            background: var(--gold);
            color: var(--burgundy);
            transform: rotate(180deg) scale(1.1);
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.5);
        }

        .dark-mode-toggle i {
            font-size: 1.2rem;
            transition: all var(--transition-speed) ease;
        }

        /* Enhanced Notification Dropdown */
        .notification-dropdown {
            position: absolute;
            top: calc(100% + 15px);
            right: 0;
            width: 360px;
            max-height: 480px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.25);
            overflow: hidden;
            z-index: 1070;
            display: none;
            flex-direction: column;
            border: 2px solid var(--gold);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification-dropdown.show {
            display: flex;
        }

        .notification-header {
            padding: 18px;
            border-bottom: 2px solid #eee;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.05) 100%);
        }

        body.dark-mode .notification-header {
            border-bottom-color: #444;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.1) 100%);
        }

        .notification-header button {
            background: none;
            border: 1px solid var(--gold);
            color: var(--burgundy);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }

        .notification-header button:hover {
            background: var(--gold);
            transform: scale(1.05);
        }

        .notification-list {
            overflow-y: auto;
            max-height: 360px;
        }

        .notification-item {
            padding: 16px 18px;
            border-bottom: 1px solid #eee;
            transition: all var(--transition-speed) ease;
            cursor: pointer;
            position: relative;
        }

        body.dark-mode .notification-item {
            border-bottom-color: #444;
        }

        .notification-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--gold) 0%, transparent 100%);
            transition: width var(--transition-speed) ease;
        }

        .notification-item:hover::before {
            width: 100%;
        }

        .notification-item:hover {
            background: rgba(212, 175, 55, 0.05);
            padding-left: 24px;
        }

        body.dark-mode .notification-item:hover {
            background: rgba(212, 175, 55, 0.1);
        }

        .notification-item.unread {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.15) 0%, rgba(212, 175, 55, 0.05) 100%);
            font-weight: 600;
            border-left: 4px solid var(--gold);
        }

        body.dark-mode .notification-item.unread {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.25) 0%, rgba(212, 175, 55, 0.1) 100%);
        }

        .notification-item.unread::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 10px;
            width: 8px;
            height: 8px;
            background: var(--gold);
            border-radius: 50%;
            transform: translateY(-50%);
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0% {
                box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(212, 175, 55, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(212, 175, 55, 0);
            }
        }

        .notification-item i {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.1rem;
        }

        .notification-item .text-primary {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .notification-item .text-warning {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .notification-item .text-success {
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .notification-footer {
            padding: 14px 18px;
            text-align: center;
            font-size: 0.9rem;
            border-top: 2px solid #eee;
            background: #f8f9fa;
        }

        body.dark-mode .notification-footer {
            border-top-color: #444;
            background: #1a1a1a;
        }

        .notification-footer a {
            color: var(--burgundy);
            text-decoration: none;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }

        body.dark-mode .notification-footer a {
            color: var(--gold);
        }

        .notification-footer a:hover {
            text-decoration: underline;
            color: var(--gold);
        }

        /* NEW FEATURES STYLES */

        /* Quick Search */
        .quick-search-container {
            position: relative;
            margin-right: 15px;
        }

        .quick-search {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid var(--gold);
            border-radius: 25px;
            padding: 8px 15px 8px 40px;
            width: 250px;
            transition: all var(--transition-speed) ease;
            font-size: 0.9rem;
        }

        body.dark-mode .quick-search {
            background: rgba(45, 45, 45, 0.9);
            color: #e0e0e0;
        }

        .quick-search:focus {
            width: 300px;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
            outline: none;
        }

        .quick-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
        }

        .quick-search-results {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-height: 400px;
            overflow-y: auto;
            z-index: 1070;
            display: none;
            border: 1px solid var(--gold);
        }

        body.dark-mode .quick-search-results {
            background: #2d2d2d;
            color: #e0e0e0;
        }

        .quick-search-results.show {
            display: block;
        }

        .search-result-item {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        body.dark-mode .search-result-item {
            border-bottom-color: #444;
        }

        .search-result-item:hover {
            background: rgba(212, 175, 55, 0.1);
            padding-left: 20px;
        }

        .search-result-title {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .search-result-type {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Server Status Widget */
/* Server Status Widget - Alternative Position */
.server-status-widget {
    position: fixed;
    bottom: 90px; /* Diatur agar di atas FAB */
    right: 20px; /* Dipindahkan ke kanan */
    background: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    z-index: 999; /* Z-index lebih rendah dari FAB */
    width: 200px;
    border: 1px solid var(--gold);
    transition: all var(--transition-speed) ease;
}

body.dark-mode .server-status-widget {
    background: rgba(45, 45, 45, 0.9);
    color: #e0e0e0;
}

.server-status-widget:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.server-status-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-weight: 600;
}

.server-status-header i {
    color: var(--gold);
    margin-right: 8px;
}

.server-status-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 0.85rem;
}

.server-status-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
}

.status-good {
    background-color: #28a745;
}

.status-warning {
    background-color: #ffc107;
}

.status-danger {
    background-color: #dc3545;
}
        /* Activity Log Widget */
        .activity-log-widget {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            max-height: 300px;
            overflow-y: auto;
        }

        body.dark-mode .activity-log-widget {
            background: #2d2d2d;
        }

        .activity-log-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .activity-log-header i {
            color: var(--gold);
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        body.dark-mode .activity-item {
            border-bottom-color: #444;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .activity-content {
            flex-grow: 1;
        }

        .activity-title {
            font-weight: 500;
            margin-bottom: 3px;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #6c757d;
        }

        /* Weather Widget */
        .weather-widget {
            background: linear-gradient(135deg, #56CCF2 0%, #2F80ED 100%);
            border-radius: 16px;
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .weather-widget::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }

        .weather-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .weather-location {
            font-weight: 600;
        }

        .weather-icon {
            font-size: 2rem;
        }

        .weather-temp {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .weather-desc {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Keyboard Shortcuts Helper */
        .shortcuts-helper {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            z-index: 1000;
            width: 220px;
            border: 1px solid var(--gold);
            transition: all var(--transition-speed) ease;
            transform: scale(0);
            opacity: 0;
        }

        body.dark-mode .shortcuts-helper {
            background: rgba(45, 45, 45, 0.9);
            color: #e0e0e0;
        }

        .shortcuts-helper.show {
            transform: scale(1);
            opacity: 1;
        }

        .shortcuts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .shortcuts-header i {
            color: var(--gold);
        }

        .shortcut-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.85rem;
        }

        .shortcut-key {
            background: var(--gold);
            color: var(--burgundy);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Performance Monitor */
        .performance-monitor {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        body.dark-mode .performance-monitor {
            background: #2d2d2d;
        }

        .performance-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .performance-header i {
            color: var(--gold);
        }

        .performance-item {
            margin-bottom: 15px;
        }

        .performance-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .performance-bar {
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }

        .performance-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 1s ease;
        }

        .performance-fill.good {
            background: linear-gradient(90deg, #28a745, #20c997);
        }

        .performance-fill.warning {
            background: linear-gradient(90deg, #ffc107, #fd7e14);
        }

        .performance-fill.danger {
            background: linear-gradient(90deg, #dc3545, #e83e8c);
        }

        /* Recent Files Widget */
        .recent-files-widget {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        body.dark-mode .recent-files-widget {
            background: #2d2d2d;
        }

        .recent-files-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .recent-files-header i {
            color: var(--gold);
        }

        .file-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        body.dark-mode .file-item {
            border-bottom-color: #444;
        }

        .file-item:hover {
            padding-left: 10px;
            background: rgba(212, 175, 55, 0.05);
        }

        .file-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            background: rgba(212, 175, 55, 0.1);
            color: var(--gold);
        }

        .file-info {
            flex-grow: 1;
        }

        .file-name {
            font-weight: 500;
            margin-bottom: 3px;
        }

        .file-meta {
            font-size: 0.75rem;
            color: #6c757d;
        }

        /* Calendar Widget */
        .calendar-widget {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        body.dark-mode .calendar-widget {
            background: #2d2d2d;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .calendar-header i {
            color: var(--gold);
        }

        .mini-calendar {
            width: 100%;
        }

        .calendar-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .calendar-nav button {
            background: none;
            border: none;
            color: var(--gold);
            font-size: 1.2rem;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        .calendar-nav button:hover {
            transform: scale(1.2);
        }

        .calendar-month {
            font-weight: 600;
            text-align: center;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 5px 0;
            color: var(--gold);
        }

        .calendar-day {
            text-align: center;
            padding: 8px 0;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        .calendar-day:hover {
            background: rgba(212, 175, 55, 0.1);
        }

        .calendar-day.today {
            background: var(--gold);
            color: var(--burgundy);
            font-weight: 600;
        }

        .calendar-day.has-event {
            position: relative;
        }

        .calendar-day.has-event::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            background: var(--burgundy);
            border-radius: 50%;
        }

        /* Floating Action Button */
.fab-container {
    position: fixed;
    bottom: 30px;
    left: 50%; /* Diubah ke tengah */
    transform: translateX(-50%); /* Untuk centering horizontal */
    z-index: 1000;
}

.fab-main {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: var(--burgundy);
    border: none;
    box-shadow: 0 4px 20px rgba(212, 175, 55, 0.4);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all var(--transition-speed) ease;
}

.fab-main:hover {
    transform: scale(1.1) rotate(90deg);
    box-shadow: 0 6px 25px rgba(212, 175, 55, 0.6);
}

.fab-options {
    position: absolute;
    bottom: 70px;
    left: 50%; /* Diubah ke tengah */
    transform: translateX(-50%); /* Untuk centering horizontal */
    display: flex;
    gap: 15px; /* Diubah dari flex-direction column ke flex row */
    opacity: 0;
    visibility: hidden;
    transition: all var(--transition-speed) ease;
}

.fab-options.show {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(-10px); /* Tambahkan sedikit translateY */
}

.fab-option {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: white;
    color: var(--burgundy);
    border: none;
    box-shadow: 0 3px 15px rgba(0,0,0,0.2);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all var(--transition-speed) ease;
    position: relative;
}

.fab-option:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
}

.fab-tooltip {
    position: absolute;
    bottom: 60px; /* Diubah untuk posisi di atas */
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all var(--transition-speed) ease;
}

.fab-option:hover .fab-tooltip {
    opacity: 1;
    visibility: visible;
}

/* Scroll to top button adjustment */
.scroll-to-top {
    position: fixed;
    bottom: 100px; /* Diubah agar tidak bertabrakan dengan FAB */
    right: 30px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    color: var(--burgundy);
    border: none;
    box-shadow: 0 4px 20px rgba(212, 175, 55, 0.4);
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 999; /* Z-index lebih rendah dari FAB */
    font-size: 1.2rem;
}

/* Responsive adjustments */
@media (max-width: 575.98px) {
    .fab-container {
        bottom: 20px;
    }
    
    .fab-main {
        width: 48px;
        height: 48px;
        font-size: 1.3rem;
    }
    
    .fab-options {
        bottom: 60px;
        gap: 10px;
        flex-wrap: wrap; /* Allow wrapping on very small screens */
        justify-content: center;
        max-width: 200px; /* Limit width on mobile */
    }
    
    .fab-option {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .scroll-to-top {
        bottom: 80px; /* Adjust for mobile */
        right: 20px;
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }
}

@media (max-width: 400px) {
    .fab-options {
        gap: 8px;
        max-width: 160px;
    }
    
    .fab-option {
        width: 36px;
        height: 36px;
        font-size: 0.9rem;
    }
    
    .fab-tooltip {
        font-size: 0.7rem;
        padding: 4px 8px;
    }
}

        .fab-option:hover .fab-tooltip {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive Design */
        @media (min-width: 992px) {
            #sidebar {
                transform: translateX(0);
                width: var(--sidebar-width);
            }
            
            #content {
                margin-left: var(--sidebar-width);
            }
            
            #sidebar-overlay {
                display: none !important;
            }

            #sidebarToggle .mobile-text {
                display: none;
            }
        }

        @media (max-width: 991.98px) {
            #sidebar {
                width: 85%;
                max-width: 340px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .stat-card {
                margin-bottom: 1rem;
            }

            .quick-actions {
                flex-direction: column;
                padding: 1.5rem;
            }

            .notification-dropdown {
                width: 320px;
            }
            
            .notification-bell {
                margin-right: 12px;
                padding: 6px;
            }
            
            .dark-mode-toggle {
                width: 40px;
                height: 40px;
                margin-left: 6px;
            }
            
            .dark-mode-toggle i {
                font-size: 1.1rem;
            }
            
            .notification-bell i {
                font-size: 1.2rem;
            }
            
            .notification-bell .badge {
                width: 20px;
                height: 20px;
                font-size: 0.65rem;
            }

            .quick-search {
                width: 180px;
            }

            .quick-search:focus {
                width: 220px;
            }

            .server-status-widget,
            .shortcuts-helper {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            .navbar-premium {
                padding: 0.75rem 1rem;
            }

            .navbar-premium .navbar-brand {
                font-size: 1.1rem;
            }

            .sidebar-header {
                padding: 1.25rem;
            }

            .sidebar-brand {
                font-size: 1.2rem;
            }

            .sidebar-subtitle {
                font-size: 0.85rem;
            }

            .sidebar-menu a {
                padding: 16px 18px;
                font-size: 1rem;
            }

            .sidebar-menu i {
                font-size: 1.3rem;
                width: 32px;
            }

            .sidebar-menu .badge {
                font-size: 0.8rem;
                padding: 4px 8px;
            }

            .page-title {
                font-size: 1.6rem;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .stat-card .value {
                font-size: 1.8rem;
            }

            .stat-card .icon {
                font-size: 2.5rem;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            .notification-bell {
                margin-right: 8px;
                padding: 5px;
            }
            
            .dark-mode-toggle {
                width: 36px;
                height: 36px;
                margin-left: 4px;
            }
            
            .dark-mode-toggle i {
                font-size: 1rem;
            }
            
            .notification-bell i {
                font-size: 1.1rem;
            }
            
            .notification-bell .badge {
                width: 18px;
                height: 18px;
                font-size: 0.6rem;
                top: -4px;
                right: -4px;
            }
            
            .user-dropdown .dropdown-toggle {
                padding: 8px 14px;
            }
            
            .user-dropdown .dropdown-toggle img {
                width: 32px;
                height: 32px;
            }
            
            .notification-dropdown {
                width: 90vw;
                max-width: 320px;
                right: -20px;
            }
            
            .notification-item {
                padding: 12px 14px;
            }
            
            .notification-item i {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }
            
            .notification-footer {
                padding: 10px 14px;
                font-size: 0.85rem;
            }

            .quick-search {
                display: none;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-premium {
                padding: 0.5rem 0.75rem;
            }

            .navbar-brand {
                font-size: 1rem !important;
            }

            #sidebarToggle {
                padding: 8px 12px;
            }

            .sidebar-header {
                padding: 1rem;
            }

            .sidebar-brand {
                font-size: 1.1rem;
            }

            .sidebar-subtitle {
                font-size: 0.8rem;
            }

            .sidebar-menu a {
                padding: 14px 16px;
                font-size: 0.95rem;
            }

            .page-title {
                font-size: 1.4rem;
            }

            .page-title i {
                font-size: 1.3rem;
            }

            .stat-card {
                padding: 1.25rem;
            }

            .stat-card .value {
                font-size: 1.6rem;
            }

            .stat-card h6 {
                font-size: 0.85rem;
            }

            .stat-card .icon {
                font-size: 2rem;
            }

            .quick-actions {
                padding: 1.25rem;
            }

            .btn-action {
                padding: 12px 18px;
                font-size: 0.85rem;
            }

            .user-dropdown .dropdown-toggle {
                padding: 8px 14px;
            }

            .user-dropdown .dropdown-toggle img {
                width: 32px;
                height: 32px;
            }

            .notification-bell {
                margin-right: 6px;
                padding: 4px;
            }
            
            .dark-mode-toggle {
                width: 32px;
                height: 32px;
                margin-left: 2px;
            }
            
            .dark-mode-toggle i {
                font-size: 0.9rem;
            }
            
            .notification-bell i {
                font-size: 1rem;
            }
            
            .notification-bell .badge {
                width: 16px;
                height: 16px;
                font-size: 0.55rem;
                top: -3px;
                right: -3px;
            }
            
            .notification-dropdown {
                width: 85vw;
                right: -15px;
            }
            
            .notification-header {
                padding: 14px;
            }
            
            .notification-item {
                padding: 10px 12px;
            }
            
            .notification-item i {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }

            .fab-container {
                bottom: 20px;
                right: 20px;
            }

            .fab-main {
                width: 48px;
                height: 48px;
                font-size: 1.3rem;
            }

            .fab-option {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }

        /* Enhanced Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--gold) 0%, var(--gold-dark) 100%);
            border-radius: 10px;
            border: 2px solid #f1f1f1;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--gold-dark) 0%, var(--burgundy) 100%);
        }

        body.dark-mode ::-webkit-scrollbar-track {
            background: #2d2d2d;
        }

        body.dark-mode ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--burgundy-light) 0%, var(--burgundy) 100%);
            border-color: #2d2d2d;
        }

        /* Enhanced Animations */
        .animate-fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .animate-scale-in {
            animation: scaleIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes scaleIn {
            from { 
                transform: scale(0.8); 
                opacity: 0; 
            }
            to { 
                transform: scale(1); 
                opacity: 1; 
            }
        }

        /* Table Enhancements */
        .table {
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-light) 100%);
            color: white;
        }

        .table thead th {
            border: none;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all var(--transition-speed) ease;
        }

        .table tbody tr:hover {
            background: rgba(212, 175, 55, 0.05);
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Card Enhancements */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            transition: all var(--transition-speed) ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.18);
        }

        .card-header {
            background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-light) 100%);
            color: white;
            font-weight: 700;
            border: none;
            padding: 1.25rem 1.5rem;
        }

        /* Button Enhancements */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all var(--transition-speed) ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
            border: none;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            border: none;
            color: #2C001E;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #bb2d3b 100%);
            border: none;
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            border: none;
        }

        /* Toast Notifications */
        .toast {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: none;
        }

        /* Progress Bar Enhancement */
        .progress {
            height: 10px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--gold) 0%, var(--gold-light) 100%);
            animation: progress-animation 2s ease-in-out;
        }

        @keyframes progress-animation {
            from { width: 0; }
        }

        /* Badge Enhancements */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Utility Classes */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        body.dark-mode .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--gold) 0%, var(--burgundy) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Loading States */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
            border-radius: 8px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        body.dark-mode .skeleton {
            background: linear-gradient(90deg, #2d2d2d 25%, #1a1a1a 50%, #2d2d2d 75%);
            background-size: 200% 100%;
        }
    </style>
</head>
<body>

<!-- Enhanced Loading Spinner -->
<div class="loader-container" id="loader">
    <div class="loader"></div>
    <div class="loader-text">Loading...</div>
</div>

@if(auth()->guard('admin')->check())
    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay"></div>

    <!-- Enhanced Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <i class="fas fa-crown"></i>
                <span> SMK N 2</span>
            </a>
            <div class="sidebar-subtitle">Siatas Barita</div>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                    <span class="badge bg-yellow">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.siswa.index') }}" class="{{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Data Siswa</span>
                    <span class="badge bg-blue">{{ $totalSiswa ?? 0 }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jurusan.index') }}" class="{{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Kelola Jurusan</span>
                    <span class="badge bg-green">{{ $totalJurusan ?? 0 }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.nilai.index') }}" class="{{ request()->routeIs('admin.nilai.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Nilai & Seleksi</span>
                    <span class="badge bg-yellow">Auto</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                    <i class="fas fa-file-export"></i>
                    <span>Laporan</span>
                    <span class="badge bg-cyan">PDF/Excel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengumuman.index') }}" class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pengumuman</span>
                    <span class="badge bg-red">Public</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengaturan.index') }}" class="{{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i>
                    <span>Pengaturan</span>
                    <span class="badge bg-yellow">System</span>
                </a>
            </li>
            <li class="mt-4">
                <form method="POST" action="{{ route('admin.logout') }}" id="logout-sidebar-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-sidebar-form').submit();" class="text-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout System</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Content -->
    <div id="content">
        <!-- Enhanced Top Navbar -->
        <nav class="navbar navbar-premium navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                    <span class="mobile-text ms-2 d-lg-none">Menu</span>
                </button>

                <div class="d-flex align-items-center">
                    <i class="fas fa-diamond me-2 text-warning"></i>
                    <span class="navbar-brand mb-0">Admin Panel</span>
                </div>

                <div class="navbar-nav ms-auto d-flex align-items-center">
                    <!-- Quick Search -->
                    <div class="quick-search-container d-none d-lg-block">
                        <i class="fas fa-search quick-search-icon"></i>
                        <input type="text" class="quick-search" placeholder="Cari siswa, jurusan..." id="quickSearch">
                        <div class="quick-search-results" id="quickSearchResults">
                            <!-- Search results will be loaded here dynamically -->
                        </div>
                    </div>

                    <!-- Enhanced Notification Bell with Real-time -->
                    <div class="notification-bell" id="notificationBell">
                        <i class="fas fa-bell"></i>
                        <span class="badge" id="notificationCount">0</span>
                        <div class="notification-dropdown" id="notificationDropdown">
                            <div class="notification-header">
                                <span>Notifikasi</span>
                                <button class="btn btn-sm" id="markAllReadBtn">Tandai semua</button>
                            </div>
                            <div class="notification-list" id="notificationList">
                                <!-- Notifications will be loaded here dynamically -->
                                <div class="text-center py-3">
                                    <i class="fas fa-spinner fa-spin text-muted mb-2"></i>
                                    <p class="text-muted">Memuat notifikasi...</p>
                                </div>
                            </div>
                            <div class="notification-footer">
                                <a href="{{ route('admin.notifications.index') }}" class="text-decoration-none">
                                    Lihat semua notifikasi
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Dark Mode Toggle -->
                    <button class="dark-mode-toggle" id="darkModeToggle" title="Toggle Dark Mode (Alt+D)">
                        <i class="fas fa-moon"></i>
                    </button>

                    <!-- Enhanced User Dropdown -->
                    <div class="user-dropdown">
                        @php
                            $user = Auth::guard('admin')->user();
                        @endphp
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown" title="User Menu">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama_lengkap) }}&background=D4AF37&color=2C001E&size=38" alt="User Avatar">
                            <div class="ms-2 d-none d-md-block">
                                <div class="fw-bold">{{ $user ? $user->nama_lengkap : 'Admin' }}</div>
                                <small class="d-block text-muted">Administrator</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end animate__animated animate__fadeIn animate__faster">
                            <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid px-4 animate-fade-in">
            @yield('content')
        </div>
    </div>

    <!-- Server Status Widget -->
    <div class="server-status-widget" id="serverStatusWidget">
        <div class="server-status-header">
            <i class="fas fa-server"></i>
            <span>Status Server</span>
        </div>
        <div class="server-status-item">
            <span>CPU</span>
            <span><span class="server-status-indicator status-good"></span> <span id="cpuUsage">12%</span></span>
        </div>
        <div class="server-status-item">
            <span>Memory</span>
            <span><span class="server-status-indicator status-good"></span> <span id="memoryUsage">45%</span></span>
        </div>
        <div class="server-status-item">
            <span>Storage</span>
            <span><span class="server-status-indicator status-warning"></span> <span id="storageUsage">78%</span></span>
        </div>
        <div class="server-status-item">
            <span>Database</span>
            <span><span class="server-status-indicator status-good"></span> Online</span>
        </div>
    </div>

    <!-- Keyboard Shortcuts Helper -->
    <div class="shortcuts-helper" id="shortcutsHelper">
        <div class="shortcuts-header">
            <i class="fas fa-keyboard"></i>
            <span>Shortcut</span>
            <button type="button" class="btn-close btn-close-white btn-sm" id="closeShortcuts"></button>
        </div>
        <div class="shortcut-item">
            <span>Toggle Sidebar</span>
            <span class="shortcut-key">Alt+M</span>
        </div>
        <div class="shortcut-item">
            <span>Dark Mode</span>
            <span class="shortcut-key">Alt+D</span>
        </div>
        <div class="shortcut-item">
            <span>Notifications</span>
            <span class="shortcut-key">Alt+N</span>
        </div>
        <div class="shortcut-item">
            <span>Quick Search</span>
            <span class="shortcut-key">Alt+S</span>
        </div>
        <div class="shortcut-item">
            <span>Help</span>
            <span class="shortcut-key">Alt+H</span>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fab-container">
        <div class="fab-options" id="fabOptions">
            <button class="fab-option" title="Add Siswa">
                <i class="fas fa-user-plus"></i>
                <span class="fab-tooltip">Tambah Siswa</span>
            </button>
            <button class="fab-option" title="Add Jurusan">
                <i class="fas fa-graduation-cap"></i>
                <span class="fab-tooltip">Tambah Jurusan</span>
            </button>
            <button class="fab-option" title="Generate Report">
                <i class="fas fa-file-alt"></i>
                <span class="fab-tooltip">Buat Laporan</span>
            </button>
            <button class="fab-option" title="System Settings">
                <i class="fas fa-cog"></i>
                <span class="fab-tooltip">Pengaturan</span>
            </button>
        </div>
        <button class="fab-main" id="fabMain">
            <i class="fas fa-plus"></i>
        </button>
    </div>
@else
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center animate-scale-in">
            <i class="fas fa-lock fa-4x text-danger mb-4"></i>
            <h3 class="text-danger mb-3">Akses Ditolak</h3>
            <p class="text-muted mb-4">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
            <a href="{{ route('admin.login') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
            </a>
        </div>
    </div>
@endif

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Enhanced page load animation
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }, 500);
            }, 800);
        });

        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebar-overlay');
        const content = document.getElementById('content');
        const darkModeToggle = document.getElementById('darkModeToggle');
        const notificationBell = document.getElementById('notificationBell');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationList = document.getElementById('notificationList');
        const notificationCount = document.getElementById('notificationCount');
        const markAllReadBtn = document.getElementById('markAllReadBtn');
        const quickSearch = document.getElementById('quickSearch');
        const quickSearchResults = document.getElementById('quickSearchResults');
        const shortcutsHelper = document.getElementById('shortcutsHelper');
        const closeShortcuts = document.getElementById('closeShortcuts');
        const fabMain = document.getElementById('fabMain');
        const fabOptions = document.getElementById('fabOptions');

        if (!sidebar || !toggleBtn || !overlay) {
            console.warn("Elemen sidebar tidak ditemukan.");
            return;
        }

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }

       // Enhanced toggle sidebar with animation
function toggleSidebar() {
    if (window.innerWidth < 992) {
        sidebar.classList.toggle('mobile-show');
        const isShown = sidebar.classList.contains('mobile-show');
        document.body.style.overflow = isShown ? 'hidden' : '';
        overlay.classList.toggle('active', isShown);
        
        // Add haptic feedback simulation
        if (navigator.vibrate) {
            navigator.vibrate(10);
        }
    } else {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('expanded');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        
        // TAMBAHKAN KODE DI SINI
        // Adjust server status widget position after sidebar toggle
        setTimeout(adjustServerStatusPosition, 300);
    }
}

toggleBtn.addEventListener('click', toggleSidebar);
overlay.addEventListener('click', toggleSidebar);

// Function to adjust server status widget position
function adjustServerStatusPosition() {
    const serverStatusWidget = document.getElementById('serverStatusWidget');
    const sidebar = document.getElementById('sidebar');
    
    if (serverStatusWidget && sidebar) {
        if (window.innerWidth >= 992) {
            if (sidebar.classList.contains('collapsed')) {
                serverStatusWidget.style.left = '110px'; // Position when sidebar is collapsed
            } else {
                serverStatusWidget.style.left = '300px'; // Position when sidebar is expanded
            }
        } else {
            serverStatusWidget.style.left = '20px'; // Position on mobile
        }
    }
}

// Call on window resize
window.addEventListener('resize', adjustServerStatusPosition);

// Initial position adjustment
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(adjustServerStatusPosition, 100);
});

        // Check for saved sidebar state
        if (window.innerWidth >= 992 && localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
            content.classList.add('expanded');
        }

        // Close sidebar when clicking on menu items in mobile view
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    sidebar.classList.remove('mobile-show');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });

        // Enhanced dark mode toggle with animation
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            
            this.innerHTML = isDarkMode ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            localStorage.setItem('darkMode', isDarkMode);
            
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                width: 100px;
                height: 100px;
                margin-top: -50px;
                margin-left: -50px;
                animation: ripple 0.6s;
                pointer-events: none;
            `;
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
            
            // Show toast notification
            showNotification(
                isDarkMode ? 'Mode Gelap Diaktifkan' : 'Mode Terang Diaktifkan',
                'info'
            );
        });

        // Function to update notification count
        function updateNotificationCount() {
            const unreadNotifications = document.querySelectorAll('.notification-item.unread').length;
            notificationCount.textContent = unreadNotifications;
            
            if (unreadNotifications === 0) {
                notificationCount.style.display = 'none';
            } else {
                notificationCount.style.display = 'flex';
            }
        }

        // Initialize notification count
        updateNotificationCount();

        // Enhanced notification dropdown
        if (notificationBell && notificationDropdown) {
            notificationBell.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('show');
                
                // Animate notification items
                if (notificationDropdown.classList.contains('show')) {
                    const items = notificationDropdown.querySelectorAll('.notification-item');
                    items.forEach((item, index) => {
                        item.style.animation = `fadeIn 0.3s ease ${index * 0.1}s forwards`;
                        item.style.opacity = '0';
                    });
                    
                    // Load new notifications if needed
                    loadNewNotifications();
                }
            });

            document.addEventListener('click', function() {
                notificationDropdown.classList.remove('show');
            });

            // Mark all as read functionality
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const unreadItems = document.querySelectorAll('.notification-item.unread');
                    
                    unreadItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.remove('unread');
                            item.style.animation = 'fadeOut 0.3s ease';
                        }, index * 100);
                    });
                    
                    // Update badge
                    const badge = notificationBell.querySelector('.badge');
                    if (badge) {
                        badge.style.animation = 'scaleOut 0.3s ease';
                        setTimeout(() => {
                            badge.style.display = 'none';
                        }, 300);
                    }
                    
                    // Send request to mark all as read
                    fetch('{{ route("admin.notifications.markAllRead") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateNotificationCount();
                            showNotification('Semua notifikasi telah ditandai sebagai dibaca', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            }

            // Add click animation to notification items
            document.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', function() {
                    // Mark as read
                    if (this.classList.contains('unread')) {
                        this.classList.remove('unread');
                        
                        // Send request to mark as read
                        const notificationId = this.getAttribute('data-id');
                        fetch(`/admin/notifications/mark-read/${notificationId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                updateNotificationCount();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                    
                    // Add animation
                    this.style.animation = 'pulse 0.3s ease';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 300);
                });
            });
        }

        // Function to load notifications
        function loadNotifications() {
            fetch('{{ route("admin.notifications.getRecent") }}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.notifications && data.notifications.length > 0) {
                    // Clear existing notifications
                    notificationList.innerHTML = '';
                    
                    // Add notifications to the list
                    data.notifications.forEach(notification => {
                        const notificationElement = createNotificationElement(notification);
                        notificationList.appendChild(notificationElement);
                    });
                    
                    // Update notification count
                    updateNotificationCount();
                } else {
                    // Show no notifications message
                    notificationList.innerHTML = `
                        <div class="text-center py-3">
                            <i class="fas fa-bell-slash text-muted mb-2"></i>
                            <p class="text-muted">Tidak ada notifikasi</p>
                        </div>
                    `;
                    
                    // Update notification count
                    updateNotificationCount();
                }
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
                notificationList.innerHTML = `
                    <div class="text-center py-3 text-danger">
                        <i class="fas fa-exclamation-circle mb-2"></i>
                        <p>Gagal memuat notifikasi</p>
                    </div>
                `;
            });
        }

        // Function to create notification element
        function createNotificationElement(notification) {
            const element = document.createElement('div');
            element.className = `notification-item ${!notification.read_at ? 'unread' : ''}`;
            element.setAttribute('data-id', notification.id);
            
            const iconClass = notification.type === 'info' ? 'fa-info-circle text-primary' : 
                             notification.type === 'warning' ? 'fa-exclamation-circle text-warning' : 
                             notification.type === 'success' ? 'fa-check-circle text-success' : 
                             notification.type === 'error' ? 'fa-times-circle text-danger' : 
                             'fa-bell text-secondary';
            
            element.innerHTML = `
                <div class="d-flex align-items-start">
                    <i class="fas ${iconClass} me-3"></i>
                    <div class="flex-grow-1">
                        <div class="fw-bold">${notification.title}</div>
                        <div class="small text-muted">${notification.message}</div>
                        <div class="small text-muted mt-1">
                            <i class="fas fa-clock me-1"></i><span class="notification-time">${notification.time}</span>
                        </div>
                    </div>
                </div>
            `;
            
            // Add click event
            element.addEventListener('click', function() {
                if (this.classList.contains('unread')) {
                    this.classList.remove('unread');
                    
                    // Send request to mark as read
                    const notificationId = this.getAttribute('data-id');
                    fetch(`/admin/notifications/mark-read/${notificationId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateNotificationCount();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
                
                this.style.animation = 'pulse 0.3s ease';
                setTimeout(() => {
                    this.style.animation = '';
                }, 300);
            });
            
            return element;
        }

        // Function to update notification count
        function updateNotificationCount() {
            fetch('{{ route("admin.notifications.getUnreadCount") }}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notificationCount');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error updating notification count:', error);
            });
        }

        // Function to load new notifications
        function loadNewNotifications() {
            loadNotifications();
        }

        // Set up real-time notification updates
        function setupRealTimeNotifications() {
            // Check for new notifications every 30 seconds
            setInterval(() => {
                if (!notificationDropdown.classList.contains('show')) {
                    updateNotificationCount();
                }
            }, 30000);
            
            // Set up Echo for real-time updates (if using Laravel Echo)
            if (typeof Echo !== 'undefined') {
                Echo.private('App.Models.Admin.{{ auth()->guard('admin')->user()->id }}')
                    .notification((notification) => {
                        // Create and add new notification
                        const notificationElement = createNotificationElement(notification);
                        
                        // Add to the top of the list
                        if (notificationList.children.length > 0 && notificationList.children[0].classList.contains('text-center')) {
                            // Replace "no notifications" message
                            notificationList.innerHTML = '';
                        }
                        
                        notificationList.insertBefore(notificationElement, notificationList.firstChild);
                        
                        // Animate new notification
                        notificationElement.style.animation = 'slideInRight 0.5s ease';
                        
                        // Update count
                        updateNotificationCount();
                        
                        // Show toast for new notification
                        showNotification(`Notifikasi baru: ${notification.title}`, 'info');
                        
                        // Animate bell
                        notificationBell.style.animation = 'shake 0.5s ease';
                        setTimeout(() => {
                            notificationBell.style.animation = '';
                        }, 500);
                    });
            }
        }

        // Initialize real-time notifications
        setupRealTimeNotifications();

        // Load notifications on page load
        loadNotifications();

        // Quick Search functionality
        if (quickSearch && quickSearchResults) {
            let searchTimeout;
            
            quickSearch.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();
                
                if (query.length < 2) {
                    quickSearchResults.classList.remove('show');
                    return;
                }
                
                searchTimeout = setTimeout(() => {
                    // Show loading
                    quickSearchResults.innerHTML = `
                        <div class="text-center py-3">
                            <i class="fas fa-spinner fa-spin text-muted mb-2"></i>
                            <p class="text-muted">Mencari...</p>
                        </div>
                    `;
                    quickSearchResults.classList.add('show');
                    
                    // Perform search
                    fetch(`/admin/search?q=${encodeURIComponent(query)}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.results && data.results.length > 0) {
                            quickSearchResults.innerHTML = '';
                            
                            data.results.forEach(result => {
                                const resultElement = document.createElement('div');
                                resultElement.className = 'search-result-item';
                                resultElement.innerHTML = `
                                    <div class="search-result-title">${result.title}</div>
                                    <div class="search-result-type">${result.type}</div>
                                `;
                                
                                resultElement.addEventListener('click', () => {
                                    window.location.href = result.url;
                                });
                                
                                quickSearchResults.appendChild(resultElement);
                            });
                        } else {
                            quickSearchResults.innerHTML = `
                                <div class="text-center py-3">
                                    <i class="fas fa-search text-muted mb-2"></i>
                                    <p class="text-muted">Tidak ada hasil untuk "${query}"</p>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error searching:', error);
                        quickSearchResults.innerHTML = `
                            <div class="text-center py-3 text-danger">
                                <i class="fas fa-exclamation-circle mb-2"></i>
                                <p>Terjadi kesalahan saat mencari</p>
                            </div>
                        `;
                    });
                }, 300);
            });
            
            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!quickSearch.contains(e.target) && !quickSearchResults.contains(e.target)) {
                    quickSearchResults.classList.remove('show');
                }
            });
        }

        // Server Status Widget functionality
        function updateServerStatus() {
            // Simulate server status updates
            const cpuUsage = Math.floor(Math.random() * 30) + 10;
            const memoryUsage = Math.floor(Math.random() * 40) + 30;
            const storageUsage = Math.floor(Math.random() * 20) + 70;
            
            document.getElementById('cpuUsage').textContent = `${cpuUsage}%`;
            document.getElementById('memoryUsage').textContent = `${memoryUsage}%`;
            document.getElementById('storageUsage').textContent = `${storageUsage}%`;
            
            // Update status indicators
            const cpuIndicator = document.querySelector('#serverStatusWidget .server-status-item:nth-child(2) .server-status-indicator');
            const memoryIndicator = document.querySelector('#serverStatusWidget .server-status-item:nth-child(3) .server-status-indicator');
            const storageIndicator = document.querySelector('#serverStatusWidget .server-status-item:nth-child(4) .server-status-indicator');
            
            cpuIndicator.className = `server-status-indicator ${cpuUsage > 80 ? 'status-danger' : cpuUsage > 60 ? 'status-warning' : 'status-good'}`;
            memoryIndicator.className = `server-status-indicator ${memoryUsage > 80 ? 'status-danger' : memoryUsage > 60 ? 'status-warning' : 'status-good'}`;
            storageIndicator.className = `server-status-indicator ${storageUsage > 80 ? 'status-danger' : storageUsage > 60 ? 'status-warning' : 'status-good'}`;
        }
        
        // Update server status every 10 seconds
        updateServerStatus();
        setInterval(updateServerStatus, 10000);

        // Keyboard Shortcuts Helper functionality
        if (shortcutsHelper && closeShortcuts) {
            closeShortcuts.addEventListener('click', function() {
                shortcutsHelper.classList.remove('show');
            });
        }

        // Floating Action Button functionality
if (fabMain && fabOptions) {
    let fabOpen = false;
    
    fabMain.addEventListener('click', function() {
        fabOpen = !fabOpen;
        fabOptions.classList.toggle('show', fabOpen);
        this.style.transform = fabOpen ? 'rotate(45deg)' : 'rotate(0)';
        
        // Add animation to options when opening
        if (fabOpen) {
            const fabOptionButtons = fabOptions.querySelectorAll('.fab-option');
            fabOptionButtons.forEach((btn, index) => {
                btn.style.animation = `fadeInUp 0.3s ease ${index * 0.1}s forwards`;
                btn.style.opacity = '0';
            });
        }
    });
    
    // Close FAB when clicking outside
    document.addEventListener('click', function(e) {
        if (!fabMain.contains(e.target) && !fabOptions.contains(e.target)) {
            fabOpen = false;
            fabOptions.classList.remove('show');
            fabMain.style.transform = 'rotate(0)';
        }
    });
    
    // Add click handlers to FAB options
    const fabOptionButtons = fabOptions.querySelectorAll('.fab-option');
    fabOptionButtons[0].addEventListener('click', () => {
        window.location.href = '{{ route("admin.siswa.create") }}';
    });
    
    fabOptionButtons[1].addEventListener('click', () => {
        window.location.href = '{{ route("admin.jurusan.create") }}';
    });
    
    fabOptionButtons[2].addEventListener('click', () => {
        window.location.href = '{{ route("admin.laporan.index") }}';
    });
    
    fabOptionButtons[3].addEventListener('click', () => {
        window.location.href = '{{ route("admin.pengaturan.index") }}';
    });
}

// Tambahkan CSS animation untuk fadeInUp
const fabStyle = document.createElement('style');
fabStyle.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(fabStyle);

        // Function to adjust server status widget position
function adjustServerStatusPosition() {
    const serverStatusWidget = document.getElementById('serverStatusWidget');
    const sidebar = document.getElementById('sidebar');
    
    if (serverStatusWidget && sidebar) {
        if (window.innerWidth >= 992) {
            if (sidebar.classList.contains('collapsed')) {
                serverStatusWidget.style.left = '110px'; // Position when sidebar is collapsed
            } else {
                serverStatusWidget.style.left = '300px'; // Position when sidebar is expanded
            }
        } else {
            serverStatusWidget.style.left = '20px'; // Position on mobile
        }
    }
}

// Call the function when sidebar state changes
toggleBtn.addEventListener('click', function() {
    setTimeout(adjustServerStatusPosition, 300); // Wait for animation to complete
});

// Call on window resize
window.addEventListener('resize', adjustServerStatusPosition);

// Initial position adjustment
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(adjustServerStatusPosition, 100);
});

        // Enhanced DataTables initialization
        if (typeof $ !== 'undefined' && $.fn.DataTable) {
            $('.datatable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                dom: '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
                pageLength: 10,
                order: [[0, 'desc']],
                initComplete: function() {
                    $(this.api().table().container()).addClass('animate-fade-in');
                    
                    // Animate rows on load
                    $(this.api().table().body()).find('tr').each(function(index) {
                        $(this).css({
                            'animation': `fadeIn 0.3s ease ${index * 0.05}s forwards`,
                            'opacity': '0'
                        });
                    });
                }
            });
        }

        // Intersection Observer for card animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-scale-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-card, .card, .quick-actions').forEach(element => {
            observer.observe(element);
        });

        // Add hover effect to table rows
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Smooth scroll to top button
        const scrollToTopBtn = document.createElement('button');
        scrollToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        scrollToTopBtn.className = 'scroll-to-top';
        scrollToTopBtn.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: var(--burgundy);
            border: none;
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.4);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            font-size: 1.2rem;
        `;

        document.body.appendChild(scrollToTopBtn);

        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.style.opacity = '1';
                scrollToTopBtn.style.visibility = 'visible';
            } else {
                scrollToTopBtn.style.opacity = '0';
                scrollToTopBtn.style.visibility = 'hidden';
            }
        });

        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        scrollToTopBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
            this.style.boxShadow = '0 6px 30px rgba(212, 175, 55, 0.6)';
        });

        scrollToTopBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
            this.style.boxShadow = '0 4px 20px rgba(212, 175, 55, 0.4)';
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Alt + D for dark mode toggle
            if (e.altKey && e.key === 'd') {
                e.preventDefault();
                darkModeToggle.click();
            }
            
            // Alt + M for sidebar toggle
            if (e.altKey && e.key === 'm') {
                e.preventDefault();
                toggleBtn.click();
            }
            
            // Alt + N for notifications
            if (e.altKey && e.key === 'n') {
                e.preventDefault();
                notificationBell.click();
            }
            
            // Alt + S for quick search
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                if (quickSearch) {
                    quickSearch.focus();
                }
            }
            
            // Alt + H for help/shortcuts
            if (e.altKey && e.key === 'h') {
                e.preventDefault();
                if (shortcutsHelper) {
                    shortcutsHelper.classList.toggle('show');
                }
            }
            
            // Escape to close popups
            if (e.key === 'Escape') {
                if (notificationDropdown.classList.contains('show')) {
                    notificationDropdown.classList.remove('show');
                }
                if (quickSearchResults.classList.contains('show')) {
                    quickSearchResults.classList.remove('show');
                }
                if (shortcutsHelper.classList.contains('show')) {
                    shortcutsHelper.classList.remove('show');
                }
                if (fabOptions.classList.contains('show')) {
                    fabOptions.classList.remove('show');
                    fabMain.style.transform = 'rotate(0)';
                }
            }
        });

        // Add tooltips to all elements with title attribute
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Enhanced form validation animations
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const invalidInputs = form.querySelectorAll(':invalid');
                
                if (invalidInputs.length > 0) {
                    invalidInputs.forEach(input => {
                        input.style.animation = 'shake 0.5s ease';
                        setTimeout(() => {
                            input.style.animation = '';
                        }, 500);
                    });
                }
            });
        });

        // Add CSS for additional animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            @keyframes fadeOut {
                to {
                    opacity: 0.5;
                    transform: translateX(-10px);
                }
            }
            
            @keyframes scaleOut {
                to {
                    transform: scale(0);
                    opacity: 0;
                }
            }
            
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);
    });

    // Enhanced confirm delete with SweetAlert2
    function confirmDelete(itemName = 'item') {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Data ${itemName} akan dihapus permanen dan tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#D4AF37',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash me-2"></i>Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times me-2"></i>Batal',
            customClass: {
                confirmButton: 'btn-delete-confirm',
                cancelButton: 'btn-delete-cancel'
            },
            backdrop: `
                rgba(0,0,0,0.8)
                left top
                no-repeat
            `,
            showClass: {
                popup: 'animate__animated animate__zoomIn animate__faster'
            },
            hideClass: {
                popup: 'animate__animated animate__zoomOut animate__faster'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                const form = document.getElementById('delete-form');
                if (form) {
                    form.submit();
                }
            }
        });
    }

    // Enhanced notification system
    function showNotification(message, type = 'success') {
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-times-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };

        const colors = {
            success: '#198754',
            error: '#dc3545',
            warning: '#ffc107',
            info: '#17a2b8'
        };

        const toast = document.createElement('div');
        toast.className = 'toast align-items-center border-0';
        toast.style.cssText = `
            background: white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            border-left: 5px solid ${colors[type]};
            border-radius: 12px;
            overflow: hidden;
        `;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex align-items-center p-3">
                <div class="me-3" style="color: ${colors[type]}; font-size: 1.5rem;">
                    <i class="fas ${icons[type]}"></i>
                </div>
                <div class="toast-body flex-grow-1" style="font-weight: 600;">
                    ${message}
                </div>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="progress" style="height: 3px;">
                <div class="progress-bar" role="progressbar" style="width: 100%; background: ${colors[type]}; animation: progress-decrease 5s linear;"></div>
            </div>
        `;
        
        let container = document.querySelector('.toast-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            container.style.zIndex = '9999';
            document.body.appendChild(container);
        }
        
        container.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast, {
            autohide: true,
            delay: 5000
        });
        
        toast.classList.add('animate__animated', 'animate__fadeInRight');
        bsToast.show();
        
        toast.addEventListener('hidden.bs.toast', function() {
            toast.classList.add('animate__fadeOutRight');
            setTimeout(() => toast.remove(), 300);
        });
        
        // Add progress animation
        const progressStyle = document.createElement('style');
        progressStyle.textContent = `
            @keyframes progress-decrease {
                from { width: 100%; }
                to { width: 0%; }
            }
        `;
        document.head.appendChild(progressStyle);
    }

    // Auto-show notifications from session
    @if(session('success'))
        showNotification("{{ session('success') }}", 'success');
    @endif

    @if(session('error'))
        showNotification("{{ session('error') }}", 'error');
    @endif

    @if(session('warning'))
        showNotification("{{ session('warning') }}", 'warning');
    @endif

    @if(session('info'))
        showNotification("{{ session('info') }}", 'info');
    @endif

    // Enhanced loading state for AJAX requests
    function showLoader() {
        const loader = document.getElementById('loader');
        if (loader) {
            loader.style.display = 'flex';
            loader.style.opacity = '1';
        }
    }

    function hideLoader() {
        const loader = document.getElementById('loader');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }
    }

    // Add global AJAX setup
    if (typeof $ !== 'undefined') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                showLoader();
            },
            complete: function() {
                hideLoader();
            },
            error: function(xhr) {
                if (xhr.status === 419) {
                    showNotification('Sesi Anda telah berakhir. Silakan refresh halaman.', 'error');
                } else if (xhr.status === 500) {
                    showNotification('Terjadi kesalahan server. Silakan coba lagi.', 'error');
                } else if (xhr.status === 403) {
                    showNotification('Anda tidak memiliki izin untuk melakukan aksi ini.', 'error');
                }
            }
        });
    }

    // Add print functionality
    function printReport(elementId) {
        const element = document.getElementById(elementId);
        if (!element) return;
        
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Cetak Laporan</title>');
        printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">');
        printWindow.document.write('<style>body { padding: 20px; } @media print { .no-print { display: none; } }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(element.innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        
        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 250);
    }

    // Add export to CSV functionality
    function exportTableToCSV(tableId, filename = 'export.csv') {
        const table = document.getElementById(tableId);
        if (!table) return;
        
        let csv = [];
        const rows = table.querySelectorAll('tr');
        
        rows.forEach(row => {
            const cols = row.querySelectorAll('td, th');
            const csvRow = [];
            cols.forEach(col => csvRow.push(col.innerText));
            csv.push(csvRow.join(','));
        });
        
        const csvContent = csv.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.setAttribute('hidden', '');
        a.setAttribute('href', url);
        a.setAttribute('download', filename);
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        
        showNotification('Data berhasil diekspor ke CSV', 'success');
    }
</script>

@stack('scripts')
</body>
</html>
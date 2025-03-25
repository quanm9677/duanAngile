<!-- Core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
<!-- ... các CSS khác ... -->

<style>
    /* Layout chính */
    body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        background: #f8f9fa;
    }

    /* Sidebar styles */
    .left-panel {
        width: 280px; /* Tăng width lên */
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        background: #2a3042; /* Màu nền tối */
        z-index: 1000;
        overflow-y: auto;
    }

    /* Logo area */
    .navbar-brand {
        padding: 10px 15px;
        border-bottom: 1px solid #dee2e6;
        width: 100%;
        display: flex;
        align-items: center;
    }

    .navbar-brand h4 {
        font-size: 16px;
        margin: 0;
    }

    /* Menu items */
    .nav-item {
        width: 100%;
    }

    .nav-link {
        padding: 12px 20px;
        color: #a6b0cf !important; /* Màu text nhạt */
        display: flex;
        align-items: center;
        font-size: 15px;
        border-left: 3px solid transparent;
        transition: all 0.3s;
    }

    .nav-link:hover, 
    .nav-link.active {
        color: #fff !important;
        background: rgba(255,255,255,0.05);
        border-left-color: #556ee6;
    }

    .nav-link i {
        width: 20px;
        margin-right: 10px;
        font-size: 16px;
    }

    /* Dropdown items */
    .collapse.nav {
        padding-left: 15px;
        border-left: 2px solid #dee2e6;
    }

    .collapse.nav .nav-link {
        padding-left: 15px;
        font-size: 13px;
    }

    /* Right panel adjustment */
    .right-panel {
        margin-left: 280px;
        padding: 0; /* Removed padding */
    }

    /* Content container */
    .content-wrapper {
        padding: 20px;
    }

    /* Content area */
    .content {
        background: #fff;
        padding: 20px;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    /* Table adjustments */
    .table {
        font-size: 14px;
    }

    /* Action Buttons */
    .btn {
        padding: 5px 10px;
        border-radius: 4px;
        margin: 0 2px;
    }

    .btn-primary { background: #007bff; color: #fff; }
    .btn-warning { background: #ffc107; color: #000; }
    .btn-danger { background: #dc3545; color: #fff; }

    /* Header Title */
    .content-header {
        margin-bottom: 20px;
    }

    .content-header h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 500;
    }

    /* Stats cards */
    .stats-card {
        background: #fff;
        border-radius: 4px;
        padding: 20px;
        margin-bottom: 24px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .stats-card h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 500;
    }

    .stats-card span {
        color: #6c757d;
        font-size: 14px;
    }

    /* Chart container */
    .chart-container {
        background: #fff;
        border-radius: 4px;
        padding: 20px;
        margin-top: 24px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    /* Search bar styles */
    .header-search {
        padding: 15px 20px;
        background: #fff;
        border-bottom: 1px solid #e5e5e5;
    }

    .search-container {
        max-width: 100%;
        margin: 0 auto;
    }

    .search-form .input-group {
        width: 100%;
    }

    .search-form .form-control {
        height: 40px;
        border-radius: 4px 0 0 4px;
        border: 1px solid #ced4da;
        padding: 0 15px;
        font-size: 14px;
    }

    .search-form .btn {
        border-radius: 0 4px 4px 0;
        border: 1px solid #ced4da;
        border-left: none;
        background: #fff;
        color: #6c757d;
    }

    .search-form .btn:hover {
        background: #f8f9fa;
        color: #0d6efd;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .left-panel {
            transform: translateX(-280px);
        }

        .left-panel.show {
            transform: translateX(0);
        }

        .right-panel {
            margin-left: 0;
        }

        .search-container {
            width: 100%;
        }
    }
</style>
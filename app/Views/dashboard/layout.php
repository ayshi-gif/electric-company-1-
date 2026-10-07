<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= isset($title) ? esc($title) : 'Staff Dashboard | Puihaha Electric' ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --purple: #8064bf;
            --purple-dark: #5a438f;
            --purple-soft: #eee7ff;
            --purple-pale: #faf8ff;
            --ink: #2d2737;
            --muted: #746d80;
            --line: #ece7f4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--purple-pale);
            color: var(--ink);
            font-family: "Segoe UI", system-ui, sans-serif;
        }

        .dashboard-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
        }

        .dashboard-sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            background: #fff;
            border-right: 1px solid var(--line);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: .65rem;
            padding: .35rem .55rem 1.4rem;
            color: var(--ink);
            font-weight: 800;
            text-decoration: none;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            color: white;
            background: linear-gradient(135deg, #9d82d8, #6d50aa);
            box-shadow: 0 8px 16px rgba(112, 82, 173, .22);
        }

        .brand-copy small {
            display: block;
            color: var(--muted);
            font-size: .68rem;
            font-weight: 650;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .create-account {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: .25rem .35rem 1.55rem;
            padding: .7rem .8rem .7rem 1rem;
            color: var(--purple-dark);
            background: var(--purple-soft);
            border-radius: 15px;
            font-size: .9rem;
            font-weight: 750;
            text-decoration: none;
        }

        .create-account span:last-child {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: white;
            background: var(--purple);
        }

        .menu-label {
            margin: 0 .85rem .45rem;
            color: #aaa1b6;
            font-size: .68rem;
            font-weight: 750;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .dashboard-menu {
            display: grid;
            gap: .35rem;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .72rem .85rem;
            border-radius: 12px;
            color: #60586d;
            font-size: .91rem;
            font-weight: 650;
            text-decoration: none;
        }

        .menu-link:hover,
        .menu-link.active {
            color: var(--purple-dark);
            background: #f3effc;
        }

        .menu-link i {
            color: #978bad;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 1rem .35rem .1rem;
            border-top: 1px solid var(--line);
        }

        .staff-name {
            color: var(--muted);
            font-size: .78rem;
        }

        .staff-name strong {
            display: block;
            color: var(--ink);
            font-size: .86rem;
        }

        .logout-link {
            width: 100%;
            margin-top: .75rem;
            padding: .55rem .3rem;
            border: 0;
            background: transparent;
            color: #7d728c;
            text-align: left;
            font-size: .85rem;
            font-weight: 650;
        }

        .logout-link:hover {
            color: var(--purple-dark);
        }

        .dashboard-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 78px;
            padding: 1rem clamp(1.25rem, 4vw, 3.4rem);
            background: rgba(255, 255, 255, .82);
            border-bottom: 1px solid var(--line);
        }

        .page-kicker {
            color: var(--muted);
            font-size: .77rem;
            font-weight: 650;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .page-title {
            margin: .08rem 0 0;
            font-size: 1.08rem;
            font-weight: 800;
        }

        .topbar-link {
            color: var(--purple-dark);
            font-size: .86rem;
            font-weight: 700;
            text-decoration: none;
        }

        .content-area {
            max-width: 1350px;
            margin: 0 auto;
            padding: clamp(1.25rem, 3vw, 2.5rem);
        }

        .dashboard-hero {
            position: relative;
            overflow: hidden;
            min-height: 170px;
            padding: 2rem 2.1rem;
            border: 1px solid #e3d8fb;
            border-radius: 25px;
            background: linear-gradient(115deg, #eee7ff, #e4d9fb);
        }

        .dashboard-hero::after {
            content: "⚡";
            position: absolute;
            right: 3.2rem;
            bottom: .35rem;
            color: rgba(109, 80, 170, .18);
            font: 7.2rem/1 sans-serif;
        }

        .dashboard-hero h1 {
            color: #33264c;
        }

        .dashboard-hero .text-white-50 {
            color: #675b78 !important;
        }

        .dashboard-hero .text-warning {
            color: #7557af !important;
        }

        .stat-card,
        .dashboard-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: white;
            box-shadow: 0 9px 24px rgba(59, 41, 85, .055);
        }

        .stat-card .card-body {
            padding: 1.15rem;
        }

        .stat-total {
            background: #f0eaff;
        }

        .stat-active {
            background: #e6f7ef;
        }

        .stat-inactive {
            background: #fff0f6;
        }

        .stat-suspended {
            background: #fff6e2;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            font-size: 1.2rem;
        }

        .stat-total .stat-icon {
            color: #6847a6;
            background: #ddd0fa;
        }

        .stat-active .stat-icon {
            color: #237758;
            background: #c9eddd;
        }

        .stat-inactive .stat-icon {
            color: #b44977;
            background: #ffd6e7;
        }

        .stat-suspended .stat-icon {
            color: #a97517;
            background: #ffe9b5;
        }

        .stat-value {
            color: var(--ink);
            font-size: 1.65rem;
            font-weight: 800;
            line-height: 1;
        }

        .filter-panel {
            background: #fbf9ff;
            border: 1px solid #eee9f7;
            border-radius: 15px;
        }

        .btn {
            border-radius: 11px;
            font-weight: 700;
        }

        .btn-primary,
        .btn-energy {
            color: white;
            background: var(--purple);
            border-color: var(--purple);
        }

        .btn-primary:hover,
        .btn-energy:hover {
            color: white;
            background: var(--purple-dark);
            border-color: var(--purple-dark);
        }

        .btn-outline-primary {
            color: var(--purple);
            border-color: #cfc0ed;
        }

        .btn-outline-primary:hover {
            background: var(--purple);
            border-color: var(--purple);
        }

        .btn-outline-secondary {
            color: #6e647b;
            border-color: #ddd6e8;
        }

        .btn-outline-secondary:hover {
            color: var(--ink);
            background: #eee9f5;
            border-color: #eee9f5;
        }

        .form-control,
        .form-select {
            border-color: #e1dbea;
            border-radius: 11px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ad97de;
            box-shadow: 0 0 0 .2rem rgba(128, 100, 191, .14);
        }

        .table thead th {
            padding: .9rem .75rem;
            background: #f6f2fd;
            border-bottom: 0;
            color: #6b607a;
            font-size: .73rem;
            letter-spacing: .06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table> :not(caption)>*>* {
            padding: 1rem .75rem;
            border-color: #f0ecf5;
            vertical-align: middle;
        }

        .table-hover>tbody>tr:hover>* {
            background: #fcfaff;
        }

        .badge {
            padding: .45rem .65rem;
            border-radius: 9px;
            font-weight: 700;
        }

        .badge-active {
            color: #237758;
            background: #d6f2e5;
        }

        .badge-inactive {
            color: #ae3c70;
            background: #ffe0ec;
        }

        .badge-suspended {
            color: #946613;
            background: #ffefc8;
        }

        .badge-type {
            color: #67499f;
            background: #eee7ff;
        }

        .account-info {
            min-height: 93px;
            padding: 1rem;
            border: 1px solid #eee9f5;
            border-radius: 14px;
            background: #fcfbfe;
        }

        .account-info .label {
            color: #877d94;
            font-size: .72rem;
            font-weight: 750;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .pagination .page-link {
            color: var(--purple);
            border-color: #e7e0f2;
        }

        .pagination .active .page-link {
            background: var(--purple);
            border-color: var(--purple);
        }

        .alert {
            border: 0;
            border-radius: 13px;
        }

        .alert-success {
            color: #24674f;
            background: #e2f4e9;
        }

        .alert-danger {
            color: #9e365d;
            background: #ffe5ee;
        }

        .text-primary {
            color: var(--purple) !important;
        }

        @media (max-width: 900px) {
            .dashboard-shell {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                position: static;
                height: auto;
                padding: 1rem;
                border-right: 0;
                border-bottom: 1px solid var(--line);
            }

            .brand {
                padding-bottom: .8rem;
            }

            .create-account,
            .menu-label,
            .sidebar-bottom {
                display: none;
            }

            .dashboard-menu {
                display: flex;
                flex-wrap: wrap;
            }

            .menu-link {
                padding: .55rem .7rem;
            }
        }

        @media (max-width: 575px) {
            .content-area {
                padding: 1rem;
            }

            .dashboard-hero {
                padding: 1.5rem;
            }

            .dashboard-hero::after {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-shell">
        <aside class="dashboard-sidebar">
            <a class="brand" href="<?= esc(site_url('dashboard'), 'attr') ?>">
                <span class="brand-mark"><i class="bi bi-lightning-charge-fill"></i></span>
                <span class="brand-copy">
                    Puihaha Electric
                    <small>Staff Portal</small>
                </span>
            </a>

            <a class="create-account" href="<?= esc(site_url('account/new'), 'attr') ?>">
                <span>Create account</span>
                <span><i class="bi bi-plus-lg"></i></span>
            </a>

            <p class="menu-label">Workspace</p>

            <nav class="dashboard-menu">
                <a class="menu-link active" href="<?= esc(site_url('dashboard'), 'attr') ?>">
                    <i class="bi bi-grid-1x2"></i>Dashboard
                </a>

                <a class="menu-link" href="<?= esc(site_url(), 'attr') ?>">
                    <i class="bi bi-house"></i>Public website
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="staff-name">
                    <strong>
                        <?= esc((string) session()->get('user_name')) ?>
                    </strong>
                    Administrator
                </div>

                <form method="post" action="<?= esc(site_url('logout'), 'attr') ?>">
                    <?= csrf_field() ?>
                    <button class="logout-link" type="submit">
                        <i class="bi bi-box-arrow-right me-1"></i>Log out
                    </button>
                </form>
            </div>
        </aside>

        <div>
            <header class="dashboard-topbar">
                <div>
                    <div class="page-kicker">Puihaha Electric</div>
                    <p class="page-title">Customer management</p>
                </div>

                <a class="topbar-link" href="<?= esc(site_url(), 'attr') ?>">
                    <i class="bi bi-box-arrow-up-right me-1"></i>View website
                </a>
            </header>

            <main class="content-area">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
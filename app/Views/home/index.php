<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<section class="dashboard-hero mb-4">
    <div class="position-relative" style="z-index: 1;">
        <p class="text-uppercase small fw-semibold text-warning mb-2">Operations center</p>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
            <div>
                <h1 class="h2 fw-bold mb-2">Customer Account Dashboard</h1>
                <p class="mb-0 text-white-50">
                    Search, add, update, and manage Puihaha Electric customer accounts.
                </p>
            </div>

            <a class="btn btn-energy" href="<?= esc(site_url('account/new'), 'attr') ?>">
                <i class="bi bi-plus-circle me-1"></i>Add Account
            </a>
        </div>
    </div>
</section>

<?= view('home/messages') ?>

<section class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card stat-total h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <span class="stat-icon"><i class="bi bi-people"></i></span>
                <div>
                    <div class="stat-value"><?= esc($total_accounts) ?></div>
                    <div class="text-muted small">Total accounts</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card stat-active h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <span class="stat-icon"><i class="bi bi-check-circle"></i></span>
                <div>
                    <div class="stat-value"><?= esc($active_accounts) ?></div>
                    <div class="text-muted small">Active accounts</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card stat-inactive h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <span class="stat-icon"><i class="bi bi-pause-circle"></i></span>
                <div>
                    <div class="stat-value"><?= esc($inactive_accounts) ?></div>
                    <div class="text-muted small">Inactive accounts</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card stat-suspended h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <span class="stat-icon"><i class="bi bi-exclamation-circle"></i></span>
                <div>
                    <div class="stat-value"><?= esc($suspended_accounts) ?></div>
                    <div class="text-muted small">Suspended accounts</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="card dashboard-card mb-4">
    <div class="card-body p-3 p-lg-4">
        <form class="filter-panel p-3" method="get" action="<?= esc(site_url('dashboard'), 'attr') ?>">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-semibold" for="search">Find an account</label>
                    <input class="form-control" id="search" name="search" value="<?= esc($search_keyword, 'attr') ?>"
                        placeholder="Name, account no., email, or phone">
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-semibold" for="status">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All status</option>
                        <option value="active" <?= $filter_status === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $filter_status === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        <option value="suspended" <?= $filter_status === 'suspended' ? 'selected' : '' ?>>Suspended
                        </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold" for="type">Connection type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">All types</option>
                        <option value="residential" <?= $filter_type === 'residential' ? 'selected' : '' ?>>Residential
                        </option>
                        <option value="commercial" <?= $filter_type === 'commercial' ? 'selected' : '' ?>>Commercial
                        </option>
                        <option value="industrial" <?= $filter_type === 'industrial' ? 'selected' : '' ?>>Industrial
                        </option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1" type="submit">
                        <i class="bi bi-search me-1"></i>Search
                    </button>

                    <?php if ($search_keyword !== '' || $filter_status !== '' || $filter_type !== ''): ?>
                        <a class="btn btn-outline-secondary" href="<?= esc(site_url('dashboard'), 'attr') ?>">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="card dashboard-card overflow-hidden">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-4 px-3 px-lg-4">
        <div>
            <h2 class="h5 mb-1">Customer accounts</h2>
            <p class="text-muted small mb-0">
                <?= esc($filtered_total) ?> matching record<?= (int) $filtered_total === 1 ? '' : 's' ?>
            </p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Account</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Connection</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($accounts === []): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-search fs-3 d-block mb-2"></i>
                            No customer accounts match these filters.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($accounts as $account): ?>
                        <tr>
                            <td>
                                <span class="fw-semibold d-block"><?= esc($account['account_number']) ?></span>
                                <small class="text-muted">Meter <?= esc($account['meter_number']) ?></small>
                            </td>

                            <td><?= esc($account['customer_name']) ?></td>

                            <td>
                                <a href="mailto:<?= esc($account['email'], 'attr') ?>" class="text-decoration-none d-block">
                                    <?= esc($account['email']) ?>
                                </a>
                                <small class="text-muted"><?= esc($account['phone']) ?></small>
                            </td>

                            <td>
                                <span class="badge badge-type">
                                    <?= esc(ucfirst($account['connection_type'])) ?>
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-<?= esc($account['status'], 'attr') ?>">
                                    <?= esc(ucfirst($account['status'])) ?>
                                </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="<?= esc(site_url('account/' . (int) $account['id']), 'attr') ?>"
                                        title="View account">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a class="btn btn-sm btn-outline-secondary"
                                        href="<?= esc(site_url('account/' . (int) $account['id'] . '/edit'), 'attr') ?>"
                                        title="Edit account">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a class="btn btn-sm btn-outline-danger"
                                        href="<?= esc(site_url('account/' . (int) $account['id'] . '/delete'), 'attr') ?>"
                                        title="Delete account">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pager && (int) $filtered_total > 0): ?>
        <div
            class="card-footer bg-white border-0 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 p-3 p-lg-4">
            <small class="text-muted">
                Page <?= esc($current_page) ?> of <?= esc($pager->getPageCount()) ?>
            </small>

            <?= $pager->only(['search', 'status', 'type'])->links() ?>
        </div>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>
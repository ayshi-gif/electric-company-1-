<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<section class="dashboard-hero mb-4">
    <div class="position-relative" style="z-index: 1;">
        <p class="text-uppercase small fw-semibold text-warning mb-2">Customer management</p>
        <h1 class="h2 fw-bold mb-1">Delete Customer Account</h1>
        <p class="text-white-50 mb-0">
            Review the selected record before confirming this action.
        </p>
    </div>
</section>

<?= view('home/messages') ?>

<section class="card dashboard-card border border-danger-subtle">
    <div class="card-body p-3 p-md-4 p-lg-5">
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>This action cannot be undone.</strong>
            Deleting removes this account from the customer database.
        </div>

        <dl class="row mb-4">
            <dt class="col-sm-4 text-muted">Customer Name</dt>
            <dd class="col-sm-8 fw-semibold"><?= esc($account['customer_name']) ?></dd>

            <dt class="col-sm-4 text-muted">Account Number</dt>
            <dd class="col-sm-8"><?= esc($account['account_number']) ?></dd>

            <dt class="col-sm-4 text-muted">Meter Number</dt>
            <dd class="col-sm-8"><?= esc($account['meter_number']) ?></dd>
        </dl>

        <form method="post" action="<?= esc(site_url('account/' . (int) $account['id'] . '/delete'), 'attr') ?>">
            <?= csrf_field() ?>

            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-danger" type="submit">
                    <i class="bi bi-trash me-1"></i>Yes, Delete Account
                </button>

                <a class="btn btn-outline-secondary"
                    href="<?= esc(site_url('account/' . (int) $account['id']), 'attr') ?>">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

<?= $this->endSection() ?>
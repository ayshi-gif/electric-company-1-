<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<section class="dashboard-hero mb-4">
    <div class="position-relative" style="z-index: 1;">
        <p class="text-uppercase small fw-semibold text-warning mb-2">Customer record</p>
        <h1 class="h2 fw-bold mb-1"><?= esc($account['customer_name']) ?></h1>
        <p class="text-white-50 mb-0">
            Account <?= esc($account['account_number']) ?> · Meter <?= esc($account['meter_number']) ?>
        </p>
    </div>
</section>

<?= view('home/messages') ?>

<section class="card dashboard-card">
    <div class="card-body p-3 p-md-4 p-lg-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mb-4">
            <a class="btn btn-outline-secondary align-self-sm-start" href="<?= esc(site_url('dashboard'), 'attr') ?>">
                <i class="bi bi-arrow-left me-1"></i>Dashboard
            </a>

            <div class="d-flex gap-2">
                <a class="btn btn-primary"
                    href="<?= esc(site_url('account/' . (int) $account['id'] . '/edit'), 'attr') ?>">
                    <i class="bi bi-pencil-square me-1"></i>Edit
                </a>

                <a class="btn btn-outline-danger"
                    href="<?= esc(site_url('account/' . (int) $account['id'] . '/delete'), 'attr') ?>">
                    <i class="bi bi-trash me-1"></i>Delete
                </a>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Account Number</div>
                    <div class="fw-semibold fs-5 mt-1"><?= esc($account['account_number']) ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Status</div>
                    <div class="mt-2">
                        <span class="badge badge-<?= esc($account['status'], 'attr') ?>">
                            <?= esc(ucfirst($account['status'])) ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="account-info">
                    <div class="label">Customer Name</div>
                    <div class="fw-semibold fs-5 mt-1"><?= esc($account['customer_name']) ?></div>
                </div>
            </div>

            <div class="col-12">
                <div class="account-info">
                    <div class="label">Service Address</div>
                    <div class="mt-1"><?= esc($account['address']) ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Phone Number</div>
                    <div class="mt-1">
                        <i class="bi bi-telephone me-1 text-primary"></i>
                        <?= esc($account['phone']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Email Address</div>
                    <div class="mt-1 text-break">
                        <i class="bi bi-envelope me-1 text-primary"></i>
                        <a href="mailto:<?= esc($account['email'], 'attr') ?>">
                            <?= esc($account['email']) ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Meter Number</div>
                    <div class="mt-1"><?= esc($account['meter_number']) ?></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Connection Type</div>
                    <div class="mt-2">
                        <span class="badge badge-type">
                            <?= esc(ucfirst($account['connection_type'])) ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Created</div>
                    <div class="mt-1">
                        <?= esc(!empty($account['created_at']) ? date('F j, Y, g:i A', strtotime($account['created_at'])) : 'Not available') ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="account-info">
                    <div class="label">Last Updated</div>
                    <div class="mt-1">
                        <?= esc(!empty($account['updated_at']) ? date('F j, Y, g:i A', strtotime($account['updated_at'])) : 'Not available') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
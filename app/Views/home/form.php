<?php
$pageTitle = $is_edit ? 'Edit Customer Account' : 'Add Customer Account';
$formAction = $is_edit
    ? site_url('account/' . (int) $account['id'] . '/update')
    : site_url('account');

$cancelUrl = $is_edit
    ? site_url('account/' . (int) $account['id'])
    : site_url('dashboard');

$selectedStatus = $account['status'] ?? ($is_edit ? '' : 'active');
$selectedType = $account['connection_type'] ?? ($is_edit ? '' : 'residential');
?>

<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>

<section class="dashboard-hero mb-4">
    <div class="position-relative" style="z-index: 1;">
        <p class="text-uppercase small fw-semibold text-warning mb-2">Customer management</p>
        <h1 class="h2 fw-bold mb-1"><?= esc($pageTitle) ?></h1>
        <p class="text-white-50 mb-0">
            Enter the account details carefully. Account and meter numbers must be unique.
        </p>
    </div>
</section>

<?= view('home/messages') ?>

<section class="card dashboard-card">
    <div class="card-body p-3 p-md-4 p-lg-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h5 mb-1">Account information</h2>
                <p class="text-muted small mb-0">All fields are required.</p>
            </div>

            <a class="btn btn-sm btn-outline-secondary" href="<?= esc($cancelUrl, 'attr') ?>">
                <i class="bi bi-arrow-left me-1"></i>Cancel
            </a>
        </div>

        <?php if ($errors !== []): ?>
            <div class="alert alert-danger">
                <strong>Please correct the following:</strong>
                <ul class="mb-0 mt-2">
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= esc($formAction, 'attr') ?>">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="account_number">Account Number</label>
                    <input class="form-control<?= isset($errors['account_number']) ? ' is-invalid' : '' ?>"
                        id="account_number" name="account_number" maxlength="20"
                        value="<?= esc($account['account_number'] ?? '', 'attr') ?>" required>
                    <?php if (isset($errors['account_number'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['account_number']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="meter_number">Meter Number</label>
                    <input class="form-control<?= isset($errors['meter_number']) ? ' is-invalid' : '' ?>"
                        id="meter_number" name="meter_number" maxlength="20"
                        value="<?= esc($account['meter_number'] ?? '', 'attr') ?>" required>
                    <?php if (isset($errors['meter_number'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['meter_number']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold" for="customer_name">Customer Name</label>
                    <input class="form-control<?= isset($errors['customer_name']) ? ' is-invalid' : '' ?>"
                        id="customer_name" name="customer_name" maxlength="100"
                        value="<?= esc($account['customer_name'] ?? '', 'attr') ?>" autocomplete="name" required>
                    <?php if (isset($errors['customer_name'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['customer_name']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold" for="address">Service Address</label>
                    <textarea class="form-control<?= isset($errors['address']) ? ' is-invalid' : '' ?>" id="address"
                        name="address" rows="3" maxlength="1000" autocomplete="street-address"
                        required><?= esc($account['address'] ?? '') ?></textarea>
                    <?php if (isset($errors['address'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['address']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="phone">Phone Number</label>
                    <input class="form-control<?= isset($errors['phone']) ? ' is-invalid' : '' ?>" id="phone"
                        name="phone" maxlength="20" value="<?= esc($account['phone'] ?? '', 'attr') ?>"
                        autocomplete="tel" required>
                    <?php if (isset($errors['phone'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['phone']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="email">Email Address</label>
                    <input class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" type="email"
                        id="email" name="email" maxlength="100" value="<?= esc($account['email'] ?? '', 'attr') ?>"
                        autocomplete="email" required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="connection_type">Connection Type</label>
                    <select class="form-select<?= isset($errors['connection_type']) ? ' is-invalid' : '' ?>"
                        id="connection_type" name="connection_type" required>
                        <option value="">Choose a type</option>
                        <option value="residential" <?= $selectedType === 'residential' ? 'selected' : '' ?>>Residential
                        </option>
                        <option value="commercial" <?= $selectedType === 'commercial' ? 'selected' : '' ?>>Commercial
                        </option>
                        <option value="industrial" <?= $selectedType === 'industrial' ? 'selected' : '' ?>>Industrial
                        </option>
                    </select>
                    <?php if (isset($errors['connection_type'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['connection_type']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="status">Account Status</label>
                    <select class="form-select<?= isset($errors['status']) ? ' is-invalid' : '' ?>" id="status"
                        name="status" required>
                        <option value="">Choose a status</option>
                        <option value="active" <?= $selectedStatus === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $selectedStatus === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        <option value="suspended" <?= $selectedStatus === 'suspended' ? 'selected' : '' ?>>Suspended
                        </option>
                    </select>
                    <?php if (isset($errors['status'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['status']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-lg me-1"></i>
                    <?= $is_edit ? 'Save Changes' : 'Create Account' ?>
                </button>

                <a class="btn btn-outline-secondary" href="<?= esc($cancelUrl, 'attr') ?>">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

<?= $this->endSection() ?>
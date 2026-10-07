<?php $successMessage = session()->getFlashdata('success'); ?>
<?php if (is_string($successMessage) && $successMessage !== ''): ?>
    <div class="alert alert-success" role="status">
        <i class="bi bi-check-circle"></i> <?= esc($successMessage) ?>
    </div>
<?php endif; ?>
<?php $errorMessage = session()->getFlashdata('error'); ?>
<?php if (is_string($errorMessage) && $errorMessage !== ''): ?>
    <div class="alert alert-danger" role="alert">
        <i class="bi bi-exclamation-triangle"></i> <?= esc($errorMessage) ?>
    </div>
<?php endif; ?>

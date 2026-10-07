<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<section class="hero-section py-5">
    <div class="container py-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-6">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="card-body p-4 p-md-5 text-dark">
                        <div class="text-center mb-4">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-bolt"></i>
                            </div>

                            <p class="text-uppercase small fw-semibold text-primary-custom mb-1">
                                Puihaha Electric Staff Portal
                            </p>

                            <h1 class="h3 text-primary-custom mb-2">Welcome Back</h1>

                            <p class="text-muted mb-0">
                                Sign in to manage customer accounts securely.
                            </p>
                        </div>

                        <?php $error = session()->getFlashdata('error'); ?>
                        <?php if (is_string($error) && $error !== ''): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-circle-exclamation me-2"></i>
                                <?= esc($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php $success = session()->getFlashdata('success'); ?>
                        <?php if (is_string($success) && $success !== ''): ?>
                            <div class="alert alert-success" role="status">
                                <i class="fas fa-circle-check me-2"></i>
                                <?= esc($success) ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="<?= esc(site_url('login'), 'attr') ?>">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input class="form-control form-control-lg" type="email" id="email" name="email"
                                    value="<?= esc(old('email'), 'attr') ?>" autocomplete="email" required autofocus>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input class="form-control form-control-lg" type="password" id="password"
                                    name="password" autocomplete="current-password" required>
                            </div>

                            <button class="btn btn-primary w-100" type="submit">
                                <i class="fas fa-right-to-bracket me-2"></i>
                                Log In to Dashboard
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="<?= esc(site_url(), 'attr') ?>"
                                class="text-primary-custom text-decoration-none fw-semibold">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back to Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?php
$userEmail = $_SESSION['user_email'] ?? '';
?>

<body>
    <section class="navbar-section">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= BASE_URL ?>">My Weblog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>/posts">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/categories">Category</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">

                        <?php if (isLoggedin()): ?>
                            <h6 class="mb-0"><?= $userEmail ?></h6>
                            <a href="<?= BASE_URL ?>/users/logout" class="btn btn-sm btn-secondary ms-2">Logout</a>
                        <?php else: ?>
                            <a href="<?= BASE_URL ?>/users/login-form" class="btn btn-sm btn-outline-dark">Login</a>
                            <a href="<?= BASE_URL ?>/users/register" class="btn btn-sm btn-secondary ms-2">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </section>
<?php
$formErrors = [
    'email' => $_SESSION['user_login_form']['email'] ?? "",
    'password' => $_SESSION['user_login_form']['password'] ?? "",
];
unset($_SESSION['user_login_form']);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="">Login</h5>
                </div>
                <div class="card-body">
                    <form action="<?= BASE_URL ?>/users/login" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                             <?php if (isset($formErrors['email'])): ?>
                                <div class="form-text text-danger">
                                    <?= $formErrors['email'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                             <?php if (isset($formErrors['password'])): ?>
                                <div class="form-text text-danger">
                                    <?= $formErrors['password'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-secondary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
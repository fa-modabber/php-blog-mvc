<?php

$formErrors = [
    'title' => $_SESSION['category_create_form']['title'] ?? "",
];
unset($_SESSION['category_create_form']);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="">Create Category</h5>
                    <a href="<?= BASE_URL ?>/categories" class="btn btn-dark">back</a>
                </div>

                <div class="card-body">
                    <form action="<?= BASE_URL ?>/categories/store" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control">
                            <?php if (isset($formErrors['title'])): ?>
                                <div class="form-text text-danger">
                                    <?= $formErrors['title'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
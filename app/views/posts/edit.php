<?php

$formErrors = [
    'title' => $_SESSION['post_edit_form']['title'] ?? "",
    'category_id' => $_SESSION['post_edit_form']['category_id'] ?? "",
    'body' => $_SESSION['post_edit_form']['body'] ?? "",
];
unset($_SESSION['post_edit_form']);
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="">Edit Post</h5>
                    <a href="<?= BASE_URL ?>/posts" class="btn btn-dark">back</a>
                </div>

                <div class="card-body">
                    <form action="<?= BASE_URL ?>/posts/update/<?= $post->id ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" value="<?= $post->title ?>" class="form-control">
                            <?php if (isset($formErrors['title'])): ?>
                                <div class="form-text text-danger">
                                    <?= $formErrors['title'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select type="text" name="category_id" class="form-select">
                                <?php foreach ($categories as $category) : ?>
                                    <option <?= $post->category_id == $category->id ? 'selected' : '' ?> value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($formErrors['category_id'])): ?>
                                <div class="form-text text-danger">
                                    <?= $formErrors['category_id'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Body</label>
                            <textarea type="text" name="body" class="form-control" rows="3"><?= $post->body ?></textarea>
                            <?php if (isset($formErrors['body'])): ?>
                                <div class="form-text text-danger">
                                    <?= $formErrors['body'] ?>
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

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12 col-md-4">
            <form action="<?= BASE_URL ?>/posts/search" class="input-group me-3" method="GET">
                <input type="text" name="query" class="form-control" placeholder="keyword ...">
                <button type="submit" class="input-group-text btn btn-dark">search</button>
            </form>
        </div>
        <div class="col-12 col-md-2">
            <a href="<?= BASE_URL ?>/posts" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row g-3 justify-content-center mb-4">
        <?php if (empty($posts)): ?>
            <div class="alert alert-danger">
                No result found for search term [<strong> <?= $query ?> </strong>]
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post) : ?>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $post->title ?></h5>

                            <div class="card-subtitle mb-2 badge text-bg-secondary"><?= $post->category_title ?></div>

                            <p class="card-text"><?= $post->body ?></p>

                            <div class="d-flex align-items-center">
                                <a href="<?= BASE_URL ?>/posts/edit/<?= $post->id ?>" class="card-link">Edit post</a>
                                <form class="mb-0" action="<?= BASE_URL ?>/posts/delete/<?= $post->id ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $post->id ?>">

                                    <button type="submit" class="btn btn-link text-danger">Delete Post</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif; ?>


    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-auto">
            <nav>
                <ul class="pagination pagination-sm">
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
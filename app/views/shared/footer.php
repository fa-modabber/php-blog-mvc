<?php

?>

<section class="footer">
    <div class="d-flex flex-column text-center  pt-md-3 border-top">
        <div class="">
            <p>all rights reserved for Fatemeh Modabber</p>
        </div>
        <div class="p-2"><a href="#"><i class="bi bi-telegram fs-3 text-secondary ms-2"></i></a>
            <a href="#"><i class="bi bi-whatsapp fs-3 text-secondary ms-2"></i></a>
            <a href="#"><i class="bi bi-instagram fs-3 text-secondary"></i></a>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<script>
    alertify.set('notifier', 'position', 'top-right');
    <?php if (isset($_SESSION['success'])):   ?>
        alertify.success("<?= $_SESSION['success'] ?>");
        <?php unset($_SESSION['success'])  ?>
    <?php endif; ?>

     <?php if (isset($_SESSION['error'])):   ?>
        alertify.error("<?= $_SESSION['error'] ?>");
        <?php unset($_SESSION['error'])  ?>
    <?php endif; ?>
</script>
</body>

</html>
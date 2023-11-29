<?php 
    $pager->setSurroundCount(2); 
    $hasPrevPage = $pager->hasPreviousPage();
    $hasNextPage = $pager->hasNextPage();
?>

<nav id="pagination">
    <ul class="pagination">

        <?php if ($pager->hasPrevious()): ?>
            <li class="page-item" data-toggle="tooltip" title="Halaman Pertama">
                <a class="page-link" href="<?= $pager->getFirst() ?>">
                    <i class="fas fa-angle-double-left"></i>
                </a>
            </li>
        <?php endif ?>

        <li class="page-item <?= !$hasPrevPage ? 'disabled' : '' ?>" data-toggle="tooltip" title="Sebelumnya">
            <a href="<?= $hasPrevPage ? $pager->getPreviousPage() : 'javascript:void(0)' ?>" class="page-link">
                <i class="fas fa-angle-left"></i>
            </a>
        </li>


        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a href="<?= $link['active'] ? 'javascript:void(0);' : $link['uri'] ?>" 
                    class="page-link <?= $link['active'] ? 'cursor-default' : '' ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>


        <li class="page-item <?= !$hasNextPage ? 'disabled' : '' ?>"" data-toggle="tooltip" title="Selanjutnya">
            <a href="<?= $hasNextPage ? $pager->getNextPage() : 'javascript:void(0)' ?>" class="page-link">
                <i class="fas fa-angle-right"></i>
            </a>
        </li>

        <?php if ($pager->hasNext()): ?>
            <li class="page-item" data-toggle="tooltip" title="Halaman Terakhir">
                <a class="page-link" href="<?= $pager->getLast() ?>">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </li>
        <?php endif ?>

    </ul>
</nav>
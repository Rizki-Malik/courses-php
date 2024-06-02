<div class="articles">
    <?php
    require_once 'pustaka/Crud.php';
    $crud = new Crud();
    $artikel = $crud->read('artikel');
    foreach ($artikel as $row) :
    ?>
        <div class="article">
            <div class="card-content">
                <p class="date&author"><?= $row['tanggal'] ?> | <?= $row['penulis']; ?></p>
                <a href="pages/detail/artikel-detail.php?id=<?= $row['id']; ?>">
                    <img src="/admin//artikel/<?= $row['thumbnail'] ?>" alt="thumbnail" class="thumbnail">
                    <h2 class="card-title"><?= ucwords($row['judul']); ?></h2>
                    <p class="card-text"><?= strlen($row['deskripsi']) > 100 ? substr($row['deskripsi'], 0, 100) . '...' : $row['deskripsi']; ?></p>
                </a>
            </div>
        </div>
    <?php
    endforeach;
    ?>
</div>

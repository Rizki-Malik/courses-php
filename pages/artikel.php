<div class="articles">
    <?php
    require_once 'pustaka/Crud.php';
    $crud = new Crud();
    $conn = $crud->getConnection();
    
    $sql = "CALL GetArticles()";
    $result = $conn->query($sql);
    if ($result) {
        $artikel = [];
        while ($row = $result->fetch_assoc()) {
            $artikel[] = $row;
        }
        $no = 1;
        foreach ($artikel as $row) :
    ?>
        <div class="article">
            <div class="card-content">
                <p class="date-author"><?= $row['published_date'] ?> | <?= $row['username']; ?></p>
                <a href="pages/detail/artikel-detail.php?id=<?= $row['id']; ?>">
                    <img src="admin/artikel/<?= $row['thumbnail'] ?>" alt="thumbnail" class="thumbnail">
                    <h2 class="card-title"><?= ucwords($row['title']); ?></h2>
                    <p class="card-text"><?= strlen($row['content']) > 100 ? substr($row['content'], 0, 100) . '...' : $row['content']; ?></p>
                </a>
            </div>
        </div>
        <?php
        endforeach;
        } else {
            echo "<tr><td colspan='6'>Terjadi kesalahan pada query!</td></tr>";
        }
        ?>
</div>

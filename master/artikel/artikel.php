<?php require_once '../components/header.php'; ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <div class="d-flex justify-content-between align-items-center card-padding pb-2">
            <h6 class="card-title m-0">Daftar Artikel</h6>
            <a href="artikel-add.php" data-toggle="tooltip" title="Tambah data">
                <button class="mdc-button mdc-button--raised icon-button filled-button--primary">
                    <i class="material-icons mdc-button__icon">add</i>
                </button>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th class="text-left">#</th>
                        <th class="text-left">Thumbnail</th>
                        <th class="text-center">Penulis</th>
                        <th class="text-center">Judul Artikel</th>
                        <th class="text-center">Kategori Artikel</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../pustaka/Crud.php';
                    require_once '../../pustaka/Thumbnail.php';
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
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td class="text-left"><img src="<?= $row['thumbnail'] ?>" alt="thumbnail" width="300px" height="300px" style="object-fit: contain;"></td>
                            <td class="text-center"><?= ucwords($row['username']) ?></td>
                            <td class="text-center"><?= ucwords($row['title']); ?></td>
                            <td class="text-center"><?= $row['category_name'] ?></td>
                            <td class="text-center"><?= $row['published_date'] ?></td>
                            <td class="text-center">
                                <a href="../../pages/detail/artikel-detail.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Detail"><i class="material-icons">remove_red_eye</i></a>
                                <a href="artikel-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                                <a href="delete-artikel.php?id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    } else {
                        echo "<tr><td colspan='6'>Terjadi kesalahan pada query!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../components/footer.php'; ?>
<?php require_once '../components/header.php'; ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <div class="d-flex justify-content-between align-items-center card-padding pb-2">
            <h6 class="card-title m-0">Daftar Kelas</h6>
            <a href="course-add.php" data-toggle="tooltip" title="Tambah data">
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
                        <th class="text-center">Nama Kelas</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../pustaka/Crud.php';
                    $crud = new Crud();
                    $conn = $crud->getConnection();
                    $sql = "SELECT course.*, categories.category_name 
                            FROM course
                            LEFT JOIN categories ON course.category_id = categories.id";
                    $result = $conn->query($sql);
                    $no = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td class="text-left"><img src="<?= $row['thumbnail'] ?>" alt="thumbnail" width="300px" height="300px" style="object-fit: contain;"></td>
                                <td class="text-center"><?= ucwords($row['course_name']); ?></td>
                                <td class="text-center"><?= ucwords($row['category_name']); ?></td>
                                <td class="text-center"><?= 'Rp ' . number_format($row['price'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="#?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Detail"><i class="material-icons">remove_red_eye</i></a>
                                    <a href="course-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                                    <a href="delete-course.php?&id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../components/footer.php'; ?>
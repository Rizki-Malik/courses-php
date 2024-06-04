<?php require_once '../components/header.php'; ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <div class="d-flex justify-content-between align-items-center card-padding pb-2">
            <h6 class="card-title m-0">Daftar Materi</h6>
            <a href="material-add.php" data-toggle="tooltip" title="Tambah data">
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
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Judul Materi</th>
                        <th class="text-center">Deskripsi Materi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../pustaka/Crud.php';
                    $crud = new Crud();
                    $conn = $crud->getConnection();
                    $sql = "SELECT course_materials.*, course.course_name 
                            FROM course_materials
                            LEFT JOIN course ON course_materials.course_id = course.id";
                    $result = $conn->query($sql);
                    $no = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td class="text-center"><?= ucwords($row['course_name']); ?></td>
                                <td class="text-center"><?= ucwords($row['material_title']); ?></td>
                                <td class="text-center"><?= strlen($row['material_description']) > 100 ? substr($row['material_description'], 0, 100) . '...' : $row['material_description']; ?></td>
                                <td>
                                    <a href="#?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Detail"><i class="material-icons">remove_red_eye</i></a>
                                    <a href="material-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                                    <a href="material.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
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

<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $table = 'course_materials';
    $id_course_material = $_GET['id'];
    $where = ['id' => $id_course_material];
    
    $hasil = $crud->delete($table, $where);

    if ($hasil) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil dihapus');</script>";
    }

    echo '<meta http-equiv="refresh" content="0; url=material.php">';
}
?>
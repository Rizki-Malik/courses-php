<?php require_once '../components/header.php'; ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <div class="d-flex justify-content-between align-items-center card-padding pb-2">
            <h6 class="card-title m-0">Daftar Kategori</h6>
            <a href="kategori-add.php" data-toggle="tooltip" title="Tambah data">
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
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../pustaka/Crud.php';
                    require_once '../../pustaka/Thumbnail.php';
                    $crud = new Crud();
                    $kategori = $crud->read('categories');
                    $no = 1;
                    foreach ($kategori as $row) :
                    ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= ucwords($row['category_name']); ?></td>
                            <td>
                                <a href="kategori-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                                <a href="kategori.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../components/footer.php'; ?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $table = 'categories';
    $id_category = $_GET['id'];
    $where = ['id' => $id_category];
    
    $kategori = $crud->read($table, $where);
    if ($kategori) {

        $hasil = $crud->delete($table, $where);

        if ($hasil) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Data tidak berhasil dihapus');</script>";
        }
    } else {
        echo "<script>alert('kategori tidak ditemukan');</script>";
    }
    
    echo '<meta http-equiv="refresh" content="0; url=kategori.php">';
}
?>

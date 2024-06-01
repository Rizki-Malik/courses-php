<?php require_once '../components/header.php'; ?>
<h2 class="mt-4 mb-4"><i class="fas fa-newspaper"></i> Daftar Artikel</h2>
<div class="fa-pull-right mb-2">
    <a href="artikel-add.php" data-toggle="tooltip" data-placement="top" title="Tambah data" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Artikel</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Judul Artikel</th>
            <th scope="col">Penulis</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once '../../pustaka/Crud.php';
        $crud = new Crud();
        $artikel = $crud->read('artikel');
        $no = 1;
        foreach ($artikel as $row) :
        ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $row['tanggal'] ?></td>
                <td><?= ucwords($row['judul']); ?></td>
                <td><?= $row['penulis']; ?></td>
                <td>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Detail"><i class="material-icons">remove_red_eye</i></a>
                    <a href="artikel-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                    <a href="artikel.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>
<?php require_once '../components/footer.php'; ?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $table = 'artikel';
    $id_artikel = $_GET['id'];
    $where = ['id' => $id_artikel];
    $hasil = $crud->delete($table, $where);

    if ($hasil == true) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Data Tidak berhasil dihapus');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
}
?>

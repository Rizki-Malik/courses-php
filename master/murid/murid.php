<?php require_once '../components/header.php'; ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <div class="d-flex justify-content-between align-items-center card-padding pb-2">
            <h6 class="card-title m-0">Daftar Murid</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th class="text-left">#</th>
                        <th>Nama Siswa</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nomor Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../pustaka/Crud.php';
                    $crud = new Crud();
                    $murid = $crud->read('students');
                    $no = 1;
                    foreach ($murid as $row) :
                    ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= ucwords($row['student_name']); ?></td>
                            <td class="text-center"><?= ($row['email']); ?></td>
                            <td class="text-center"><?= ucwords($row['phone_number']); ?></td>
                            <td>
                                <a href="murid-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                                <a href="murid.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
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
    $table = 'students';
    $id_student = $_GET['id'];
    $where = ['id' => $id_student];
    
    $student = $crud->read($table, $where);
    if ($student) {
        $user_id = $student[0]['user_id'];
        
        $hasil = $crud->delete($table, $where);
        if ($hasil) {
            $crud->delete('users', ['id' => $user_id]);
            echo "<script>alert('Data berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Data tidak berhasil dihapus');</script>";
        }
    } else {
        echo "<script>alert('Data pengajar tidak ditemukan');</script>";
    }
    
    echo '<meta http-equiv="refresh" content="0; url=murid.php">';
}
?>
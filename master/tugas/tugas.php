<?php require_once '../components/header.php'; ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <div class="d-flex justify-content-between align-items-center card-padding pb-2">
            <h6 class="card-title m-0">Daftar Kelas</h6>
            <a href="tugas-add.php" data-toggle="tooltip" title="Tambah data">
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
                        <th class="text-center">Penulis</th>
                        <th class="text-center">Tugas Kelas</th>
                        <th class="text-center">Judul Tugas</th>
                        <th class="text-center">Pengerjaan</th>
                        <th class="text-center">Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../pustaka/Crud.php';
                    $crud = new Crud();
                    $conn = $crud->getConnection();
                    $sql = "SELECT assignments.*, users.username, instructors.instructor_name, course.course_name
                            FROM assignments
                            LEFT JOIN users ON assignments.user_id = users.id
                            LEFT JOIN course ON assignments.course_id = course.id
                            LEFT JOIN instructors ON assignments.user_id = instructors.user_id";
                    $result = $conn->query($sql);
                    $no = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $instructor_name = isset($row['instructor_name']) ? $row['instructor_name'] : $row['username'];
                            ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td class="text-center"><?= ucwords($instructor_name); ?></td>
                                <td class="text-center"><?= ucwords($row['course_name']); ?></td>
                                <td class="text-center"><?= ucwords($row['assignment_title']); ?></td>
                                <td class="text-center"><?= strlen($row['assignment_description']) > 100? substr($row['assignment_description'], 0, 100). '...' : $row['assignment_description'];?></td>
                                <td class="text-center"><?= $row['created_at']; ?></td>
                                <td>
                                    <a href="#?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Detail"><i class="material-icons">remove_red_eye</i></a>
                                    <a href="tugas-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                                    <a href="tugas.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
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
<?php 
require_once '../components/footer.php';
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $table = 'assignments';
    $id_tugas = $_GET['id'];
    $where = ['id' => $id_tugas];
    
    $tugas = $crud->read($table, $where);
    if ($tugas) {

        $hasil = $crud->delete($table, $where);

        if ($hasil) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Data tidak berhasil dihapus');</script>";
        }
    } else {
        echo "<script>alert('Tugas tidak ditemukan');</script>";
    }
    
    echo '<meta http-equiv="refresh" content="0; url=tugas.php">';
}
?>
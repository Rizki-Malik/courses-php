<?php require_once '../components/header.php'; ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <div class="d-flex justify-content-between align-items-center card-padding pb-2">
            <h6 class="card-title m-0">Daftar Kelas</h6>
            <a href="event-add.php" data-toggle="tooltip" title="Tambah data">
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
                        <th class="text-left">Penulis</th>
                        <th class="text-center">Nama Event</th>
                        <th class="text-center">Deskripsi Event</th>
                        <th class="text-center">Tanggal Event</th>
                        <th class="text-center">Link Event</th>
                        <th class="text-center">Penyelenggara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../pustaka/Crud.php';
                    $crud = new Crud();
                    $conn = $crud->getConnection();
                    $sql = "SELECT events.*, users.username, organizations.name 
                            FROM events
                            LEFT JOIN users ON events.user_id = users.id
                            LEFT JOIN organizations ON events.org_id = organizations.id";
                    $result = $conn->query($sql);
                    $no = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td class="text-center"><?= ucwords($row['username']); ?></td>
                                <td class="text-center"><?= ucwords($row['event_name']); ?></td>
                                <td class="text-center"><?= strlen($row['event_description']) > 100? substr($row['event_description'], 0, 100). '...' : $row['event_description'];?></td>
                                <td class="text-center"><?= $row['event_date']; ?></td>
                                <td class="text-center"><?= $row['event_link']; ?></td>
                                <td class="text-center"><?= ucwords($row['name']); ?></td>
                                <td>
                                    <a href="#?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Detail"><i class="material-icons">remove_red_eye</i></a>
                                    <a href="event-edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" aria-hidden="true">edit</i></a>
                                    <a href="event.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Apakah anda yakin ?');" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons" aria-hidden="true">delete</i></a>
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
    $table = 'events';
    $id_event = $_GET['id'];
    $where = ['id' => $id_event];
    
    $org = $crud->read($table, $where);
    if ($org) {

        $hasil = $crud->delete($table, $where);

        if ($hasil) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Data tidak berhasil dihapus');</script>";
        }
    } else {
        echo "<script>alert('Organisasi tidak ditemukan');</script>";
    }
    
    echo '<meta http-equiv="refresh" content="0; url=event.php">';
}
?>
<?php require_once('../components/header.php'); ?>
<?php
require_once('../../pustaka/Crud.php');
require_once('../../pustaka/Thumbnail.php');

$crud = new Crud();

$table = 'students';
$id_student = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_student) {
    $where = ['id' => $id_student];
    $row = $crud->read($table, $where);
    if ($row) {
        $student = $row[0];
    } else {
        echo "<script>alert('student tidak ditemukan');</script>";
        echo '<meta http-equiv="refresh" content="0; url=murid.php">';
        exit;
    }
} else {
    echo "<script>alert('ID student tidak diberikan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=murid.php">';
    exit;
}
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Edit Data Siswa</h6>
        <div class="template-demo">
            <form action="" method="post">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="student_name" id="student_name" value='<?= htmlspecialchars($student['student_name'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="student_name" class="mdc-floating-label">Nama Siswa</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="email" id="email" value='<?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="email" class="mdc-floating-label">Email</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="phone_number" id="phone_number" value='<?= htmlspecialchars($student['phone_number'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="phone_number" class="mdc-floating-label">Nomor Telepon</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" class="mdc-button mdc-button--unelevated mt-4">
                    <i class="material-icons mdc-button__icon">save</i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<?php require_once('../components/footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $data = [
        'student_name' => $student_name,
        'email' => $email,
        'phone_number' => $phone_number,
    ];

    $hasil = $crud->update($table, $data, $where);

    if ($hasil) {
        echo "<script>alert('Data berhasil diubah');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil diubah');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=murid.php">';
}
?>

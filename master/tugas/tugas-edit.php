<?php
require_once('../components/header.php');
require_once('../../pustaka/Crud.php');
require_once('../../pustaka/User.php');

$user = new User();
$crud = new Crud();

$table = 'assignments';
$id_assignment = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_assignment) {
    $where = ['id' => $id_assignment];
    $row = $crud->read($table, $where);
    if ($row) {
        $tugas = $row[0];
    } else {
        echo "<script>alert('Kategori tidak ditemukan');</script>";
        echo '<meta http-equiv="refresh" content="0; url=tugas.php">';
        exit;
    }
} else {
    echo "<script>alert('ID kategori tidak diberikan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=tugas.php">';
    exit;
}

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$user_details = $user->details($sql);
$user_id = $_SESSION['user'];

$courses = $crud->read('course');
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Tugas Baru</h6>
        <div class="template-demo">
            <form action="" method="post">
                <!-- Kelas Dropdown -->
                <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-6-desktop stretch-card">
                    <div class="mdc-card">
                        <h6 class="card-title">Masukan Tugas ke :</h6>
                        <div class="template-demo">
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                                <input type="hidden" name="course_id" value='<?= htmlspecialchars($tugas['course_id'], ENT_QUOTES, 'UTF-8'); ?>' required>
                                <i class="mdc-select__dropdown-icon"></i>
                                <div class="mdc-select__selected-text"></div>
                                <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                                    <ul class="mdc-list">
                                        <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true"></li>
                                        <?php foreach ($courses as $course): ?>
                                            <li class="mdc-list-item" data-value="<?= $course['id']; ?>">
                                                <?= htmlspecialchars($course['course_name']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <span class="mdc-floating-label">Pilih Kelas</span>
                                <div class="mdc-line-ripple"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="assignment_title" id="assignment_title" value='<?= htmlspecialchars($tugas['assignment_title'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="assignment_title" class="mdc-floating-label">Judul Tugas</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <textarea class="mdc-text-field__input" name="assignment_description" id="assignment_description" required><?= htmlspecialchars($tugas['assignment_description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="assignment_description" class="mdc-floating-label">Soal Pengerjaan</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="mdc-button mdc-button--unelevated mt-4">
                    <i class="material-icons mdc-button__icon">save</i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<?php 
require_once('../components/footer.php');

if (isset($_POST['submit'])) {
    $assignment_title = $_POST['assignment_title'];
    $course_id = $_POST['course_id'];
    $assignment_description = $_POST['assignment_description'];

    $data = [
        'user_id' => $user_id,
        'course_id' => $course_id,
        'assignment_title' => $assignment_title,
        'assignment_description' => $assignment_description,
        'created_at' => date("Y-m-d"),
    ];

    $hasil = $crud->update($table, $data, $where);

    if ($hasil) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil disimpan');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=tugas.php">';
}
?>

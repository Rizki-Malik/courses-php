<?php
require_once('../components/header.php');
require_once('../../pustaka/Crud.php');
require_once('../../pustaka/User.php');

// Initialize the User and Crud classes
$user = new User();
$crud = new Crud();

// Fetch user data using session user ID
$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$user_details = $user->details($sql);
$user_id = $_SESSION['user'];

// Fetch course
$courses = $crud->read('course');
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Materi Baru</h6>
        <div class="template-demo">
            <form action="" method="post">
                <!-- Kelas Dropdown -->
                <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-6-desktop stretch-card">
                    <div class="mdc-card">
                        <h6 class="card-title">Masukan Materi ke :</h6>
                        <div class="template-demo">
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                                <input type="hidden" name="course_id">
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
                        <input class="mdc-text-field__input" name="material_title" id="material_title" required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="material_title" class="mdc-floating-label">Judul Materi</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <textarea class="mdc-text-field__input" name="material_description" id="material_description" required></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="material_description" class="mdc-floating-label">Konten</label>
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
require_once('../../pustaka/Crud.php');

$crud = new Crud();

if (isset($_POST['submit'])) {
    $material_title = $_POST['material_title'];
    $course_id = $_POST['course_id'];
    $material_description = $_POST['material_description'];

    $data = [
        'user_id' => $user_id,
        'course_id' => $course_id,
        'material_title' => $material_title,
        'material_description' => $material_description
    ];

    $hasil = $crud->create('course_materials', $data);

    if ($hasil) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil disimpan');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=materials.php">';
}
?>

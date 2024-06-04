<?php 
require_once('../components/header.php'); 
require_once('../../pustaka/Crud.php');
require_once('../../pustaka/Thumbnail.php');

$crud = new Crud();
$table = 'course';
$id_course = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_course) {
    $where = ['id' => $id_course];
    $row = $crud->read($table, $where);
    if ($row) {
        $course = $row[0];
    } else {
        echo "<script>alert('course tidak ditemukan');</script>";
        echo '<meta http-equiv="refresh" content="0; url=course.php">';
        exit;
    }
} else {
    echo "<script>alert('ID course tidak diberikan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=course.php">';
    exit;
}
$categories = $crud->read('categories');
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Kelas Baru</h6>
        <div class="template-demo">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="course_name" id="course_name" value='<?= htmlspecialchars($course['course_name'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="course_name" class="mdc-floating-label">Nama Kelas</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Kategori Dropdown -->
                <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-6-desktop stretch-card">
                    <div class="mdc-card">
                        <h6 class="card-title">Pilih Kategori</h6>
                        <div class="template-demo">
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                                <input type="hidden" name="category_id" value='<?= htmlspecialchars($course['category_id'], ENT_QUOTES, 'UTF-8'); ?>' >
                                <i class="mdc-select__dropdown-icon"></i>
                                <div class="mdc-select__selected-text"></div>
                                <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                                    <ul class="mdc-list">
                                        <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true"></li>
                                        <?php foreach ($categories as $category): ?>
                                            <li class="mdc-list-item" data-value="<?= $category['id']; ?>">
                                                <?= htmlspecialchars($category['category_name']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <span class="mdc-floating-label">Pilih Kategori</span>
                                <div class="mdc-line-ripple"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--focused">
                        <input type="file" class="mdc-text-field__input py-2" name="thumbnail" id="thumbnail" accept=".jpg,.jpeg,.png,.gif">
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded mdc-notched-outline--notched">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="thumbnail" class="mdc-floating-label mdc-floating-label--float-above">Thumbnail (Biarkan kosong jika tidak ingin mengubah)</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Deskripsi input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <textarea class="mdc-text-field__input" name="description" id="description" required><?= htmlspecialchars($course['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="description" class="mdc-floating-label">Deskripsi Kelas</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Harga Kelas input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="price" id="price" value='<?= htmlspecialchars($course['price'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="price" class="mdc-floating-label">Harga Kelas</label>
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
<?php require_once('../components/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {
    $course_name = $_POST['course_name'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $data = [
        'course_name' => $course_name,
        'category_id' => $category_id,
        'description' => $description,
        'price' => $price,
    ];

    // Check if thumbnail is provided
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnailResult = Thumbnail::update($_FILES['thumbnail'], $artikel['thumbnail']);
        if (strpos($thumbnailResult, 'The file') !== false) {
            $data['thumbnail'] = basename($_FILES['thumbnail']['name']);
        } else {
            echo "<script>alert('$thumbnailResult');</script>";
            exit;
        }
    }

    $hasil = $crud->update($table, $data, $where);

    if ($hasil) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil disimpan');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=course.php">';
}
?>

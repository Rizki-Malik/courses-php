<?php 
ob_start(); // Start output buffering
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user']) || trim($_SESSION['user']) == '') {
    header('Location: ../../auth/login.php');
    exit();
}

require_once('../components/header.php'); 
require_once('../../pustaka/Crud.php');
require_once('../../pustaka/Thumbnail.php');
require_once('../../pustaka/User.php');

$user = new User();
$crud = new Crud();

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$user_details = $user->details($sql, [$_SESSION['user']]);
$user_id = $_SESSION['user'];

$categories = $crud->read('categories');

$table = 'articles';
$id_artikel = isset($_GET['id']) ? $_GET['id'] : null;
$where = [];
if ($id_artikel) {
    $where = ['id' => $id_artikel];
    $row = $crud->read($table, $where);
    if ($row) {
        $artikel = $row[0];
    } else {
        echo "<script>alert('Artikel tidak ditemukan');</script>";
        echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
        exit;
    }
} else {
    echo "<script>alert('ID artikel tidak diberikan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
    exit;
}
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Edit Artikel</h6>
        <div class="template-demo">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Judul input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--focused">
                        <input class="mdc-text-field__input" name="title" id="title" value='<?= htmlspecialchars($artikel['title'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline mdc-notched-outline--upgraded mdc-notched-outline--notched">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="title" class="mdc-floating-label mdc-floating-label--float-above">Judul Artikel</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Kategori Input -->
                <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-6-desktop stretch-card">
                    <div class="mdc-card">
                        <h6 class="card-title">Pilih Kategori</h6>
                        <div class="template-demo">
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                                <input type="hidden" name="category_id" value='<?= htmlspecialchars($artikel['category_id'], ENT_QUOTES, 'UTF-8'); ?>' >
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
                        <textarea class="mdc-text-field__input" name="content" id="content" required><?= htmlspecialchars($artikel['content'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="content" class="mdc-floating-label">Deskripsi Artikel</label>
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
        $published_date = date("Y-m-d");
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $content = $_POST['content'];

    // Initialize $data array
    $data = [
        'published_date' => $published_date,
        'user_id' => $user_id,
        'category_id' => $category_id,
        'title' => $title,
        'content' => $content
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

    // Update the article
    $hasil = $crud->update($table, $data, $where);

    // Check if update was successful
    if ($hasil) {
        echo "<script>alert('Data berhasil diubah');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil diubah');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
}
?>
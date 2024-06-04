<?php require_once('../components/header.php'); ?>
<?php
require_once('../../pustaka/Crud.php');
require_once('../../pustaka/Thumbnail.php');

$crud = new Crud();

$table = 'categories';
$id_kategori = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_kategori) {
    $where = ['id' => $id_kategori];
    $row = $crud->read($table, $where);
    if ($row) {
        $kategori = $row[0];
    } else {
        echo "<script>alert('Kategori tidak ditemukan');</script>";
        echo '<meta http-equiv="refresh" content="0; url=kategori.php">';
        exit;
    }
} else {
    echo "<script>alert('ID kategori tidak diberikan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=kategori.php">';
    exit;
}
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Edit Kategori</h6>
        <div class="template-demo">
            <form action="" method="post">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="category_name" id="category_name" value='<?= htmlspecialchars($kategori['category_name'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="category_name" class="mdc-floating-label">category_name</label>
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
    $category_name = $_POST['category_name'];

    $data = [
        'category_name' => $category_name
    ];

    $hasil = $crud->update($table, $data, $where);

    if ($hasil) {
        echo "<script>alert('Data berhasil diubah');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil diubah');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=kategori.php">';
}
?>

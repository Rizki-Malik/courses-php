<?php 
require_once('../components/header.php'); 
require_once('../../pustaka/Crud.php');

$crud = new Crud();
$table = 'organizations';
$id_org = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_org) {
    $where = ['id' => $id_org];
    $row = $crud->read($table, $where);
    if ($row) {
        $org = $row[0];
    } else {
        echo "<script>alert('Kategori tidak ditemukan');</script>";
        echo '<meta http-equiv="refresh" content="0; url=org.php">';
        exit;
    }
} else {
    echo "<script>alert('ID kategori tidak diberikan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=org.php">';
    exit;
}
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Kategori Baru</h6>
        <div class="template-demo">
            <form action="" method="post">
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="name" id="name" value='<?= htmlspecialchars($org['name'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="name" class="mdc-floating-label">Nama Organisasi</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <textarea class="mdc-text-field__input" name="description" id="description" required><?= htmlspecialchars($org['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="description" class="mdc-floating-label">Deskripsi</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="link" id="link" value='<?= htmlspecialchars($org['link'], ENT_QUOTES, 'UTF-8'); ?>' required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="link" class="mdc-floating-label">Link Profil</label>
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
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $data = [
        'name' => $name,
        'description' => $description,
        'link' => $link,
    ];

    $hasil = $crud->update($table, $data, $where);

    if ($hasil) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil disimpan');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=org.php">';
}
?>

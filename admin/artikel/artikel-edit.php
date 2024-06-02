<?php require_once('../components/header.php'); ?>
<?php
    require_once('../../pustaka/Crud.php');
    $crud = new Crud();

    $table = 'artikel';
    $id_artikel = isset($_GET['id']) ? $_GET['id'] : null;
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
        <h6 class="card-title">Artikel Baru</h6>
        <div class="template-demo">
            <form action="" method="post">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="penulis" id="text-field-hero-input" value='<?= htmlspecialchars($artikel['penulis'], ENT_QUOTES, 'UTF-8'); ?>'>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Penulis</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon">
                        <i class="material-icons mdc-text-field__icon">date_range</i>
                        <input class="mdc-text-field__input" name="tanggal" id="text-field-hero-input" value='<?= htmlspecialchars($artikel['tanggal'], ENT_QUOTES, 'UTF-8'); ?>'>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Tanggal Artikel</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="judul" id="text-field-hero-input" value='<?= htmlspecialchars($artikel['judul'], ENT_QUOTES, 'UTF-8'); ?>'>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Judul Artikel</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <textarea class="mdc-text-field__input" name="deskripsi" id="text-field-hero-input"><?= htmlspecialchars($artikel['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Deskripsi Artikel</label>
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
        $tanggal = $_POST['tanggal'];
        $penulis = $_POST['penulis'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];

        $data = [
            'tanggal' => $tanggal, 
            'penulis' => $penulis, 
            'judul' => $judul, 
            'deskripsi' => $deskripsi
        ];

        $hasil = $crud->update($table, $data, $where);

        if ($hasil) {
            echo "<script>alert('Data berhasil dirubah');</script>";    
        } else {
            echo "<script>alert('Data tidak berhasil dirubah');</script>";    
        }        
        echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
    }
?>

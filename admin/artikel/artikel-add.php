<?php require_once('../components/header.php'); ?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Artikel Baru</h6>
        <div class="template-demo">
            <form action="" method="post">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="penulis" id="penulis">
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="penulis" class="mdc-floating-label">Penulis</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon">
                        <i class="material-icons mdc-text-field__icon">date_range</i>
                        <input class="mdc-text-field__input" name="tanggal" id="tanggal">
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="tanggal" class="mdc-floating-label">Tanggal Artikel</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="judul" id="judul">
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="judul" class="mdc-floating-label">Judul Artikel</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="deskripsi" id="deskripsi">
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="deskripsi" class="mdc-floating-label">Deskripsi Artikel</label>
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
<?= require_once('../components/footer.php'); ?>

<?php
    require_once('../../pustaka/Crud.php');
    $crud = new Crud();

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

        $hasil = $crud->create('artikel', $data);

        if ($hasil == 'sukses') {
            echo "<script>alert('Data berhasil disimpan');</script>";    
        } else {
            echo "<script>alert('Data tidak berhasil disimpan');</script>";    
        }        
        echo '<meta http-equiv="refresh" url=artikel.php">';
    }
?>

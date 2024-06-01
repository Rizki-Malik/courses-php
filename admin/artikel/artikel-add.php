<?= require_once('../components/header.php'); ?>
<h2 class="mt-4 mb-4"><i class="fas fa-plus"></i> Artikel Baru</h2>
<form action="" method="post">
    <div class="form-group">
        <label for="tanggal">Tanggal Artikel</label>
        <input type="text" name="tanggal" class="form-control" placeholder="yyyy-mm-dd">
    </div>
    <div class="form-group">
        <label for="penulis">Penulis</label>
        <input type="text" name="penulis" class="form-control" placeholder="Nama Penulis Artikel">
    </div>
    <div class="form-group">
        <label for="judul">Judul Artikel</label>
        <input type="text" name="judul" class="form-control" placeholder="Judul Artikel">
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi Artikel</label>
        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
</form>
<?= require_once('../components/footer.php'); ?>
<?php
    require_once('../../pustaka/Crud.php');
    $crud = new Crud();

    if (isset($_POST['submit'])) {
        $tanggal = $_POST['tanggal'];
        $penulis = $_POST['penulis'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];

        $data = array('tanggal' => $tanggal, 
                        'penulis' => $penulis, 
                        'judul' => $judul, 
                        'deskripsi' =>$deskripsi
                    );
        $hasil = $crud->create('artikel', $data);

        if($hasil=='sukses'){
            echo "<script>alert('Data berhasil disimpan');</script>";    
        }else{
            echo "<script>alert('Data Tidak berhasil disimpan');</script>";    
        }        
        echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
    }
?>
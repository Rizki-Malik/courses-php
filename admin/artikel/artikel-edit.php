<?= require_once('../components/header.php'); ?>
<?php
    require_once('../pustaka/Crud.php');
    $crud = new Crud();

    $table = 'artikel';
    $id_artikel = $_GET['id'];
    $where = ['id' => $id_artikel];
    $row = $crud->read($table, $where);
    //var_dump($row);
?>
<h2 class="mt-4 mb-4"><i class="fas fa-edit"></i> Edit Artikel</h2>
<form action="" method="post">
    <div class="form-group">
        <label for="tanggal">Tanggal Artikel</label>
        <input value='<?=$row[0]['tanggal'];?>' type="text" name="tanggal" class="form-control" placeholder="yyyy-mm-dd">
    </div>
    <div class="form-group">
        <label for="penulis">Penulis</label>
        <input value='<?=$row[0]['penulis'];?>' type="text" name="penulis" class="form-control" placeholder="Nama Penulis Artikel">
    </div>
    <div class="form-group">
        <label for="judul">Judul Artikel</label>
        <input value='<?=$row[0]['judul'];?>' type="text" name="judul" class="form-control" placeholder="Judul Artikel">
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi Artikel</label>
        <textarea class="form-control" name="deskripsi" rows="3"><?=$row[0]['deskripsi'];?></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
</form>
<?= require_once('../components/footer.php'); ?>
<?php
    require_once('../pustaka/Crud.php');
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
        $hasil = $crud->update($table, $data, $where);

        if($hasil==true){
            echo "<script>alert('Data berhasil dirubah');</script>";    
        }else{
            echo "<script>alert('Data Tidak berhasil dirubah');</script>";    
        }        
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php?page=artikel-edit&id='.$id_artikel.'">';
    }
?>
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
        var_dump($data);
        //$crud->create('artikel', $data);
        //$mhs->tambahData($table, $data);
        //header("location:dataMahasiswa.php");
        //header("location:dashboard.php?page=artikel-add");
    }

?>
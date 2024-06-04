<?php
require_once '../../pustaka/Crud.php';

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $crud = new Crud();
    
    $conn = $crud->getConnection();
    $sql = "SELECT thumbnail FROM course WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $stmt->bind_result($thumbnail);
    $stmt->fetch();
    $stmt->close();
    
    if (!empty($thumbnail) && file_exists($thumbnail)) {
        unlink($thumbnail);
    }
    
    $sql = "DELETE FROM course WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $courseId);
    $result = $stmt->execute();
    $stmt->close();

    if ($result) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil dihapus');</script>";
    }
    
    echo '<meta http-equiv="refresh" content="0; url=course.php">';
} else {
    echo "<script>alert('Course tidak ditemukan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=course.php">';
}
?>

<div class="course-page">
<?php
  require_once 'pustaka/Crud.php';
  $crud = new Crud();
  $conn = $crud->getConnection();

  $sql = "SELECT c.*, cm.material_title, categories.category_name, cm.material_description
          FROM course c
          LEFT JOIN course_materials cm ON c.id = cm.course_id
          LEFT JOIN categories ON c.category_id = categories.id";

  $result = $conn->query($sql);
  $no = 1;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
  <div class="courses-container">
    <div class="course">
      <div class="course-preview">
        <h6>Course</h6>
        <h2><?= ucwords($row['course_name']); ?></h2>
        <h5><?= 'Rp ' . number_format($row['price'], 0, ',', '.'); ?></h5>
      </div>
      <div class="course-info">
        <div class="progress-container">
          <div class="progress"></div>
          <span class="progress-text">
            0/9
          </span>
        </div>
        <h6><?= ucwords($row['category_name']); ?></h6>
        <?php if (!empty($row['material_title']) && !empty($row['material_description'])) { ?>
          <h2><?= ucwords($row['material_title']); ?></h2>
          <p><?= strlen($row['material_description']) > 100? substr($row['material_description'], 0, 50). '...' : $row['material_description'];?></p>
        <?php } ?>
        <a href="master/courses/course.php">
            <button class="btn">Pelajari</button>
        </a>
      </div>
    </div>
  </div>
<?php
    }
  } else {
    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
  }
?>
</div>

<?php
require_once('../components/header.php');
require_once('../../pustaka/Crud.php');
require_once('../../pustaka/User.php');

$user = new User();
$crud = new Crud();

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
$user_details = $user->details($sql);
$user_id = $_SESSION['user'];

$courses = $crud->read('course');
?>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card">
        <h6 class="card-title">Ulasan Baru</h6>
        <div class="template-demo">
            <form action="" method="post">
                <!-- Kelas Dropdown -->
                <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-6-desktop stretch-card">
                    <div class="mdc-card">
                        <h6 class="card-title">Beri Ulasan ke :</h6>
                        <div class="template-demo">
                            <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                                <input type="hidden" name="course_id">
                                <i class="mdc-select__dropdown-icon"></i>
                                <div class="mdc-select__selected-text"></div>
                                <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                                    <ul class="mdc-list">
                                        <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true"></li>
                                        <?php foreach ($courses as $course): ?>
                                            <li class="mdc-list-item" data-value="<?= $course['id']; ?>">
                                                <?= htmlspecialchars($course['course_name']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <span class="mdc-floating-label">Pilih Kelas</span>
                                <div class="mdc-line-ripple"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" name="rating" id="rating" required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="rating" class="mdc-floating-label">Rating</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                <!-- Nama Kategori input -->
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                    <div class="mdc-text-field mdc-text-field--outlined">
                        <textarea class="mdc-text-field__input" name="review_text" id="review_text" required></textarea>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="review_text" class="mdc-floating-label">Ulasan</label>
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

if (isset($_POST['submit'])) {
    $course_id = $_POST['course_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    $data = [
        'user_id' => $user_id,
        'course_id' => $course_id,
        'rating' => $rating,
        'review_text' => $review_text,
        'review_date' => date("Y-m-d"),
    ];

    $hasil = $crud->create('course_reviews', $data);

    if ($hasil) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Data tidak berhasil disimpan');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=review.php">';
}
?>

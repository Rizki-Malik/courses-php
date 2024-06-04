<?php
require_once('../pustaka/Crud.php');

if (isset($_POST['register'])) {
    $type = $_GET['type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $permission = 3;
    if ($type === 'instructor') {
        $permission = 2;
    }

    $crud = new Crud();

    $user_data = [
        'username' => $username,
        'password' => $password,
        'permission' => $permission
    ];

    $user_id = $crud->register('users', $user_data);

    if ($user_id) {

        if ($type === 'student') {
            // Insert into students table
            $student_data = [
                'user_id' => $user_id,
                'student_name' => $name,
                'email' => $email,
                'phone_number' => $phone_number
            ];

            $student_id = $crud->register('students', $student_data);

            if ($student_id) {
                echo "<script>alert('Student registration successful');</script>";
                echo '<meta http-equiv="refresh" content="0; url=login.php">';
            } else {
                echo "<script>alert('Failed to register student data');</script>";
            }
        } elseif ($type === 'instructor') {
            // Insert into instructors table
            $instructor_data = [
                'user_id' => $user_id,
                'instructor_name' => $name,
                'email' => $email,
                'phone_number' => $phone_number
            ];

            $instructor_id = $crud->register('instructors', $instructor_data);

            if ($instructor_id) {
                echo "<script>alert('Instructor registration successful');</script>";
                echo '<meta http-equiv="refresh" content="0; url=login.php">';
            } else {
                echo "<script>alert('Failed to register instructor data');</script>";
            }
        }
    } else {
        echo "<script>alert('Failed to register user data');</script>";
    }
}
?>
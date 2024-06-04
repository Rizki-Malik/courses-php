<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/demo/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<body>
<script src="../assets/js/preloader.js"></script>
<div class="body-wrapper">
  <div class="main-wrapper">
    <div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
      <main class="auth-page">
        <div class="mdc-layout-grid">
          <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-6-tablet">
              <div class="mdc-card">
                <form method="post" action="registration.php?type=<?php echo $_GET['type']; ?>">
                  <div class="mdc-layout-grid">
                    <div class="mdc-layout-grid__inner">
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                        <div class="mdc-text-field w-100">
                          <input class="mdc-text-field__input" id="name" name="name" required>
                          <div class="mdc-line-ripple"></div>
                          <label for="name" class="mdc-floating-label">Full Name</label>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                        <div class="mdc-text-field w-100">
                          <input class="mdc-text-field__input" id="email" name="email" required>
                          <div class="mdc-line-ripple"></div>
                          <label for="email" class="mdc-floating-label">Email</label>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field w-100">
                          <input class="mdc-text-field__input" type="text" id="phone_number" name="phone_number" value="+62" required>
                          <div class="mdc-line-ripple"></div>
                          <label for="phone_number" class="mdc-floating-label">Phone Number</label>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field w-100">
                          <input class="mdc-text-field__input" id="username" name="username" required>
                          <div class="mdc-line-ripple"></div>
                          <label for="username" class="mdc-floating-label">Username</label>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <div class="mdc-text-field w-100">
                          <input class="mdc-text-field__input" type="password" id="password" name="password" required>
                          <div class="mdc-line-ripple"></div>
                          <label for="password" class="mdc-floating-label">Password</label>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <button type="submit" name="register" class="mdc-button mdc-button--raised w-100">
                              Register
                          </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
          </div>
        </div>
      </main>
    </div>
  </div>
</div>
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="../assets/js/material.js"></script>
<script src="../assets/js/misc.js"></script>
<!-- endinject -->
</body>
</html>

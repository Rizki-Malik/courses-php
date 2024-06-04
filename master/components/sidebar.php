<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
  <div class="mdc-drawer__header">
    <a href="../../index.php" class="brand-logo">
      Course Programming
    </a>
  </div>
  <div class="mdc-drawer__content">
    <div class="user-info">
      <p class="name"><?= $name ?></p>
      <p class="email"><?= $email ?></p>
    </div>
    <div class="mdc-list-group">
      <nav class="mdc-list mdc-drawer-menu">
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link" href="../dashboard/index.php">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
            Dashboard
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
            Admin
            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
          </a>
          <div class="mdc-expansion-panel" id="ui-sub-menu">
            <nav class="mdc-list mdc-drawer-submenu">
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="../artikel/artikel.php">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">library_books</i>
                  Articles
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="../kategori/kategori.php">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">library_add</i>
                  Categories
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="../murid/murid.php">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">group</i>
                  Students
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="../guru/guru.php">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">school</i>
                  Instructors
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="../courses/course.php">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">class</i>
                  Courses
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="pages/ui-features/typography.html">
                  Example
                </a>
              </div>
            </nav>
          </div>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui3-sub-menu">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">book</i>
            Learning Materials
            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
          </a>
          <div class="mdc-expansion-panel" id="ui3-sub-menu">
            <nav class="mdc-list mdc-drawer-submenu">
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="../materi/materials.php">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">library_books</i>
                  Materials
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="#">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">library_add</i>
                  Categories
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="#">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">group</i>
                  Students
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="#">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">class</i>
                  Instructors
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="pages/ui-features/typography.html">
                  Example
                </a>
              </div>
            </nav>
          </div>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui2-sub-menu">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">person</i>
            Learning Progress
            <i class="mdc-drawer-arrow material-icons">chevron_right</i>
          </a>
          <div class="mdc-expansion-panel" id="ui2-sub-menu">
            <nav class="mdc-list mdc-drawer-submenu">
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="#">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">library_books</i>
                  Articles
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="#">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">library_add</i>
                  Categories
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="#">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">group</i>
                  Students
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="#">
                  <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">class</i>
                  Instructors
                </a>
              </div>
              <div class="mdc-list-item mdc-drawer-item">
                <a class="mdc-drawer-link" href="pages/ui-features/typography.html">
                  Example
                </a>
              </div>
            </nav>
          </div>
        </div>
      </nav>
    </div>
    <div class="profile-actions">
      <a href="javascript:;">Settings</a>
      <span class="divider"></span>
      <a href="../../auth/logout.php">Logout</a>
    </div>
  </div>
</aside>
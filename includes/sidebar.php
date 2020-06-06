<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?php echo($activeMenu == "dashboard" ? "active" : ""); ?>" href="dashboard.php">
          <span data-feather="dashboard"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo($activeMenu == "training" ? "active" : ""); ?>" href="training.php">
          <span data-feather="training"></span>
          Training
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo($activeMenu == "lap" ? "active" : ""); ?>" href="lap-analysis.php">
          <span data-feather="lap-analysis"></span>
          Lap Analysis
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo($activeMenu == "settings" ? "active" : ""); ?>" href="settings.php">
          <span data-feather="settings"></span>
          Settings
        </a>
      </li>
    </ul>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#" style="font-size:16px ;">POWER FUEL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: #4287f5;">Dashboard</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="">Welcome! | <?php echo $_SESSION['user_name']; ?> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" style="color: #4287f5;">Log out</a>
      </li>
    </ul>
  </div>
</nav>
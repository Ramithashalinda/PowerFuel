<?php session_start(); ?>
<?php
// checking if the user logged in
if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_type'])){
    // if not logged page riderect to index page
    header('Location: index.php');

}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <title>Change Password</title>
</head>
<body>
<input type="hidden" id="uemail" name="uemail" value= "<?php echo $_SESSION['user_email'] ?>" >
  <div class="container my-5">
    <h1 class="text-center">Change Password</h1>
    <form>
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" class="form-control" id="current-password" placeholder="Enter your current password">
        <div id="current-password-error" class="invalid-feedback"></div>
      </div>
      <div class="form-group">
        <label for="new-password">New Password</label>
        <input type="password" class="form-control" id="new-password" placeholder="Enter your new password">
        <div id="new-password-error" class="invalid-feedback"></div>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-password" placeholder="Confirm your new password">
        <div id="confirm-password-error" class="invalid-feedback"></div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</body>
<script src="js/common.js"></script>
</html>
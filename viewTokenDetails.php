<?php session_start(); ?>
<?php require_once('include/connections.php'); ?>

<?php
// checking if the user logged in
if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_type'])){
    // if not logged page riderect to index page
    header('Location: index.php');

}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>Check Token</title>
  </head>
  <body>
  <?php include("include/nav_dealer.php "); ?>
  <section>
    <div class="container">
      <h1 class="text-center my-5">Check Token</h1>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <form>
            <div class="form-group">
              <label for="number">Enter Token Number/Vehicle No:</label>
              <input type="text" class="form-control" id="number" placeholder="Enter a number" autofocus>
            </div>
            <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
          </form>
        </div>
      </div>
      </div>

    <div class="row justify-content-center my-5">
        <div class="col-md-6">
            <table class="table table-bordered" id="result-table">
                <thead>
                <tr>
                    <th>T.No</th>
                    <th>Vehicle</th>
                    <th>FuelType</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tblToken">
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </section>.
    <?php include("include/footer.php "); ?>
    <script src="js/dealer.js"></script>
  </body>
  </html>

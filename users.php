<?php session_start(); ?>


<?php
// checking if the user logged in
if(!isset($_SESSION['user_id'])){
 // if not logged page riderect to index page
 header('Location: index.php');
}
$_SESSION['xx']="90%"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Fuel - Token</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body>
<?php include("include/nav_customer.php "); ?>
  <section>
      <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-3">
                  <div class="card p-3 mb-2">
                  <div class="icon"> <i class="fa fa-car"></i></div>
                        <div class="mt-5">
                            <h3 class="heading">Total Allocation</h3>
                            <div class="mt-5">
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" id="progressAllo" name="progressAllo" style="width:0" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><p id="showPercentage"></div>
                                </div>
                                <div class="mt-3"> <span class="text1" id="CardFueltype1">Select Vehicle</span><span class="text2" id="CardFuelAllo"></span> </div>
                            </div>
                        </div>
                  </div>
            </div>
            
            <div class="col-md-3">
                    <div class="card p-3 mb-2">
                    <div class="icon"> <i class="bx bxl-mailchimp"></i></div>
                          <div class="mt-5">
                              <h3 class="heading">Total Consumed</h3>
                              <div class="mt-5">
                                  <div class="progress" style="height: 20px;">
                                      <div class="progress-bar" role="progressbar" id="progressCons" name="progressCons" style="width:0" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><p id="showPercentage"></div>
                                  </div>
                                  <div class="mt-3"> <span class="text1" id="CardFueltype">Select Vehicle</span><span class="text2" id="CardFuelCons"></span> </div>
                              </div>
                          </div>
                    </div>
              </div>

              <div class="col-md-3">
                    <div class="card p-3 mb-2">
                    <div class="icon"> <i class="bx bxl-mailchimp"></i></div>
                          <div class="mt-5">
                              <h3 class="heading">Left Amount</h3>
                              <div class="mt-5">
                                  <div class="progress" style="height: 20px;">
                                      <div class="progress-bar" role="progressbar" id="progressLeft" name="progressLeft" style="width:0" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><p id="showPercentage"></div>
                                  </div>
                                  <div class="mt-3"> <span class="text1" id="CardFueltype2">Select Vehicle</span><span class="text2" id="CardFuelleft"></span> </div>
                              </div>
                          </div>
                    </div>
              </div>
      
      <!--Container 1close-->
      </div></br>

      <div class="container">

        <div class="d-flex flex-wrap align-items-center bg-light">
            <!--col1 start-->
            <div class="col">
            <input type="hidden" id="uemail" name="uemail" value= "<?php echo $_SESSION['user_email'] ?>" >
            <form id="reqForm" name="reqForm">
          
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="vehicleNo">Vehicle</label>
                <select id="vehicleNo" name="vehicleNo" class="form-control" onchange="showFuelType(this.value)" required>
                  <option value="">
                        Select Vehicle
                  </option>
                </select>
              </div>
            </div>

              <div class="form-row">       
                <div class="form-group col-md-4">
                  <label for="validationServer02">Fuel Type</label>
                  <input type="text" class="form-control" id="fuelType" name="fuelType"  required readOnly>
                </div>

                <div class="form-group col-md-4">
                  <label for="vehicleNo">Fuel Category</label>
                  <select id="fuelCategory" name="fuelCategory" class="form-control" onchange="getCategoryPrice(this.value)" required>
                    <option value="">Select Category</option>
                  
                  </select>
                </div>
              </div>
          
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="reqDate">Date</label>
                  <input type="date" id="reqDate" name="reqDate" class="form-control" placeholder="Select Date" required>
                </div>
            
                <div class="form-group col-md-4">
                  <label for="reqTime">Time</label>
                  <input type="time" min="00:00" class="form-control" id="reqTime" name="reqTime" placeholder="Select Time" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                <span class="badge badge-info" id="showA"></span><br/>
                  <!-- <div class="progress" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" id="progressLeft1" name="progressLeft1" style="width:0" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                  </div></br> -->
                  <label for="reqAmount">Enter Qty (L)</label>
                  <input type="number" class="form-control" id="reqAmount" name="reqAmount" placeholder="Enter Amount" required>
                  <!-- <span><p id="showP"></p></span> -->
                </div>

                <div class="form-group col-md-4">
                <span class="badge badge-warning" id="showUP"></span><br/>
                <label for="totalPrice">Total Price</label>
                  <input type="text" class="form-control" id="totalPrice" name="totalPrice" placeholder="" readonly>
                  <!-- <span><p id="showP"></p></span> -->
                </div>
              </div>
              <button type="button" name="submit" id="submit" onclick="reToken()" style="width: auto; margin-left:15px;" class="btn btn-primary btn-lg btn-block">Request Fuel</button>
            </from> 

            </div>
            <!--col2 start-->
            <div class="col"></br>
            <h4 class="heading">Token History (This Month)</h4>
            <table class="table" id="result-table">
              <thead>
                <tr>
                  <th scope="col">T.No</th>
                  <th scope="col">Vehicle</th>
                  <th scope="col">Fuel</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Price</th>
                  <th scope="col">Status</th>
                  <th scope="col">#</th>
                </tr>
              </thead>
              <tbody id="tokenTBody">
             
              </tbody>
            </table>      
            </div>
        </div>

  <!--Container 2close-->
  </div>                         
  </section><br/></br>
  
  <!-- Modal -->
  <div class="modal fade" id="barcodeModal" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="barcodeModalLabel">Barcode (click on image to download)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="barcodeContainer">
          <!-- Barcode image will be displayed here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><br><br>


  <?php include("include/footer.php "); ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="js/customer.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
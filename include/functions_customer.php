

<?php 
require_once('connections.php');
require_once("../Admin/emailService.php");

if(isset($_POST['allocation']))
{
    $Vtype= $_POST['Vtype'];
    $amount=0;

    global $connection;
    $sql = "SELECT * FROM fuelallocation WHERE vehicleType = '{$Vtype}'";
    $result_set = mysqli_query($connection, $sql);
   
        if(mysqli_num_rows($result_set) > 0){

            $data = mysqli_fetch_assoc($result_set);
            $amount=$data['amount'];
        }
        echo json_encode(array("amount"=>"$amount"));

}

if(isset($_POST['reqToken']))
{
    $vehicleNo = $_POST['vehicleNo'];
    $fuelType = $_POST['fuelType'];
    $reqDate = $_POST['reqDate'];
    $reqTime = $_POST['reqTime'];
    $reqAmount = $_POST['reqAmount'];
    $email = $_POST['email'];
    $price=$_POST['price'];
    $fuelCategory=$_POST['fuelCategory'];

     global $connection;
     $sql = "INSERT INTO fuelrequest (email,regNo,fuelType,date,time,amount,price,category) VALUES ('{$email}','{$vehicleNo}','{$fuelType}','{$reqDate}','{$reqTime}','{$reqAmount}','{$price}','{$fuelCategory}')";
     $result=mysqli_query($connection, $sql);
     if ($result) {
        $token = $connection->insert_id;
        tokenReqEmail($email, $token, $fuelType, $fuelCategory,  $vehicleNo, $reqAmount, $reqDate, $reqTime);
        echo json_encode(array("success"=>"Request Successfull. Your token number is $token"));
      } else {
        $erros=mysqli_error($connection);
        echo json_encode(array("success"=>$erros));
      }
  
      //echo json_encode(array("success"=>"$vehicleNo"));

}

if(isset($_POST['totalConsumed']))
{
    $regNo= $_POST['RegNo'];
    global $connection;
    $TotalAmount=0;
    $current_month = date("m"); // get the current month
    $current_year = date("Y"); // get the current year
    $sql1 = "SELECT SUM(amount) AS TotAmount FROM fuelrequest WHERE regNo='{$regNo}' AND isCancelled=0 AND MONTH(date) = $current_month AND YEAR(date) = $current_year";
    $result = mysqli_query($connection, $sql1);

        if(mysqli_num_rows($result) > 0){

            $data = mysqli_fetch_assoc($result);
            $TotalAmount=$data['TotAmount'];
            
        }

    //$leftAmount=($MaxAmount-$TotalAmount);
    echo json_encode(array("Consume"=>"$TotalAmount"));
}

// function getCustomerVehicles($email)
// {
//     global $connection;
//     $sql = "SELECT * FROM vehicle WHERE email='$email'";
//     $result_set = mysqli_query($connection, $sql);

//     $rows = array();
//     while ($row = mysqli_fetch_object($result_set)) {
//         $rows[] = $row;

//     }

//         if(mysqli_num_rows($result_set) > 0){

//             $data = mysqli_fetch_assoc($result_set);
//         }
//         $array = json_decode(json_encode($rows), true);
//         return $array;
// }

if(isset($_POST['getVehicles']))
{
    global $connection;
    $email= $_POST['mail'];

    $sql = "SELECT regNo FROM vehicle WHERE email='{$email}'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) > 0){

        while ($row = mysqli_fetch_array($result)) {
            
          echo ' <option value='.$row["regNo"].'>
                '.$row["regNo"].'
                </option>';
        }
    }
}


if(isset($_POST['getCategories']))
{
    global $connection;
    $type= $_POST['fuelType'];
    $tbl = $_POST['getCategories'];

    $sql = "SELECT category FROM $tbl WHERE fueltype='{$type}'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) > 0){

        while ($row = mysqli_fetch_array($result)) {
            
          echo ' <option value='.$row["category"].'>
                '.$row["category"].'
                </option>';
        }
    }
       
}

if(isset($_POST['getCategoryPrice']))
{
    global $connection;
    $category= $_POST['category'];
    $tbl = $_POST['getCategoryPrice'];
    $sql = "SELECT price FROM $tbl WHERE category='{$category}'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) > 0){

        while ($row = mysqli_fetch_array($result)) {
            
          echo $row["price"];
                
        }
    }
    else
    {
        echo ' <option value="">
        Category not found
        </option>';
    }
       
}

if(isset($_POST['vehicleSelect']))
{
    $regNo= $_POST['regNo'];
    global $connection;
    $sql1 = "SELECT * FROM vehicle WHERE regNo='{$regNo}'";
    $result = mysqli_query($connection, $sql1);

        if(mysqli_num_rows($result) > 0){

            $data = mysqli_fetch_assoc($result);
            $Ftype=$data['fuelType'];
            $Vtype=$data['vehicleType'];
        }
    echo json_encode(array("Fueltype"=>"$Ftype","vehicleType"=>"$Vtype"));
}

if(isset($_POST['getToken']))
{
    global $connection;
    $email = $_POST['email'];
    $btn="N/A";

    $sql = "SELECT * FROM fuelrequest WHERE email='{$email}'";
    $result = mysqli_query($connection, $sql);
    //loop through the result and store data in an array
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            
            $ststus='<span class="badge badge-pill badge-info">Valid</span>';
            if($row["isPumped"]==1)
            {
                $ststus='<span class="badge badge-pill badge-danger">Expired</span>';
                $btn="N/A";
            }
    

            if($row["isCancelled"]==1)
            {
                $ststus='<span class="badge badge-pill badge-warning">Cacelled</span>';
                $btn="N/A";
            }
          

            if($row["isPumped"]==0 && $row["isCancelled"]==0)
            {
                $id=$row['id'];
                $btn="<button type='button' class='btn btn-success btn-sm' onclick=generateTokenBarcode('$id')>Barcode</button>";
            }
            else
            {
                $btn="N/A";
            }
            
            echo '<tr>
                <td style="font-size: 12px;">'.$row["id"].'</td>
                <td style="font-size: 12px;">'.$row["regNo"].'</td>
                <td style="font-size: 12px;">'.$row["fuelType"].'</td>
                <td style="font-size: 12px;">'.$row["date"].'</td>
                <td style="font-size: 12px;">'.$row["time"].'</td>
                <td style="font-size: 12px;">'.$row["amount"].'</td>
                <td style="font-size: 12px;">'.$row["price"].'</td>
                <td style="font-size: 12px;">'.$ststus.'</td>
                <td style="font-size: 12px;">'.$btn.'</td>
                </tr>';
        }
    }
    else
    {
        $err=mysqli_error($connection);
        echo $err;
    }
   

}
  
// mysqli_close($connection);
//<?php getTokenHistory($_SESSION['user_email']); 
?>
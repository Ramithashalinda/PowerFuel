<?php 
require_once('connections.php'); 
require_once("../Admin/emailService.php"); 

if(isset($_POST['retriveTokenInfo']))
{
    global $connection;
    $input = $_POST['input'];
    
    $btn="N/A";
    $current_month = date("m"); // get the current month
    $current_year = date("Y"); // get the current year
    $sql = "SELECT * FROM fuelrequest WHERE id = '{$input}' OR regNo = '{$input}' AND isCancelled=0 AND MONTH(date) = $current_month AND YEAR(date) = $current_year";
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
                $btn="<button type='button' onclick='tokenClick()' id='btn' value=".$row['id']." class='btn btn-primary'>Pump</button>";
            }
            else
            {
                $btn="N/A";
            }

            echo '<tr>
                <td style="display:none;">'.$row["email"].'</td>
                <td style="font-size: 12px;">'.$row["id"].'</td>
                <td style="font-size: 12px;">'.$row["regNo"].'</td>
                <td style="font-size: 12px;">'.$row["fuelType"].'</td>
                <td style="font-size: 12px;">'.$row["category"].'</td>
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
        echo'<p>No Records</p>';
    }
   
}

if(isset($_POST['isPumped']))
{
    $token= $_POST['token'];
    $qty= $_POST['qty'];
    $regNo= $_POST['regNo'];
    $email= $_POST['email'];

    $status="Token updated successfull";
    global $connection;
    $sql = "UPDATE fuelrequest SET isPumped='1' WHERE id = '{$token}'";
    $result = mysqli_query($connection, $sql);
   
        if($result)
        fuelFillingConfirmEmail($email, $regNo, $qty);
        else
        $status=mysqli_error($connection);
       
        echo $status;

}
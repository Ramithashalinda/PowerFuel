    <?php require_once('connections.php');

    function verify_query($result_set){
        global $connection;
        if(!$result_set){

            die("Database error : " . mysqli_error($connection));
        }
    }

    if(isset($_POST['changePW']))
    {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = mysqli_real_escape_string($connection,$_POST['newPassword']);
        $email=$_POST['email'];
        $hashed_password = sha1($newPassword);

        $status="";
        global $connection;
        $sql = "SELECT * FROM user WHERE email = '{$email}' AND password = '{$hashed_password}'";

        if(mysqli_query($connection, $sql)){
    
            $query = "UPDATE user SET password ='{$hashed_password}' WHERE email ='{$email}'";
            $result = mysqli_query($connection, $query);

            if($result){
                $status="Password Updated Successfull";
            }
            else
            {
                $status=mysqli_error($connection);
            }
        }
        else
        {
            $status=mysqli_error($connection);
        }
    
        echo $status;
    }    

    function validateCurrentPw($pw,$email)
    {
        $isValide=false;
        global $connection;
        $hashed_password = sha1($pw);

        
        echo  $isValide;
    }

    ?>
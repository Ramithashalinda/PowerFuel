<?php require_once('include/connections.php'); ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>
<body style="background: rgb(244,244,244);box-shadow: 0px 0px;">
<section id="login-section" style="height: 100vh;">
        <div class="container">
            <div class="row justify-content-center py-5 mt-5">
                <div class="col col-12 col-md-6">
                    <form action="" method="POST" name="userform" id="userform" class="d-lg-flex flex-column justify-content-center" style="padding: 40px;background: #ffffff;box-shadow: 0px 0px 1px rgb(84,84,84);">
                        
                        <h1 class="login-heading">USER | DETAILS</h1>
                        <!-- <div class="form-group mt-5">
                            <select name="myselect" id="myselect" onchange="this.form.submit()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                         </select>
                        </div> -->
                        <div class="form-group mt-5"><input class="form-control" type="text" name="user_id" id="user_id" onkeyup="doAjax()"  placeholder="enter user id" style="width: px;"></div>
                        <div class="form-group"><input class="form-control" type="text" name="user_firstname" id="user_firstname" placeholder="first name"></div>
                        <div class="form-group"><input class="form-control" type="text" name="user_lastname" id="user_lastname"  placeholder="last name"></div>
                        <div class="form-group"><button class="btn btn-primary btn-block btn-login" type="submit">SEND</button></div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>


<script>
    function doAjax(){

        let user_id = document.getElementById("user_id").value;

        fetch("http://localhost/POWER-FUEL/search.php?user_id=" + user_id, {
            method: 'get',
            }).then((response) => {
                return response.json()
            }).then((res) => {
                console.log(res);
                document.getElementById("user_firstname").value = res.firstName;
                document.getElementById("user_lastname").value = res.lastName;
            }).catch((error) => {
                console.log(error)
            })

    }
</script>

    
</body>
</html>
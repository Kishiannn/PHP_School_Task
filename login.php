<?php 

require "conn.php";

function login($username, $password){

    $conn = connection();
    $sql = "SELECT username,password FROM users WHERE username ='$username' ";


    if ($result = $conn->query($sql)) {
        #check if there is a query result (did the username exist)
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            //contains the specific date pulled via fectch request $result
            #check if the password is correct
            if(password_verify($password, $user["password"])){                
                session_start();

                $_SESSION["id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["full_name"] = $user["first_name"] ." ". $user["last_name"];

                header("location: index.php");
                exit;
            } 
            else{
                echo '<div class="alert alert-danger">Incorrect password.</div>';  
            }
            }else{
                echo '<div class="alert alert-danger"> Username not found </div>';
        }
    }           else{
        die("Error retrieving the user: . $conn -> error ");
}
}
        
    

if(isset($_POST["btn_login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    login($username, $password);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Log in</title>
</head>
<body class="bg-light">
<div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto p-0x">
                 <div class="card header text-primary">  
                <h1 class="card-title text-center bg.light mb-0">Sibin Ilibin </h1>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-5"><label for="username" class="form-label small fw-bold">Username</label><input type="text" name="username" id="username" maxlenght="15" required  class="form-control fw-bold">
                    </div>
                        <div class="mb-5"><label for="password" class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>    
                    </div>
                    <button type="submit" name="btn_login" class="btn btn-primary w-100">Log-In</button>
                    </form>
                </div>
            </div>            
        </div>     
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

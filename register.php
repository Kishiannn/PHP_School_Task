<?php 
require "conn.php";

function createUser ($firstname, $lastname, $username, $password){
    $conn = connection();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`) VALUES ('$firstname', '$lastname', '$username', '$password')";
//CHECK CONNECTION 
    if ($conn->query($sql)){
        header("location: login.php");
}else {
    die("Error Signing up:". $conn->error);
}

}
if(isset($_POST['btn_signup']) ){
    //form data capture
    $firstname =$_POST['first_name'];
    $lastname =$_POST['last_name'];
    $username =$_POST['username'];
    $password =$_POST['password'];
    $confirmpassword =$_POST['confirm_password'];
    //check password correction
    if ($password == $confirmpassword){
        //if correct, then create user function
        createUser($firstname, $lastname, $username, $password); // ignore error
    } else {
        echo'<p class="alert alert-danger">Password and Confirm Password do not match.</p>';

    }

}
?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign up</title>
</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto p-0x">
                 <div class="card header text-success">  
                <h1 class="card-title h3 mb-0"> Create your Account </h1>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3"><label for="first-name" class="form-label small fw-bold">First Name</label><input type="text" name="first_name" id="first-name" maxlenght="50" required autofocus class="form-control fw-bold">
                    </div>
                        <div class="mb-3"><label for="last-name" class="form-label small fw-bold">Last Name</label><input type="text" name="last_name" id="last-name" maxlenght="50" required  class="form-control fw-bold">
                    </div>
                        <div class="mb-3"><label for="username" class="form-label small fw-bold">Username</label><input type="text" name="username" id="username" maxlenght="15" required  class="form-control fw-bold">
                    </div>
                        <div class="mb-3"><label for="password" class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>    
                    </div>
                        <div class="mb-5"><label for="confirm-password" class="form-label small fw-bold">Confirm Password</label><input type="password" name="confirm_password" id="confirm-password" class="form-control mb-2" required>
                    </div>
                    <button type="submit" name="btn_signup" class="btn btn-success w-100">Submit</button>
                    </form>
                </div>
            </div>            
        </div>     
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

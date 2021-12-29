<?php
session_start();

include("functions.php");
include("connectdb.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Something was posted
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);

    if(!empty($email) && !empty($password))
    {
        //read from the database

        $query = "select * from userlogin where email = '$email' limit 1";

        $result = mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die; 
                }
            }
        }

    }else
    {
        echo "Please enter some valid information!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>    
        <style>
            body {
                background-image: url("./images/login.jpg");
                background-position: center;
                /* Center the image */
                background-repeat: no-repeat;
                /* Do not repeat the image */
                background-size: cover;
                /* Resize the background image to cover the entire container */
            }
        </style>
        <title>Login Page</title>
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
<body>


    <div id="box">
        <form method="post">
            <div style=" font-size: 20px; margin: 10px">Welcome to the Login Page </div>
            <label for="email">Email: </label>
            <input id="text" type="email" name="email">

            <label for="password"> Password: </label>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a id="button" href="signup.php">Create an account </a><br>
        </form>

    </div>
</body>

</html>
<?php 
session_start();

	include("connectdb.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
        $user_name = ($_POST['user_name']);
        $email = ($_POST['email']);
        $password = ($_POST['password']);
        $Confirm_Password = ($_POST['Confirm_Password']);

        if(!empty($user_name) && !empty($email) && !empty($password) && !empty($Confirm_Password))
		{

			//save to database
            $user_id = random_num(20);
            $query = "insert into userlogin (user_id,user_name,email,password,Confirm_Password) values('$user_id','$user_name','$email','$password','$Confirm_Password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Signup Page</title>
        <link href="css/style.css" type="text/css" rel="stylesheet" />
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

    </head>
<body>
    <div id="box">
        <form method="post">
            <div style=" font-size: 20px; margin: 10px">Create your account below </div>

            <label for="user_name"> Username: </label>
            <input id="text" type="text" name="user_name" placeholder="Ben10" required>

            <label for="email">Email: </label>
            <input id="text" type="email" name="email" placeholder="ben10@gmail.com" required>
            
            <label for="password"> Password: </label>
            <input id="text" type="password" name="password" required>

            <label for="Confirm_Password">Confirm Password: </label>
            <input id="text" type="password" name="Confirm_Password" required><br><br>

            <button id="button"  type="submit" value="submit" onclick="return validateForm()">Signup</button><br><br>

            <a id="button" href="login.php">Login</a><br><br>
        </form>

    </div>
<script type = "text/javascript">
    function validateForm()
    {
        var pass = document.getElementById("password").value;
        var cpass = document.getElementById("Confirm_Password").value;
    if (pass != cpass){
        alert("Password do not match! ");
        return false;

    }else
    {
        return true;
    }
    }
</script>
</body>

</html>
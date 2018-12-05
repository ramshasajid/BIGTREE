<?php

session_start();

$db = mysqli_connect("localhost","root","","bigtree");// or die('unable to connect');

//Registration Code

if(isset($_POST['submit_btn']))
{
	$first_name = $_POST['first_name'];	
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$conf_password = $_POST['con_pswd'];
	$user_type = $_POST['type'];
	
	if ($password == $conf_password)
	{
		$password = md5($password);
		
		//check for unique email
		$sql = "SELECT * FROM users WHERE email='$email'";
		$query_run = mysqli_query($db,$sql);
		$query_check = mysqli_num_rows($query_run);
		if($query_check == 1)
		{
			echo '<script type = "text/javascript"> alert("Email id already registered try another Email id ") </script>';
		}
		else
		{
			//create users
		
			$sql = "Insert into users (first_name, last_name, email, password, type) values ('$first_name','$last_name','$email','$password','$user_type')";
			mysqli_query($db,$sql);
			echo '<script type = "text/javascript"> alert("Registration successful. Please login to use the website ") </script>';
			//$_SESSION['message'] = "Registration successful";
			$_SESSION['first_name'] = $first_name;
			header("location: registration.php");
		}
	}	
	else
	{
		//failed
		echo '<script type = "text/javascript"> alert("Password and confirm password does not match ") </script>';
	}
	
}	

//login code
		
		if(isset($_POST['login_btn']))
		{	
			
			$email = $_POST['email'];	
			$password = $_POST['pswd'];
			
			$password = md5($password);
			/*
			$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
			$query_run = mysqli_query($db,$sql);
			$query_check = mysqli_num_rows($query_run);
			if($query_check == 1)
			select * from  user_db where email='".$email."' and password='".$password."'"
			$sqli = "SELECT * FROM users WHERE email='".$email."' AND password='".$password."'"; //or die("Failed to connect to DB".mysqli_error());
			$row = mysqli_fetch_array($db,$sql);
			if($row['email'] == $email && $row['password'] == $password)*/
			$sqli = "SELECT * FROM users WHERE email='$email' AND password='$password'";	
			$qrun = mysqli_query($db,$sqli);
			$qcheck = mysqli_num_rows($qrun);
			if($qcheck == 1)
			{
				echo '<script type = "text/javascript"> alert("Welcome!") </script>';
				//VALID
				//$_SESSION['first_name'] = $first_name;
				header('location:home_siva.php');
				//echo '<script type = "text/javascript"> alert("Email id already exists try another Email id ") </script>';	
			}
			else
			{
				echo '<script type = "text/javascript"> alert("Invalid email address or password") </script>';
			}
		}

//mysqli_select_db($mysqli,'bigtree');
/*
$mysqli = mysqli_connect('localhost', 'root', '' ) or die('unable to connect');
mysqli_select_db('bigtree',$mysqli);

require 'dbconfig/config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	if($_POST['pswd']) == $_POST['con-pswd']{
		$first_name = $mysqli->real_escape_string($POST['first_name']);	
		$last_name = $mysqli->real_escape_string($POST['last_name']);
		$email = $mysqli->real_escape_string($POST['email']);
		$password = md5($_POST['password']);
	}
}
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BigTree</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login_styles.css">
    <style>
    </style>
    <script>
    </script>
</head>

<body>

    <div class="bg-image"></div>
    <!-- <div class="header">
            <img src="Bigtree_logo.JPG" alt="Bigtree_logo" width="100" height="100"><h1> BIGTREE</h1>
        </div> -->

    <img src="final.JPG" alt="Bigtree_logo">

    <!-- <div class="header"> -->
    <!-- <img src="Bigtree_logo.JPG" alt="Bigtree_logo" width="100" height="100"> -->
    <!-- <h1> Bigtree</h1>
        </div> -->

    <!-- <div class="header"><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button></div> -->
    <div id="signupModal" class="modal">
        <form class="modal-content animate" action="registration.php" method="POST">
            <div>
                <span style="text-align: center;" class="registration_title input-field">
                    Registration
                </span>
                <span class="close" onclick="document.getElementById('signupModal').style.display='none'">&times;</span></div>
            <div class="container">
                <div class="input-field">
                    <!-- <label for="fname"><b>First Name:</b></label><br /> -->
                    <input type="text" placeholder="First Name" name="first_name" required>
                </div>

                <div class="input-field">
                    <!-- <label for="lname"><b>Last Name:</b></label><br /> -->
                    <input type="text" placeholder="Last Name" name="last_name" required>
                </div>

                <div class="input-field">
                    <!-- <label for="mailid"><b>E-mail:</b></label><br /> -->
                    <input type="text" placeholder="Email" name="email" required>
                </div>

                <div class="input-field">
                    <!-- <label for="pswd"><b>Password</b></label><br /> -->
                    <input type="password" placeholder="Password" name="password" required>
                </div>

                <div class="input-field">
                    <!-- <label for="con-pswd"><b>Confirm Password</b></label><br /> -->
                    <input type="password" placeholder="Confirm Password" name="con_pswd" required>
                </div> 

				<div class="input-field">
                   <!--<label for="con-pswd"><b>Confirm Password</b></label><br /> 
								<input type="Text" placeholder="Type" name="type" required>-->
								<select name="type">
										<option selected hidden value="">User Type</option>
										<option value="User">User</option>
										<option value="Admin">Admin</option>
								</select>		
                </div>  

                <button class="signupBtn" type="submit" name="submit_btn">Sign Up</button>

            </div>
        </form>
		
		
    </div>
    <!-- <div id="signupModal" class="signup">
        <form class="modal-content animate">
                <div><span>
                        <h1>Online Registration</h1>
                    </span>
                    <span class="close">&times;</span></div>
                <div class="container">
                    <div class="input-field">
                        <label for="fname"><b>First Name:</b></label><br />
                        <input type="text" placeholder="Enter your first name" name="fname" required>
                    </div>
        
                    <div class="input-field">
                        <label for="lname"><b>Last Name:</b></label><br />
                        <input type="text" placeholder="Enter your last name" name="lname" required>
                    </div>
        
                    <div class="input-field">
                        <label for="mailid"><b>E-mail:</b></label><br />
                        <input type="text" placeholder="Enter your email ID" name="mailid" required>
                    </div>
        
                    <div class="input-field">
                        <label for="pswd"><b>Password</b></label><br />
                        <input type="password" placeholder="Enter your password" name="pswd" required>
                    </div>
        
                    <div class="input-field">
                        <label for="con-pswd"><b>Confirm Password</b></label><br />
                        <input type="password" placeholder="Re-enter your password" name="con-pswd" required>
                    </div>
        
                    <button type="submit">Sign Up</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>
            </form>
        
        </div> -->
    <div class="login">
        <h1>Log In</h1>
        <form action="registration.php" method="POST"> 
            <div class="login-parameters">
                <div class="input-field">
                    <!-- <label for="name"><b>Email</b></label><br /> -->
                    <input type="text" placeholder="Email" name="email" required>
                </div>
                <div class="input-field">
                    <!-- <label for="psw"><b>Password</b></label><br /> -->
                    <input type="password" placeholder="Password" name="pswd" required>
                </div>
                <div style="margin-top: 10px; margin-left: 8%">
                    <a href="">Forgot Password?</a>
                    <!-- <input type="checkbox" name="remember">
                    <label for="remember">Remember me</label> -->
                    <!--                 
                    <input type="checkbox" checked="checked" style="width: 5%" name="remember">
                    <label  style="position: absolute; bottom: 18%;"for="remember">Remember me</label> -->
                </div>
            </div>
            <button class="signInBtn" type="submit" name="login_btn" >Sign In</button>
            <div style="margin-top: 20px;"> Haven't registered yet? <button class="clickBtn" onclick="document.getElementById('signupModal').style.display='block'"
                    style="width:auto;" href="" id="signupBtn">Click
                    here</button>
                <!-- <button id="signupBtn" type="submit">Sign Up</button> -->
            </div>
        </form>
    </div>


    <!-- <script>
            // Get the modal
            var modal = document.getElementById('signupModal');

            // Get the button that opens the modal
            var btn = document.getElementById("signupBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // modal.style.display="none";


            // When the user clicks the button, open the modal 
            btn.onclick = function () {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // // When the user clicks anywhere outside of the modal, close it
            // window.onclick = function (event) {
            //     if (event.target == modal) {
            //         modal.style.display = "none";
            //     }
            // }
        </script> -->

</body>

</html>
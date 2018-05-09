
<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database

	include("dbconnect.php");
	
	// LOGIN USER
	if (isset($_POST['login_user'])) {
		
		if(isset($_POST['username']))
			{
			  $username = mysqli_real_escape_string($connection,$_POST['username']);
			}
		if (isset($_POST['password'])) 
			{
			  $password = mysqli_real_escape_string($connection,$_POST['password']);
			}

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			
			$passcheckquery = "Select PasswordSalt, HashedPass from login where UserName = '$username'";
			$result = mysqli_query($connection,$passcheckquery);		
			$row = mysqli_fetch_array($result);
			$stored_salt = $row['PasswordSalt'];
			$stored_hash = $row['HashedPass'];
			$check_pass = $stored_salt . $password;
			$check_hash = hash('sha512',$check_pass);
			
			if($check_hash == $stored_hash)
			{
				$sqlquery = "Select * from login where UserName = '$username';";
				$result = mysqli_query($connection,$sqlquery);
				$row = mysqli_fetch_array($result);
				$_SESSION['Username']=$row['UserName'];
				$_SESSION['Usertype']=$row['UserType'];
				$count = mysqli_num_rows($result);
			
				if($count==1)
					{
							if ($row['UserType']=="admin")
							{ 
								$_SESSION['username'] = $username;
								$_SESSION['success'] = "You are now logged in";
								header ("location: admin_page.php"); 				 
							}
							else if ($row['UserType']=="user")
							{ 
								$_SESSION['username'] = $username;
								$_SESSION['success'] = "You are now logged in";
								$_SESSION['Usertype']=$row['UserType'];
								header ("location: user_page.php"); 				 
							}
					}
					else 
					{
						array_push($errors, "Permission Issue");
					}
			
			}
			else
			{
				array_push($errors, "The Username or Password you entered was incorrect.");
			}
		}		
	}

?>

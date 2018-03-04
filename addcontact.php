
<?php 

	session_start();
	include("dbconnect.php");

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
	

?>
<!DOCTYPE html>
<html>

<head>
	<title>Employee Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="adminheader">
		<h2>Customer Management System</h2>
	</div>
	
	<div class="admincontent">

		<?php 
			if (isset($_SESSION['success'])) { 
		?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php 
			} 
		?>

		<?php  
			if (isset($_SESSION['username'])) { 
		?>
			<p>Welcome <strong>
			
			<?php 
			$username = $_SESSION['username'];
			$getname = "Select * from users where UserName = '$username'";
			$result = mysqli_query($connection,$getname);		
			$row = mysqli_fetch_array($result);
			$firstname = $row['FirstName'];
			$lastname = $row['LastName'];
			
			echo $firstname;
			echo '&nbsp;';
			echo $lastname;
			
			?></strong></p>
			
			<p align="right" > <a href="login.php?logout='1'" style="color: red; ">logout</a> </p>

		</div>
		
		<div class="viewcontent">
		
		<fieldset>
		<?php echo "<br>"; ?>
		
		<center><h2>Customer Records</h2></center><br>
		
		<?php
		
		if (isset($_GET['id'])) {
		$id = $_GET['id'];
		
		$getcontent = "Select companyID, companyName from company where companyID like '$id'";
				
			$results = mysqli_query($connection,$getcontent);
			$row = mysqli_fetch_array($results);
			
			$companyID = $row['companyID'];
			$companyname = $row['companyName'];
			
			$_SESSION['companyID'] = $companyID;
			$_SESSION['companyName'] = $companyname;
			
		
		?>
		
			<div class="header">
			<h2>Company: <?php echo $row['companyName']; ?> </h2>
			</div>

		<form method="post" action="user_page.php">

		<div class="input-group">
			<label>Enter Contact Name</label>
			<input type="text" name="name" >
		</div>
		<div class="input-group">
			<label>Enter Contact Number</label>
			<input type="text" name="phone">
		</div>
		<div class="input-group">
			<label>Enter Email</label>
			<input type="text" name="email">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="savecontact">ADD</button>
		</div>
		
		</form>	
		
		<?php
		} else{
			header("location: user_page.php");
		}
		?>
	
		<?php echo "<br><br>"; ?>	
		
		</fieldset>
		
		<center><br><br><p><a href="user_page.php" class="btn" >Company List</a></p><center>


		<?php 
			
			} 
		?>
		</div>
	
		
</body>

</html>

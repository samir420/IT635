
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
		
		$getcontent = "Select name, phone, email from contact where companyID like '$id'";
			
		$results = mysqli_query($connection,$getcontent);
		
		?>

		<table>
			<thead>
				<tr>
					<th>Contact Name</th>
					<th>Contact Number</th>
					<th>Email</th>
				</tr>
			</thead>
			
			<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['email']; ?></td>
				</tr>
			<?php } ?>
		</table>
		
		<center><p><a href="addcontact.php?id=<?php echo $id; ?>" class="btn">Add Contact</a></p></center>
		<p><a href="details.php?id=<?php echo $id; ?>" class="btn">Go Back</a></p>
		
		<?php
		} else{
			header("location: details.php?id= ". $row['companyID']. "");
		}
		?>
			
		<?php echo "<br><br>"; ?>	
		
		</fieldset>


		<?php 
			
			} 
		?>
		</div>
	
		
</body>

</html>

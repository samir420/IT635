
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
	
	if (isset($_POST['savecontact'])) {
		$companyID = $_SESSION['companyID'];
		$companyname = $_SESSION['companyName'];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		
		$insertcontact = "INSERT INTO contact (companyID, name, phone, email) VALUES ('$companyID','$name','$phone','$email')";
		$results = mysqli_query($connection,$insertcontact);
		$_SESSION['message'] = "Contact Has been Added.";
		
		unset($_SESSION['companyID']);
		unset($_SESSION['companyName']);
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
                        $getname = "CALL getusers('$username')";
                        $result = mysqli_query($connection,$getname);
                        $row = mysqli_fetch_array($result);
                        $firstname = $row['FirstName'];
                        $lastname = $row['LastName'];
                        mysqli_free_result($result);
                        mysqli_next_result($connection);

					
			echo $firstname;
			echo '&nbsp;';
			echo $lastname;
			
			?></strong></p>
			
			<p align="right" > <a href="login.php?logout='1'" style="color: red; ">logout</a> </p>

		</div>
		
		<div class="viewcontent">
		
		<?php 
			if (isset($_SESSION['message'])) { 
		?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['message']; 
						unset($_SESSION['message']);
					?>
				</h3>
			</div>
		<?php 
			} 
		?>
		
		<fieldset>
		<?php echo "<br>"; ?>
		
		<center><h2>Customer Records</h2></center><br>
			
		<form action='search.php' method='POST' name='searchbar'>    
			<center><h3>Search</h3></center>
			
			<div class="input-group">
			<select name="selectcategory">
				<option value="category">Select Category</option>
				<option value="businesstype">Business Type</option>
				<option value="service">Service</option>
				<option value="contact">Contact</option>
				<option value="all">All</option>
			</select>
			</div>
			
			<div class="input-group">
			<input type='text' name='searchvalue' placeholder='Enter text.' size='50'>
			</div>
			
			<div class="input-group">
				<button class="btn" type="submit" name="search" >Search</button>
			</div> 
			
		</form>

		<?php 
		
			$getcontent = "Select company.companyID, company.companyName, company.companyType, companydetails.businessType, service.serviceType,
			companyaddress.city, companyaddress.state, companyaddress.zip, companyaddress.country, companydetails.url From company
			JOIN companydetails on company.companyID = companydetails.companyID
			JOIN companyaddress on company.companyID = companyaddress.companyID
			JOIN service on company.companyID = service.companyID ";
			
			$results = mysqli_query($connection,$getcontent);
		
		?>

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Company Name</th>
					<th>Company Type</th>
					<th>Business Type</th>
					<th>Service Type</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					<th>Country</th>
					<th>URL</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
			
			<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td><?php echo $row['companyID']; ?></td>
					<td><?php echo $row['companyName']; ?></td>
					<td><?php echo $row['companyType']; ?></td>
					<td><?php echo $row['businessType']; ?></td>
					<td><?php echo $row['serviceType']; ?></td>
					<td><?php echo $row['city']; ?></td>
					<td><?php echo $row['state']; ?></td>
					<td><?php echo $row['zip']; ?></td>
					<td><?php echo $row['country']; ?></td>
					<td><?php echo $row['url']; ?></td>
					<td>
						<a href="details.php?id=<?php echo $row['companyID']; ?>" class="btn">Details</a>
					</td>
				</tr>
			<?php } ?>
		</table>
			
		<?php echo "<br><br>"; ?>	
		
		</fieldset>


		<?php 
			
			} 
		?>
		</div>
	
		
</body>

</html>

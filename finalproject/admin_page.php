
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
	
	if (isset($_POST['save'])) {
		$companyname = $_POST['companyname'];
		$companytype = $_POST['companytype'];
		$businesstype = $_POST['businesstype'];
		$servicetype = $_POST['servicetype'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$country = $_POST['country'];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$url = $_POST['url'];
		$description = $_POST['description'];	
		
		$insertcompany = "INSERT INTO company (companyName, companyType) VALUES ('$companyname','$companytype')";
		$results = mysqli_query($connection,$insertcompany);
		$customer_id = mysqli_insert_id( $connection );
		
		$insertcompanyaddress = "INSERT INTO companyaddress (companyID, city, state, country, zip)
		VALUES ('$customer_id', '$city', '$state','$country','$zip')";
		$results = mysqli_query($connection,$insertcompanyaddress);
		
		$insertcontact = "INSERT INTO contact (companyID, name, phone, email)
		VALUES ('$customer_id', '$name', '$phone','$email')";
		$results = mysqli_query($connection,$insertcontact);
		
		$insertservice = "INSERT INTO service (companyID, serviceType)
		VALUES ('$customer_id', '$servicetype')";
		$results = mysqli_query($connection,$insertservice);
		
		$insertcompanydetails = "INSERT INTO companydetails (companyID, businessType, description, url)
		VALUES ('$customer_id', '$businesstype', '$description','$url')";
		$results = mysqli_query($connection,$insertcompanydetails);
		
 
		$_SESSION['message'] = "Customer Record Has Been Added."; 
	}
	
	if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($connection, "DELETE FROM companyaddress WHERE companyID=$id");
	mysqli_query($connection, "DELETE FROM contact WHERE companyID=$id");
	mysqli_query($connection, "DELETE FROM service WHERE companyID=$id");
	mysqli_query($connection, "DELETE FROM companydetails WHERE companyID=$id");
	mysqli_query($connection, "DELETE FROM company WHERE companyID=$id");
	/*mysqli_query($connection, "DELETE FROM note WHERE companyID=$id");*/

	$mdb = new MongoDB\Driver\Manager("mongodb://root:123456@ds257589.mlab.com:57589/it635sql");
        $deleterecord = new MongoDB\Driver\BulkWrite;
        $deleterecord->delete(['companyID' => (int) $id]);
        $mdb->executeBulkWrite('it635sql.client', $deleterecord);


	$_SESSION['message'] = "Customer Record Has Been Deleted!"; 
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Manager Home</title>
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
		<?php echo "<br><br>"; ?>
		
		<center><strong>Customer Records</strong></center>
		
		<?php
		
			$getcontent = "Select company.companyID, company.companyName, company.companyType, companydetails.businessType, service.serviceType,
			companyaddress.city, companyaddress.state, companyaddress.zip, companyaddress.country, contact.name, contact.phone, 
			contact.email, companydetails.url From company
			JOIN companydetails on company.companyID = companydetails.companyID
			JOIN contact on company.companyID = contact.companyID
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
					<th>Contact Name</th>
					<th>Contact Number</th>
					<th>Email</th>
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
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['phone']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['url']; ?></td>
					<td>
						<a href="admin_page.php?del=<?php echo $row['companyID']; ?>" class="deletebutton">Delete</a>
					</td>
				</tr>
			<?php } ?>
		</table>
		
		<center><p><a href="newcustomer.php" class="addbutton" >Add a new customer</a></p><center>
			
		<?php echo "<br><br>"; ?>	
		
		</fieldset>

		<?php 
			} 
		?>
		</div>
	
		
</body>

</html>

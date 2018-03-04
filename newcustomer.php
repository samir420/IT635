
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
	<title>Manager Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="adminheader">
		<h2>Customer Management System</h2>
	</div>
	
	<div class="admincontent">

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
		
		<?php echo "<br><br>"; ?>
		
		<h2><center><strong>New Customer Form</strong></center></h2>

		<?php echo "<br><br>"; ?>
		
		<form method="post" action="admin_page.php" name="ContactForm" onsubmit="return (ValidateContactForm());" >
			<div class="input-group">
				<label>Company Name</label>
				<input type="text" name="companyname" value="" >
			</div>
			<div class="input-group">
				<label>Company Type</label>
				<input type="text" name="companytype" value="" >
			</div>
			<div class="input-group">
				<label>Business Type</label>
				<input type="text" name="businesstype" value="">
			</div>
			<div class="input-group">
				<label>Service Type</label>
				<input type="text" name="servicetype" value="">
			</div>
			<div class="input-group">
				<label>City</label>
				<input type="text" name="city" value="">
			</div>
			<div class="input-group">
				<label>State</label>
				<input type="text" name="state" value="">
			</div>
			<div class="input-group">
				<label>Zip</label>
				<input type="number" name="zip" value="">
			</div>
			<div class="input-group">
				<label>Country</label>
				<input type="text" name="country" value="">
			</div>
			<div class="input-group">
				<label>Contact Name</label>
				<input type="text" name="name" value="">
			</div>
			<div class="input-group">
				<label>Contact Number</label>
				<input type="text" name="phone" value="">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="text" name="email" value="">
			</div>
			<div class="input-group">
				<label>URL</label>
				<input type="text" name="url" value="">
			</div>
			<div class="input-group">
				<label>Company Description</label>
				<textarea name="description" rows="5" cols="59" value=""></textarea>
			</div>
			
			<div class="input-group">
				<button class="btn" type="submit" name="save" >Save</button>
			</div>
		</form>
		
		<center><br><br><p><a href="admin_page.php" class="btn" >Go Back</a></p><center>
		
		<script type="text/javascript">
		
		function ValidateContactForm()
		{
			var companyname = document.ContactForm.companyname;
			var companytype = document.ContactForm.companytype;
			var businesstype = document.ContactForm.businesstype;
			var servicetype = document.ContactForm.servicetype;
			var city = document.ContactForm.city;
			var state = document.ContactForm.state;
			var zip = document.ContactForm.zip;
			var country = document.ContactForm.country;
			var name = document.ContactForm.name;
			var phone = document.ContactForm.phone;
			var email = document.ContactForm.email;
			var url = document.ContactForm.url;
			var description = document.ContactForm.description;
			
			
			if (companyname.value == "")
			{
				window.alert("Please enter Company Name.");
				companyname.focus();
				return false;
			}
			
			if (companytype.value == "")
			{
				window.alert("Please enter a Company Type");
				companytype.focus();
				return false;
			}
			if (businesstype.value == "")
			{
				window.alert("Please enter Business Type.");
				businesstype.focus();
				return false;
			}
			
			if (servicetype.value == "")
			{
				window.alert("Please enter Service Type.");
				servicetype.focus();
				return false;
			}
			if (city.value == "")
			{
				window.alert("Please enter a City.");
				city.focus();
				return false;
			}
			
			if (state.value == "")
			{
				window.alert("Please enter a State.");
				state.focus();
				return false;
			}
			if (zip.value == "")
			{
				window.alert("Please enter Zip.");
				zip.focus();
				return false;
			}
			
			if (country.value == "")
			{
				window.alert("Please enter Country.");
				country.focus();
				return false;
			}
			if (name.value == "")
			{
				window.alert("Please enter Contact Name.");
				name.focus();
				return false;
			}
			
			if (phone.value == "")
			{
				window.alert("Please enter Contact Phone.");
				phone.focus();
				return false;
			}
			if (email.value == "")
			{
				window.alert("Please enter Email.");
				email.focus();
				return false;
			}
			
			if (url.value == "")
			{
				window.alert("Please enter URL.");
				url.focus();
				return false;
			}
			if (description.value == "")
			{
				window.alert("Please enter Company Description.");
				description.focus();
				return false;
			}
			
		}
		
		</script>		

		<?php 
			} 
		?>
		</div>
	
		
</body>

</html>

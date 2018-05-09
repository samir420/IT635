
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
	
	if (isset($_POST['addnote'])) {
		$companyID = $_SESSION['companyID'];
		echo $companyID;
		$note = $_POST['note'];
		
		/*$insertnote = "INSERT INTO note (companyID, note) VALUES ('$companyID','$note')";
		$results = mysqli_query($connection,$insertnote) or die(mysqli_error($connection));*/

		 $mdb = new MongoDB\Driver\Manager("mongodb://root:123456@ds257589.mlab.com:57589/it635sql");
	         $insertrecord = new MongoDB\Driver\BulkWrite;
       		 $insertrecord->insert(['companyID' => (INT) $companyID, 'note' =>$note]);
        	 $mdb->executeBulkWrite('it635sql.client', $insertrecord);

		$_SESSION['message'] = "Note Has been Added.";
		
		unset($_SESSION['companyID']);
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
		
		<?php
		
		if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$getcontent = "Select company.companyID, company.companyName, company.companyType, companydetails.businessType, service.serviceType,
		companyaddress.city, companyaddress.state, companyaddress.zip, companyaddress.country, companydetails.url, companydetails.description From company
		JOIN companydetails on company.companyID = companydetails.companyID
		JOIN companyaddress on company.companyID = companyaddress.companyID
		JOIN service on company.companyID = service.companyID
		where company.companyID like '$id'";
				
		$results = mysqli_query($connection,$getcontent); 
		
			while ($row = mysqli_fetch_array($results)) {
				$companyID = $row['companyID'];
		?>	
		
			
				<fieldset>
				<div class="viewheader">
				<h2>Company: <?php echo $row['companyName']; ?></h2>
				</div>
				
				<div class="viewheader">
				<h2>Description: <?php echo $row['description']; ?></h2>
				
				
				<div class="viewheader">
				<h2>Company Type: <?php echo $row['companyType']; ?></h2>
				</div>
				
				<div class="viewheader">
				<h2>Business Type: <?php echo $row['businessType']; ?></h2>
				</div>
				
				<div class="viewheader">
				<h2>Service Type: <?php echo $row['serviceType']; ?></h2>
				</div>
				
				<div class="viewheader">
				<h2>Address: <?php echo " ".$row['city']. "," . $row['state'] . " " .$row['zip']. " " . $row['country']. "";?></h2>
				</div>
				
				<div class="viewheader">
				<h2>URL: <?php echo $row['url']; ?></h2>
				</div>
				</fieldset>
				<fieldset>
				
				<?php		
				}
				
				/*$getcontent = "Select company.companyID, note.note from company 
				JOIN note on company.companyID = note.companyID
				where company.companyID like '$id'";
						
				$results = mysqli_query($connection,$getcontent); 
				*/

				?>
				
				<div class="viewheader">
				    <h2>Notes: </h2>
					
				<?php	
				/*while ($rows = mysqli_fetch_array($results))
				{
				 echo "". $rows['note']. "<br>";	
				}*/
				
				$mdb = new MongoDB\Driver\Manager("mongodb://root:123456@ds257589.mlab.com:57589/it635sql");
        $filter = array('companyID'=> (INT) $id);
        $query = new MongoDB\Driver\Query($filter);
        $results = $mdb->executeQuery("it635sql.client",$query);

        foreach ($results as $result){
        echo "$result->note";
	echo "<br>";
        }

				?>
				</div>
				</fieldset>

				<br><center><p><a href="addnote.php?id=<?php echo $companyID; ?>" class="btn">Add Note</a></p></center><br><br>
				<center><p><a href="viewcontacts.php?id=<?php echo $companyID; ?>" class="btn">View Contacts List</a></p></center>
				<br><br><p><a href="user_page.php" class="btn" >Company List</a></p>
			
			
		<?php		
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

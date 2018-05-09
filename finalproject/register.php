
<?php

require_once('./dbconnect.php');

function generateSalt($max = 50) {
	$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
	$i = 0;
	$salt = "";
	while ($i < $max) {
	    $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
	    $i++;
	}
	return $salt;
}

if(isset($_POST['username']) AND isset($_POST['password']))
	{

		$username = $_POST['username']; 
		$password = $_POST['password'];

	}
	
	
$user_salt = generateSalt(); // Generates a salt from the function above
$combo = $user_salt . $password; // Appending user password to the salt 
$hashed_pwd = hash('sha512',$combo); // Using SHA512 to hash the salt+password combo string

$insert="INSERT INTO login(UserName, UserType, PasswordSalt, HashedPass) VALUES ('$username','admin','$user_salt','$hashed_pwd')";
$result = $connection->query($insert);

?>

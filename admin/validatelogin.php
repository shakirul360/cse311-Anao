<?php 
session_start();
include 'connectdb.php';

if (isset($_POST['adminName']) && isset($_POST['password'])) {
	
	$adminname = $_POST['adminName'];
	$password = $_POST['password'];

	if (empty($adminname)) {
		header("Location: admin_login.php?error=Name is required");
	}else if (empty($password)){
		header("Location: admin_login.php?error=Password is required&name=$adminname");
	}else {
		$sql = "SELECT * FROM `admin` WHERE `name`='$adminname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$admin = mysqli_fetch_assoc($result);

			$admin_id = $admin['id'];
			$admin_name = $admin['name'];
			$admin_password = $admin['password'];

			if ($adminname === $admin_name) {
				if (password_verify($password, $admin_password)) {
					$_SESSION['admin_id'] = $admin_id;
					$_SESSION['admin_name'] = $admin_name;
					
					header("Location: admindashboard.php");

				}else {
					header("Location: admin_login.php?error=Incorect User name or password&name=$adminname");
				}
			}else {
				header("Location: admin_login.php?error=Incorect User name or password&email=$adminname");
			}
		}else {
			header("Location: admin_login.php?error=Incorect User name or password&email=$adminname");
		}
	}
}

?>

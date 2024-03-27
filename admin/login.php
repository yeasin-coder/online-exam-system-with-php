<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/loginheader.php');
	include_once ($filepath.'/../classes/Admin.php');

	//create a new object of Admin class
	$ad  = new Admin();

	
?>

<div class="main">
<h1>Admin Login</h1>

<?php 
 if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])){
	$admin_login = $ad->admin_login($_POST);

	if(isset($admin_login)){
		echo $admin_login;
	}
}
?>
<div class="adminlogin">
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" required/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password" required/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login"/></td>
			</tr>
		</table>
	</from>
</div>
</div>
<?php include 'inc/footer.php'; ?>
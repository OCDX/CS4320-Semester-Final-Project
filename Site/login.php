<?php 
#Start Session
session_start();
#Database Connection:
include('config/connection.php');
include('config/setup.php');
if($_POST) {
	$query="SELECT * FROM user_info WHERE AccountEmail='$_POST[email]' AND Hashword = SHA1('$_POST[password]')";
	//$query="SELECT * FROM users WHERE email='$_POST[email]' AND password = SHA1('$_POST[password]')";
	$result=mysqli_query($dbc, $query);
	if(mysqli_num_rows($result) == 1) {
		$data=mysqli_fetch_assoc($result);
		if($data['isActive'] == 1) {
			$_SESSION['username'] = $_POST['email'];
			if($data['Category'] == 'admin' ) {
				$_SESSION['category'] = 'admin';
				header('Location:admin/user.php');
			} else {
				$_SESSION['category'] = 'other';
				header('Location: index.php');
			}
		}		
	}
}
?>
							

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<?php include('config/css.php'); ?>
		<?php include('config/js.php'); ?>		
  <!-- CSS  -->
</head>
<body class='indigo lighten-5'>
	<?php include(D_TEMPLATE.'/navigation.php'); ?>

	<div class="section" id="index-banner">
		<div class="white z-depth-1 container" style='padding: 1% 1% 1% 1%;'>
		  <br><br>
			<div class="row">
			  	<div class="col s4">
			  		<h3>User Login</h3>
			  		<!--
			  		<?php
					  	if($_POST) {
							echo '<p>'.$_POST['email'].'</p>';
							echo '<br>';
							echo '<p>'.$_POST['password'].'</p>';
						}else {
							echo '<p>No Post</p>';
						}
					?>
					-->
	
			  	</div>
			  		
				<form action="login.php" method="post" role="form">
					<div class="input-field col s12 form-group">						
						<label for="email" >Email</label>
						<input id="email" type="text" class="validate" name="email">
			    	</div>
			    	<div class="input-field col s12">		        	
						<label for="password" type="password" name="password">Password</label>
						<input id="password" type="password" class="validate" name="password">
					</div>
					<div class="col s8">
						<button type="submit" value="submit" class="waves-effect waves-light btn">Login</button>
                        <a href='createUser.php' class="waves-effect waves-light btn">Create  Account</a>
					</div>
				</form>
			</div>					
		  	<div class="row center">
		  	</div>
		  <br><br>
		</div><!--END of white z-depth-1 container-->		
	</div><!--END of section-->	
	<?php include(D_TEMPLATE.'/footer.php'); ?>
  </body>
</html>

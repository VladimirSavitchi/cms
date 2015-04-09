<?php session_start();
include_once '../../includes/connect.php';
include_once '../control/manageusers.php';
include_once '../control/manageproject.php';
$users = new Users; //instantiate users class to get methods for later use 

include "../control/manageImage.php"; // Load Image Manager
$manageImage = new manageImage; // Instantiate

$project = new Project;				// instantiate project class to get methods for later use 
$projects = $project->fetchAll(); // use "fetchAll" method and assign the result to "$projects" variable

?>
<!doctype html>
<html>
<head>
	<title>Artist Portfolio</title>
	<!-- Bootstrap -->
	<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Artist Portfolio</a>
		</div>
		<?php if (isset($_SESSION['logged_in'])) {include 'page/nav.php';} ?>
	</div>
</nav>
	
<main class="container">
	<?php 
		if (isset($_SESSION['logged_in'])) {
			//display index
			if (isset($_GET['p'])){
				$p = $_GET['p'];
				if (file_exists( 'page/'.$p.'.php')) {
					switch ($p) {
						case $p:
							include 'page/'.$p.'.php';
							break;
						default:
							include 'page/main.php';
						} // end of switch
				} 
				else {
						include 'page/main.php';
				}

			}else {include 'page/main.php';}
		}
		else { //display login
			if (isset($_POST['username'], $_POST['password'])) {
				$username = trim($_POST['username']);
				$password = md5(trim($_POST['password']));
				$userId = $users->getUsername($username); // check if user exists
				
				if (empty($username) || empty($password)) {
					$error = "All fields are required!";
				} elseif ($userId === 0){
					$error = "Username not found!";
				} else {
					$userLoggedin = $users->loginUser($username,$password); // if user entered correct credentials return his details
					
					if ($userLoggedin) { // If user entered correct credentials this is true 
						$success = "You are now logged in!";
						$_SESSION['id'] = $userLoggedin['user_id'];
						$_SESSION['username'] = $userLoggedin['user_name'];
						$_SESSION['logged_in'] = true;
						header ('Location: index.php');
						exit();
					}
					else {
						$error = "Wrong password.";
					}
				}
			}
			
?>
<br/><br/>
<form method="post" action="<?php  echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Username" required/><br/><br/>
				<input type="password" name="password" class="form-control" id="passwordField" placeholder="Password" required/>
				<br/><br/>
			<input type="submit" name="submit" class="btn btn-success" value="Login"/><br/>
		</div>
	</form>
</main>
<footer></footer>
</div> <!-- END of <div class="container"> -->
</body>
</html>
<?php
} // End of if else statement isset $_POST['username']

	 if (isset($error)) { 
			echo "<p class=\"bg-danger\">".$error."</p>"; 
	 }
?>

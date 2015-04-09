<?php
include_once '../includes/connect.php';
include_once 'control/manageproject.php';
$project = new Project;
$projects = $project->fetchAll();
$i = 1; 
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Mario Portfolio</title>

 <!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
  

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->
<link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css'>
<link rel="stylesheet" href="assets/css/styleCarousel_prv.css">
<link rel="stylesheet" href="assets/css/carouselstyle.css">

</head>

<body>

  <div class="container-fluid">
<div class="row-fluid">
<div class="span12">

    <div class="page-header">
        <h3>Mario Portfolio</h3>
        <p>Responsive Carousel Demo</p>
    </div>
	
	<?php 
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
		?>



</div><!-- /.span12 -->          
</div><!-- /.row --> 
</div><!-- /.container -->

<!-- Delete This -->                        
<div class="footer">

<a href="#" class="link"><i class="icon-user icon-large icon-white"> </i> About </a> &nbsp <a href="#" class="link"><i class="icon-comment icon-large icon-white"> </i> Contact Me </a>
    <p class="right">&lsaquo; Resize Window &rsaquo;</p>
    <p>&nbsp;</p>
    <p class="text-center">Copyright <?php echo date("Y"); ?> www.marios.tk</p>    

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js'></script>
<script src="assets/js/index.js"></script>

</body>

</html>
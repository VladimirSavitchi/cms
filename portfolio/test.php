<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>




<div  class="container">
   <ul class="row">
	<?php if (isset($images)) { foreach($images as $image) : ?>
		<div class="col-lg-3 col-md-4 col-xs-6 thumb">
			<a class="thumbnail" href="<?php echo $target_dir.$image; ?>">
				<img class="img-responsive" src="<?php echo $target_dir.$image; ?>"/>
			</a>
		</div>
	 <?php endforeach; ?>
	 <?php } else { echo "<h3 class = 'msg'>Unavailable...</h3>";} ?>
  </ul>
</div>
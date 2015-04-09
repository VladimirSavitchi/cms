<?php
// read images
$target_dir ="../admin/uploads/".$project_id."/gallery/";
if ($dir = opendir($target_dir) ){
	$images = array();
	while (false !== ($file = readdir($dir))) {
		if ($file != "." && $file != "..") {
			$images[] = $file; 
		}
	}
	closedir($dir);
}



//delete image
if (isset($_GET["t"],$_GET["i"])) {
	unlink($_GET["t"].$_GET["i"]);
	header ("Location: index.php?p=createGalerry&id=$project_id");
}

$count=0;
?>

<!-- dispalay iamges -->
<table class="gallery">
	<tr>
		<?php foreach($images as $image) { 
		if ($count == 5) { echo "<tr>"; $count = 0;}
		?>

		<td>
		<?php 
			echo "$image <br>";
			echo '<img width=100px src="';
			echo $target_dir.$image;
			echo '" alt="" /><br>';
			 echo "<a href=\"index.php?p=createGalerry&id=$project_id&t=$target_dir&i=$image\"> Delete </a><br>";
		?>
		</td>

			<?php $count++; } ?>
	</tr>

</table>
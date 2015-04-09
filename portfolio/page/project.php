<?php
if (isset($_GET['id'])){
	$project = new Project;
	$project_id = $_GET['id'];
	$data = $project->fetch_data($project_id);

} else {
	header('Location ../index.php');
	exit();
}

?>

<section>
	<header>
		<?php echo $data['project_title'] ?>
		<a href="admin/<?php echo $data['url'] ?>" > 
		<img src="admin/<?php echo $data['url'] ?>"  width="100px"/>
		</a>
		
	<header>
	<article>
		<div class="description">
			<?php echo nl2br($data['project_content']); ?>
		</div>
		<div class="gallery">
				<?php 
			
					if(file_exists("admin/uploads/".$project_id."/gallery")){
					include ("gallery.php");
					} else { echo "doesnt exist";}
				?>
		</div>
	</article>
</section>
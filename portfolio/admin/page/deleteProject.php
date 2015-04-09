<?php
if (isset($_GET['id'])){
	$id = $_GET['id'];
	
	$data = $project->fetch_data($id);
	$deleteProject = $project->deleteProject($id); //Deletes data from projects and images file path

	if($deleteProject === 1) {
		$deleteFolder = $manageImage->deleteFolder($data['project_id']);
		
	// Display the result
	
	$counter = 1; 
?>
<table class="projects_table">
	<tr>
		<th class="projects_th"></th>
			<th class="projects_th">
				File Name / Milliseconds
			</th>
			<th class="projects_th">
				Deleted
		</th>
	</tr>
<?php foreach($deleteFolder as $key => $value)  { ?>
	<tr>
		<td class="projects_td">
			<?php echo $counter ?>
		</td>
		<td class="projects_td">
			<?php echo $key ?>
		</td>
		<td class="projects_td">
			<?php settype($value, 'bool'); echo $value; ?>
		</td>
	</tr>
<?php  $counter++;}?>
</table>
<?php
	} else {
		$error = $deleteProject;
	}
}
?>

<a href="index.php">&#x25c0 Back </a>
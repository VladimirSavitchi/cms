<!-- List all projects -->
<?php $counter = 1; ?>
<table class="projects_table table">
	<tr>
	<th class="projects_th">#</th>
		<th class="projects_th">
		Project
		</th>
		<th class="projects_th">
		Actions
		</th>
	</tr>
<?php foreach($projects as $p)  { ?>	
	<tr>
		<td class="projects_td">
		<?php echo $counter ?>
		</td>
		<td class="projects_td">
			<a class="link" href="index.php?p=project&id=<?php echo $p['project_id']; ?>">
			<?php echo $p['project_title']; ?>
			</a>
		</td>
		<td class="projects_td">
			<small> <a class="link" href="index.php?p=editProject&id=<?php echo $p['project_id']; ?>">
			Edit
			</a>  </small> - <small>
			<a class="link" href="index.php?p=createGalerry&id=<?php echo $p['project_id']; ?>">
			Gallery
			</a>  </small> - <small class="delete">
			<a class="link" href="index.php?p=deleteProject&id=<?php echo $p['project_id']; ?>">
			Delete
			</a>  </small> 
		</td>
	</tr>
<?php  $counter++;}?>
</table>

<?php
if (isset($_GET['id'])){
	$id = $_GET['id'];
	$data = $project->fetch_data($id);
	var_dump($data);
} else {
	header('Location ../index.php');
	exit();
}
?>
<fieldset><legend><?php echo $data['project_title'] ?></legend>

<article>
<?php echo $data['project_content']; ?>
</article>
<h4>Images</h4>
<img src="<?php echo $data['url'] ?>"  width="100px"/><br>
<a href="index.php">&larr; Back</a>
</fieldset>

<!--
<form method="post" action="">
<fieldset><legend></legend>
<label>Title</label><input type="text" name="title" />
<label>Description</label><input type="text" name="description" />
<input type="submit" name="submit" /><input type="submit" name="logout" value="logout"/>
</fieldset>
</form>
-->
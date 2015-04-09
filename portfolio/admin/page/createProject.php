<?php

// Create project //
if (isset($_POST['submit'])){
	$title = htmlentities($_POST['title']);
	$description = htmlentities($_POST['description']);
	
// Validate Form //



$projectID = $project->getprojectId($title);  // Get project id if available to use for the form validation
include "../model/formValidation.php";
$formValidation = new formValidation;
$files = $_FILES;
$errors = $formValidation->formValidate($title,$projectID,$files);
	

if (!empty($errors)) {
	echo "<ul>";
	foreach ($errors as $error) {
		echo "<li class=\"bg-danger\">";
		echo $error;
		echo "</li>";
	}
	echo "</ul>";
}
	
// End of Validate Form //
if (empty($errors)) {
	$result = $project->createProject($title,$description); //-------------Create the project
	
	if (isset($result['RowCount'] ) && $result['RowCount'] === 1) { // Check if when creating the project there were any rows effected,
		
		echo "<li class=\"bg-success\">".$result['Message']."</li>"; //---------------------------------------------- if yes display the success message
		
		$projectID = $project->getprojectId($title); //----------------------Get project id to name to pass it when naming the folder for photos

		// Procceed to creating folder for images
			include "../model/imageValidate.php"; //------------------------ Then include this file to process image (uploads image and creates folder)
			include "../model/imageUpload.php";
		
	} else { 														
		 exit($result);	//--------------------------------------------------------- If no rows where efected, that means there where an error, so display it and exit the script
	}
}
	
}

?>

<form method="post" action=""  enctype="multipart/form-data">
  <div class="form-group">
    <label for="Title">Title</label>
    <input class="form-control" type="text" name="title" autofocus autocomplete="off"/>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" rows="4" cols="42" name="description"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Upload Image</label>
    <input class="form-control" type="file" name="file"  />
    <p class="help-block">Only JPG, JPEG, PNG & GIF are allowed. Maximum image-size: 500kb.<br> Recomended dimensions: 960 x 405 px</p>
  </div>
  <input type="submit" name="submit" class="btn btn-default" style="position:relative;right:-400px;" />
</form>
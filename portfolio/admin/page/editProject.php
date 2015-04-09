<?php
// Set Variables
$projectID = $_GET['id'];
$data = $project->fetch_data($projectID);
$projectID = $project->getprojectId($data['project_title']); // Re_set projectid in array format to avoid conflict, because both this file and createProject.php are using processImage.php
$image_url = $data['url'];
$image_id = $manageImage->image_id($image_url);
$arr= explode('/',$data['url']);
$img_name = end($arr);

// If submit, start updating procedure //
if (isset($_POST['submit'])){
	$title = htmlentities($_POST['title']); //------------------------------------ Set Title variable from the form
	$description = htmlentities($_POST['description']); //------------------------ Set the content/description from the form
		
	// Validate Form //
	include "../model/editformValidation.php"; //----------------------- Include edit form validating class
	$formValidation = new formValidation; //---------------------------- Instantiate validating class 

	$titleValidate = $formValidation->titleValidate($title,$projectID);// Call titleValidate method to validate the title
																	   // was given in the form
	if (!empty($titleValidate)) { // --------------------------------- // If validation fails,
		foreach ($titleValidate as $error) {						   // Start displaying errors on the screen,
			echo "<p>$error</p>";									   // then exit the script
			exit();
		}
	}
	


	// End of Validate Form //
	// Proceed with the update //
	if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){ //--------------------------******// Proceed updating if photo has been selected
		include "../model/imageValidate.php"; //------------------------// Validates image

		if (empty($uploadok)) {
			echo "Sorry, your image did not passed the validation.<br>";
			
		} else {
		//$deleteFolder = $manageImage->deleteFolder($data['project_id']);   // Delete old photo and it's folder ***
		
		$delete_old_img = $manageImage->delete_old_img($projectID['project_id'],$img_name); // Delete old image
		
		if ($delete_old_img == true){ //-------------------------------------// Proceed if deletion was successful 
			include "../model/imageUpload.php"; //------------------------// upload  image
		} elseif (count(glob("uploads/*")) === 0 ) { // check if the folder is empty
			include "../model/imageUpload.php"; //------------------------// upload  image
		}else {
			echo "Couldn't delete folder, probably it didn't existed.<br>"; //---------------------// Display info if could delete folder
		}
		$updateProject = $project->updateProject($projectID['project_id'],$title,$description); //------------------- Attempt to update Title and Description
		$image_file_path_update = $manageImage->updateImagePath($image_id,$target_file);// Attempt to update Image file path
		}
	} else { //----------------------------------------------------********// Proceed updating if photo has NOT been selected
		$updateProject = $project->updateProject($projectID['project_id'],$title,$description); //------------------- Attempt to update Title and Description
	}
	// End with the update //

	// Check if the updates were successfully //
	if (isset($updateProject['rowCount'] ) && $updateProject['rowCount'] === 1) { // Proceed if the project update was successful
		echo "<p class='success'>".$updateProject['Message']."</p>"; //----------------------------------------// Display the success message
		$projectID = $projectID['project_id']; 
		header ("refresh:1; url=?p=editProject&id=$projectID"); //----------------// Refresh page in two seconds
		
	} elseif(isset($image_file_path_update['rowCount'] ) && $image_file_path_update['rowCount'] === 1) { 
		echo "<p class='success'>".$image_file_path_update['Message']."</p>";
		$projectID = $projectID['project_id']; 
		header ("refresh:1; url=?p=editProject&id=$projectID");
	} else {

		echo "No changes have been made.<br>$image_file_path_update";//-----------------------// and inform user that project didn't updated
	}
} // End of If(isset($_POST['submit']))
?>


<form method="post" action=""  enctype="multipart/form-data">
  <div class="form-group">
    <label for="Title">Title</label>
    <input class="form-control" type="text" name="title" value="<?php echo $data['project_title'];?>"/>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" rows="4" cols="42" name="description"><?php echo $data['project_content'];?></textarea>
  </div>
	<div class="form-group">
    <label for="exampleInputPassword1">Current Image</label>
    <img src="<?php echo $data['url'];?>" width="200px;"/>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Upload Image</label>
    <input class="form-control" type="file" name="file"  />
    <p class="help-block">Only JPG, JPEG, PNG & GIF are allowed. Maximum image-size: 500kb.<br> Recomended dimensions: 960 x 405 px</p>
  </div>
  <input type="submit" name="submit" class="btn btn-default" value="update" style="position:relative;right:-400px;" />
</form>
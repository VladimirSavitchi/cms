<?php
// Check if $uploadok is set to 0 by an error_get_last
if (empty($uploadok)) {
	echo "Sorry, your file was not uploaded.";
	$errorImage = 1;
} else {
	
	$createFolder = $manageImage->folderExist($target_dir); // create folder with project id
 
	$target_file = $manageImage->renameFile($target_dir,$imageFileType); //rename file (returns new $target_file)
	
	$uploadImage = $manageImage->uploadImage($filename,$filetmpname,$target_file); // Upload 
	
	$data = $project->fetch_data($projectID['project_id']);
	
	if ($data === false) {
		$create_image_file_path = $manageImage->create_image_file_path($projectID['project_id'],$target_file);
		if($create_image_file_path['rowCount'] === null) {
			exit($create_image_file_path);
		}
	}
}
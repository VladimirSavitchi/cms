<?php //included in createProject.php

$target_dir ="uploads/".$projectID['project_id']."/"; // $projectId it is set in createProject.php

// Assign Variables //
$filename = $_FILES['file']['name'];
$filetmpname = $_FILES['file']['tmp_name'];
$imageSize = $_FILES["file"]["size"] ;

$imageFileType = $manageImage->imageFileType($target_dir,$filename); // Get Image file type (string)
	
$isImage = $manageImage->isImage($filetmpname); // Check If is an image (array message and uploadok)

$checkSize = $manageImage->imageSize($imageSize); // Check file size (array message and uploadok)

$allowedFiles = $manageImage->allowedFiles($imageFileType); // Allow certain file formats  (array message and uploadok)



//*******************

//if (isset($_POST['submit'])) {
	If(isset($isImage['message'])) {
		$message[] = $isImage['message'];
	}
		$uploadok[] = $isImage['uploadok'];
	

	//if (isset($imageSize)){
	$message []= $checkSize['message'];
	$uploadok[] = $checkSize['uploadok'];
	//}

	//if(isset($allowedFiles)) {
	$message[] = $allowedFiles['message'];
	$uploadok[] = $allowedFiles['uploadok'];
	//}
	
	if (in_array('0',$uploadok)) {
		$uploadok2 = [0];
		$uploadok = array_replace($uploadok,$uploadok2);
	}
	
	$message = array_filter($message); // Filter out null values
	$uploadok = array_filter($uploadok); //Filter out null values

echo "<ul>";
foreach ($message as $m){
	echo "<li>";
	echo $m;
	echo "</li>";
}
echo "</ul>";







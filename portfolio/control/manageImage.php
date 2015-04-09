<?php 

class manageImage {
	//private $target_file;
	//private $imageFileType;
public $link;

function __construct(){
	$db_connect = new dbConnect;
	$this->link = $db_connect->connect();
	return $this->link;
}

	
	function imageFileType($target_dir,$filename){
		$target_file = $target_dir . basename($filename);
		return $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	}
	
	function isImage($filetmpname){
		if (!empty($filetmpname)){
			$check = getimagesize($filetmpname);
			if ($check !== false) {
				$msg = "File is an image - " . $check["mime"] . ".<br/>";
				return $result = [ "uploadok" => 1];
			} else {
				$msg =  "File is not an image.<br/>";
				 return $result = ["message" => $msg, "uploadok" => 0];
			}
		} else {$msg =  "Choose a file to upload.<br/>";return $result = ["message" => $msg, "uploadok" => 0];}
	}
	
	function imageSize($imageSize) {
		if ($imageSize > 500000) {
		$msg = "Your file is too large.<br/>";
		 return $result = ["message" => $msg, "uploadok" => 0];
		}
	}

	function allowedFiles($imageFileType) {
		if ($imageFileType != "jpg" && $imageFileType != "png" &&
		$imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$msg =  "Only JPG, JPEG, PNG & GIF are allowed.<br/>";
			return $result = ["message" => $msg, "uploadok" => 0];
		}

	}

	function renameFile($target_dir,$imageFileType) {
		// Rename file
		rename:
		$newfilename = rand(1, 9999999) . "." . $imageFileType;
		$target_file = $target_dir . $newfilename;

		// Check if file exists
		If (file_exists($target_file)) {
			goto rename;
		} else {
			return $target_file ;
		}
		
	}
	
	function folderExist($target_dir){
		if (!file_exists($target_dir)) {
			return mkdir($target_dir, 0777, true);
		}
		
	}

	function updateImagePath($image_id,$url){
		try {
			$sql = "UPDATE images SET url = ? WHERE image_id = ?";
			$query = $this->link->prepare($sql);
			$query->bindValue(1,$url);
			$query->bindValue(2,$image_id);
			$query->execute();
			$rowCount = $query->rowCount();
			return ['Message'=>"Successfully updated image file path ",'rowCount'=>$rowCount];
		} catch(PDOException $e) {
			return "Database error: Couldn't update file path: <br><br>" .$e->getMessage();
		}
	}

	
	function uploadImage($filename,$filetmpname,$target_file){
		if (move_uploaded_file($filetmpname,$target_file) ) {
			return $msg = "The file " . basename($filename) . " has been uploaded.<br/>";
		} else {
			 return $msg = "Sorry, there was an error uploading your file.<br/>";
		}
		
	}
	
	function create_image_file_path($projectID,$target_file) {
		try {
		$sql = "INSERT INTO images (project_id,url) VALUES (?,?)";
		$query = $this->link->prepare($sql);
		$query->bindValue(1,$projectID);
		$query->bindValue(2,$target_file);
		$query->execute();
		$rowCount = $query->rowCount();
		return ['Message'=>"Successfully created image file path ",'rowCount'=>$rowCount];
		} catch (PDOException $e) {
			return "Database error: Couldn't create file path: <br><br>" .$e->getMessage();
		}
	}

function deleteFolder($id){
$dir = "uploads/".$id; 

	foreach (scandir($dir) as $item) { //--------------------------------------------------------// Scan dir and get all files
		
	if ($item == '.' || $item == '..') continue; //------------------------------------------------// Exclude . and .. from dir
		
		if(is_file($dir.DIRECTORY_SEPARATOR.$item)) { //------------------------------------// Check if current item is a file
			$milliseconds = round(microtime(true) * 1000); //--------------------------------// Get time in milliseconds
			$temp = unlink($dir."/".$item); //-----------------------------------------------------// Delete this current file and store result in a $temp
			$result =  ["$dir"."/"."$item ". $milliseconds => $temp]; //----------------------// Store the time and the result of the attempt
		}
		
		if (is_dir($dir.DIRECTORY_SEPARATOR.$item)) { //-----------------------------------// Check if current item is a folder
			//*********************************   //-----------------------------------// If it is then repeat the previous procedure in this folder now.
			$dir2 = $dir.DIRECTORY_SEPARATOR.$item;
			foreach (scandir($dir2) as $item) {
				
			if ($item == '.' || $item == '..') continue;
				
				if(is_file($dir2.DIRECTORY_SEPARATOR.$item)) {
					$milliseconds = round(microtime(true) * 1000);
					$temp= unlink($dir."/gallery/".$item);
					$result["$dir"."/gallery/"."$item ". $milliseconds ] = $temp;
				 }
			}
			//********************************** //----------------------------------// End of the previous repeat
		}
		
		if (isset($dir2)){ //------------------------------------------------------------------------//  If variable $dir2 has been set proceed and try delete it
			$milliseconds = round(microtime(true) * 1000);
			$temp =  rmdir($dir2.DIRECTORY_SEPARATOR);
			$result[$dir2.DIRECTORY_SEPARATOR." $milliseconds "] =   $temp ;  
		}

		$empty =  (count(glob("$dir/*")) === 0) ? 1 : 0; //--------------------------------// Count items in variable $dir, and set true if it is empty
		
		if($empty === 1) { // -------------------------------------------------------------------// If variable $empty is true then proceed deleting  $dir
		$milliseconds = round(microtime(true) * 1000);
		 $temp =  rmdir($dir.DIRECTORY_SEPARATOR);
		 $result[$dir.DIRECTORY_SEPARATOR. " $milliseconds " ] = $temp ;
		}
		
	}
	return $result;
}

	
	function delete_old_img($projectID,$img_name){
		$destination = "uploads/".$projectID."/".$img_name;
		If (file_exists($destination)) {
			return unlink($destination);
		} else {
			return "Cannot find image to delete.";
		}
	}
	
	function image_id($target_file){
	$sql = "SELECT image_id FROM images WHERE url = ?";
	$query = $this->link->prepare($sql);
	$query->bindValue(1,$target_file);
	$query->execute();
	return $query->fetchColumn();
	}
}

<?php 

class formValidation {
	
	function formValidate($title,$projectID,$files) {
		if (!preg_match('/^[A-Za-z0-9_ -]*$/', $title)) {
			$error[] = "'Leters','Numbers', '-' and '_' only, are allowed to use for title.";
		}
		
		if (empty($title)) {
			$error[] = "Title is a required field.";
		}
		
		if (!empty($projectID)) {
			$error[] = "$title already exists in the database.";
		}
		
		if (isset($_FILES['file']['error']) && ($_FILES['file']['size']) == 0){
			$error[]=("Please select image to uplaod...");
			return $error;
		}
		
		if (isset($error) ){
			return $error;
		}
		
	}
	
}
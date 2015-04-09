<?php 

class formValidation {
	
	function titleValidate($title,$projectID) {
		if (!preg_match('/^[A-Za-z0-9_ -]*$/', $title)) {
			$error[] = "'Leters','Numbers', '-' and '_' only, are allowed to use for title.";
		}
		
		if (empty($title)) {
			$error[] = "Title is a required field.";
		}
	
		
		if (isset($error) ){
			return $error;
		}
		
	}
}
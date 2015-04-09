<?php 
$project_id = $_GET['id'];
If (isset($_POST['submit'])){


extract($_POST);
$error=array();
$extension=array("jpeg","jpg","png","gif");



	foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
		{
			$file_name=$_FILES["files"]["name"][$key];
			$file_tmp=$_FILES["files"]["tmp_name"][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);
			if(in_array($ext,$extension))
			{
				if(!file_exists("uploads/".$project_id."/gallery")){
					mkdir("uploads/".$project_id."/gallery", 0777, true);
				}
				if(!file_exists("uploads/".$project_id."/gallery/".$file_name))
				{
					move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"uploads/".$project_id."/gallery/".$file_name);
				}
				else
				{
					$filename=basename($file_name,$ext);
					$newFileName=$filename.time().".".$ext;
					move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"uploads/".$project_id."/gallery/".$newFileName);
				}
			}
			else
			{
				array_push($error,"$file_name, ");
			}
		}
}

if(file_exists("uploads/".$project_id."/gallery")){
include ("displayImages.php");
}
?>

<form method="post" action=""  enctype="multipart/form-data">
  <div class="form-group">
    <label for="SelectPhoto">Select Photo (one or multiple)</label>
   <input type="file" name="files[]" class="form-control" multiple/>
	  <p class="help-block">Note: Supported image format: .jpeg, .jpg, .png, .gif</p>
  </div>
  <input type="submit" name="submit" value="Create Gallery" id="selectedButton" class="btn btn-default" style="position:relative;right:-300px;"/>
</form>
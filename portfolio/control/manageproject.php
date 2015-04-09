<?php
class Project {
	public $link;
	
	function __construct(){
		$db_connect = new dbConnect;
		$this->link = $db_connect->connect();
		return $this->link;
	}
	
	function createProject($title,$description){
		$userID = $_SESSION['id'];
		try {
			$sql = "INSERT INTO projects (project_title, project_content, user_id) VALUES (?,?,?)";
			$query = $this->link->prepare($sql);
			$query->bindValue(1,$title);
			$query->bindValue(2,$description);
			$query->bindValue(3,$userID);
			$query->execute();
			$rowCount = $query->rowCount();
			return ['Message'=>"Successfully added new project " . $title,'RowCount'=>$rowCount];
		} catch (PDOException $e) {
			return "Database Error: The project could not be added.<br><br>".$e->getMessage();
		} catch (Exception $e) {
			return "General Error: The project could not be added.<br><br>".$e->getMessage();
		}
	}

	function fetchAll(){	//SELECT * FROM projects
		try{
			$query = $this->link->prepare("SELECT * FROM projects JOIN images ON projects.project_id=images.project_id");
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return "Error: " . $e->getMessage();
		}
	}
	
	function fetch_data($project_id) { //SELECT * FROM projects WHERE project_id = ?
		$query = $this->link->prepare("
		SELECT projects.project_id,projects.project_title,projects.project_content,images.url
		FROM projects
		JOIN images
		ON projects.project_id=images.project_id WHERE projects.project_id = ?
		");
		$query->bindValue(1,$project_id);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	function deleteImagePath($id) {
		try {
			$query = $this->link->prepare("DELETE FROM images WHERE project_id = ?");
			$query->bindValue(1,$id);
			$query->execute();
			return $query->rowCount();
		} catch (PDOException $e) {
		return "Error: Couldn't delete Image path<br>".$e->getMessage();
		}
	}
	
	function deleteProject($id){
		$r = $this->deleteImagePath($id);
		if ($r === 1 ) {
			try {
				$query = $this->link->prepare("DELETE FROM projects WHERE project_id = ?");
				$query->bindValue(1,$id);
				$query->execute();
				return $query->rowCount();
			} catch (PDOException $e) {
			return "Error: Couldn't delete project<br>".$e->getMessage();
			}
		} else { return $r;}
	}
		
	function getprojectId($title) {
		$sqlGetID = "SELECT project_id FROM projects WHERE project_title = ?";
		$query = $this->link->prepare($sqlGetID);
		$query->bindValue(1,$title);
		$query->execute();
		return $projectID = $query->fetch(PDO::FETCH_ASSOC);
	}

	function updateProject ($projectID,$title,$description){
		try {
			$sql = "UPDATE projects SET project_title = ? , project_content = ? WHERE project_id=?";
			$query = $this->link->prepare($sql);
			$query->bindValue(1,$title);
			$query->bindValue(2,$description);
			$query->bindValue(3,$projectID);
			$query->execute();
			$rowCount = $query->rowCount();

		return ['Message'=>"Successfully updated project " . $title,'rowCount'=>$rowCount];
		} catch (PDOException $e) {
			return "Database Error: The project could not be updated.<br>$image_id<br>".$e->getMessage();
		} catch (Exception $e) {
			return "General Error: The project could not be updated.<br><br>".$e->getMessage();
		}
	}
}


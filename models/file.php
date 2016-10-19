<?php 
	require_once('gateway.php');
	class File {
		// Database connection gateway
		private $gateway;
		// Directory where images are stored
		private $upload_dir;
		// Allowed file types
		private $allowableTypes = ['jpg', 'jpeg', 'gif', 'png'];
		
		public function __construct() {
			$this->gateway = Gateway::getInstance();
			$this->upload_dir = $_SERVER['DOCUMENT_ROOT'].'/img/';
		}
		
		// expects $FILES[file_field_name]
		public function handle_file($file) {
			$name = $file['name'];
			$size = $file['tmp_name'];
			$path = $this->upload_dir.$name;
			$exists = file_exists($path);
			$type = pathinfo($path, PATHINFO_EXTENSION);

			// DEBUGGING
			// echo $name . '<br>';
			// echo $size. '<br>';
			// echo $path. '<br>';
			// echo $exists. '<br>';
			// echo $type. '<br>';
			//-------------ERROR CHECKING
			//is not an image
			if ($size === false) throw new Exception('This is not an image');
			//file is too large
			if ($size > 999999999) throw new Exception('This image is too large. Please try a smaller image');
			//file isn't acceptable file type
			// TODO: Add allowable image types in error message
			if (!in_array($type, $this->allowableTypes)) throw new Exception('This image is not the right type');
		}
		// Expects $FILES[file_field_name] for $file and $_POST['description'] or GET['description'] for $description
		public function upload_file($file) {
			$name = $file['name'];
			$path = $this->upload_dir.$name;
			$uniqueName = date('Y-m-d-H-i-s').uniqid().$name.$type;
			$fullPath = $path.$uniqueName;
			$type = pathinfo($path, PATHINFO_EXTENSION);
			
			move_uploaded_file($file['tmp_name'], $this->upload_dir.$uniqueName);
			
			return upload_dir.$uniqueName;
		}
		
		public function get_images() {
			$sql = "SELECT * FROM image";
		
			$stmt = $this->gateway->dbh->prepare($sql);
			$stmt->execute();
			
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            try {
            	return $result;
            } catch (Exception $e) {
            	echo "Error getting images!<br>";
            	echo $e->getMessage();
            }
           
		}
		
		public function search_image($searchString) {
			$sql = "SELECT * FROM image WHERE title LIKE CONCAT('%', :search, '%') OR description LIKE CONCAT('%', :search, '%')";
			
			$stmt = $this->gateway->dbh->prepare($sql);
			$stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
			try {
				$stmt->execute();	
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			
			
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
			
			return $result;
		}
	}
?>
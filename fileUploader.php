<?php
	class FileUploader
	{
		private $target_directory = "uploads/";
		private $size_limit = 50000;
		private $uploadOk = false;
		private $file_original_name;
		private $file_type;
		private $file_size;
		private $final_file_name;
		private $tmp_name;

		public function __construct($file_original_name,$file_type,$file_size,$tmp_name)
		{
			$this->file_original_name = $file_original_name;
			$this->file_type = $file_type;
			$this->file_size = $file_size;
			$this->tmp_name = $tmp_name;
		}

		public function setOriginalName($file_original_name)
		{
			$this->file_original_name = $file_original_name;
		}

		public function getOriginalName()
		{
			return $this->file_original_name;
		}

		public function setFileType($file_type)
		{
			$this->file_type = $file_type;
		}

		public function getFileType()
		{
			return $this->file_type;
		}

		public function setFileSize($file_size)
		{
			$this->file_size = $file_size;
		}

		public function getFileSize()
		{
			return $this->file_size;
		}

		public function setFinalFileName($final_file_name)
		{
			$this->final_file_name = $final_file_name;
		}

		public function getFinalFileName()
		{
			return $this->final_file_name;
		}

		public function fileWasSelected()
		{
			if($this->file_size == 0)
			{
				$this->uploadOk = true;
			}
		}

		public function saveFilePathTo()
		{
			$this->final_file_name = $this->target_directory.$this->file_original_name;
		}

		public function fileAlreadyExists()
		{
			$name = $this->final_file_name;
			if (file_exists($name)) 
			{
  				$this->uploadOk = true;
  			}
		}
		
		public function fileTypeIsCorrect()
		{
			$type = $this->file_type;
			if($type != "jpg" && $type != "png")
			{
				$this->uploadOk = true;
			}
		}

		public function fileSizeIsCorrect()
		{
			$size = $this->file_size;
			if($size > $this->size_limit)
			{
				$this->uploadOk = true;
			}
		}

		public function moveFile()
		{
			$this->fileWasSelected();
			$this->saveFilePathTo();
			$this->fileAlreadyExists();
			$this->fileTypeIsCorrect();
			$this->fileSizeIsCorrect();
			if ($this->uploadOk == true) 
			{
  				$answer = "Image must be jpg/png format, smaller than 50KB and not already existing";
			}
			else 
			{
  				if (move_uploaded_file($this->tmp_name, $this->final_file_name)) 
  				{
  					$answer = "";
  				} 	
  				else 	
  				{
    				$answer = "Sorry, there was an error uploading your file.";
  				}
			}
			return $answer;
		}

		public function uploadFile($conn,$username)
		{
			$photo = $this->final_file_name;
			$upload = mysqli_query($conn,"UPDATE user SET profile_photo = '$photo' WHERE username = '$username'");
			return $upload;
		}
	}

?>
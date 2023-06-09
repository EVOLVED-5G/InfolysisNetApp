<?php

function redirect($page) {
	header('Location: ' .  $page);
	exit();
}

function check_login_status () {
	if (isset($_SESSION['logged_in'])) {
		return $_SESSION['logged_in'];
	}
	return false;
}

function clean($con, $str) {

		$str = @trim($str);

		//if(get_magic_quotes_gpc()) {

			//$str = stripslashes($str);

		//}

		return mysqli_real_escape_string($con, $str);

	}

	

class SimpleImage {
   
   var $image;
   var $image_type;
 
   function load($filename) {
	   $filename = $filename;
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }

   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      $filename = "../uploads/" . $filename;      
   	if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,100);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }

   function getWidth() {
      return imagesx($this->image);
   }

   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToSize($width,$height) {
      $ratiow = $width / $this->getWidth();
   	$ratioh = $height / $this->getHeight();
      if ($ratioh < $ratiow){
         $height = $this->getHeight() * $ratioh;
         $width = $this->getWidth() * $ratioh;
         $this->resize($width,$height);
   	}else{
      	$height = $this->getHeight() * $ratiow;
      	$width = $this->getWidth() * $ratiow;
      	$this->resize($width,$height);
      }
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
	   imageantialias($new_image,true);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;   
   }      
}



?>
